<?php

/*
 * インプットでファイル名をもらう
 * ファイル確認
 * なければ終了
 * あれば、拡張子を確認する
 * pzipだったら解答、それ以外だったら圧縮する
 */

const EXTENSION = 'pzip';
const KEY_FOR_DICT = 'd';
const KEY_FOR_BODY = 'b';

if (count($argv) <= 1) {
    echo '引数として、ファイル名を指定してください。';
    return;
}

$contents = file_get_contents($argv[1]);
if ($contents === false) {
    echo 'ファイルの読み込みに失敗しました。';
    echo 'ファイルは、このphpファイルと同じディレクトリに置いてください。';
    return;
}

$fileNameSet = explode('.', $argv[1]);
if (isForPzip($fileNameSet)) {
    /*
     * 圧縮
     * 文字チェック
     * 変換できたら、文字数をカウント
     * 数の大きい順に、0, 00, 000...と割り振るような辞書を作る
     * 1は区切り
     * 辞書を元に変換する
     * シリアライズしてファイルに書き出す
     */

    if (strlen($contents) === 0) {
        file_put_contents($fileNameSet[0] . "." . EXTENSION, serialize([KEY_FOR_DICT => [], KEY_FOR_BODY => '']));
        echo '圧縮が完了しました。';
        return;
    }

    if (hasUnreadableWords($contents)) {
        echo '圧縮するファイルには、半角英数スペースのみ記載することができます。';
        return;
    }

    $dictionary = getDictionary($contents);
    $translatedContents = translate($contents, $dictionary);

    file_put_contents($fileNameSet[0] . "." . EXTENSION,
        serialize([KEY_FOR_DICT => $dictionary, KEY_FOR_BODY => $translatedContents]));
    echo '圧縮が完了しました。';
    return;
}

/*
 * アンシリアライズで復元する
 * 辞書から本文を復元する
 * ファイルに書き出して終了
 * ファイル名は、拡張子をtxtに変換したもの
 */

$body = reverse($contents);
file_put_contents($fileNameSet[0] . '.txt', $body);
echo '解凍が完了しました。';


function isForPzip($fileNameSet)
{
    return count($fileNameSet) <= 1 || $fileNameSet[1] !== EXTENSION;
}

function hasUnreadableWords($contents)
{
    return preg_match('/^[a-zA-Z0-9\s]+$/', $contents) !== 1;
}

function getDictionary($contents)
{
    /*
     * 全部ノードにした上で、heapを作る
     * heapから小さい値を２つ取り出す
     * ノードインスタンスを作る
     * 小さい方を０、大きい方を１とする
     * ２つの親ノードインスタンスも作る
     * 親をheapに入れる
     * heapのqueueが１つになるまで続ける
     *
     * 再起でノードを辞書に変換していく
     * 辞書を返す
     */

    $wordCounts = getWordCounts($contents);
    $nodeHeap = getNodeHeap($wordCounts);
    if ($nodeHeap->count() < 2) {
        return ['0' => $nodeHeap->extract()['data']];
    }

    while ($nodeHeap->count() >= 2) {
        $firstQueue = $nodeHeap->extract();
        $firstQueue['data']->num = 0;
        $secondQueue = $nodeHeap->extract();
        $secondQueue['data']->num = 1;
        $parentNode = new Node(null, null, $firstQueue['data'], $secondQueue['data']);
        $nodeHeap->insert($parentNode, $firstQueue['priority'] + $secondQueue['priority']);
    }

    // この時点で、$nodeHeapは、最も上位のキューが１つだけ入っている状態
    return $nodeHeap->extract()['data']->getDictionary();
}

function getWordCounts($contents)
{
    $wordCount = [];
    foreach (str_split($contents) as $content) {
        if (array_key_exists($content, $wordCount)) {
            $wordCount[$content] += 1;
            continue;
        }
        $wordCount[$content] = 1;
    }
    return $wordCount;
}

function getNodeHeap($wordCounts)
{
    $heap = new SplPriorityQueue();
    $heap->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
    foreach ($wordCounts as $word => $count) {
        $heap->insert(new Node($word), -$count);
    }
    return $heap;
}

function translate($contents, $dictionary)
{
    $translatedContents = '';
    foreach (str_split($contents) as $content) {
        $translatedContents .= $dictionary[$content];
    }
    return $translatedContents;
}

function findKey($array, $target)
{
    foreach ($array as $key => $value) {
        if ($value === $target) {
            return $key;
        }
    }
    return null;
}

function reverse($contents)
{
    $unserializedContents = unserialize($contents);
    $dictionary = $unserializedContents[KEY_FOR_DICT];
    $translatedBody = $unserializedContents[KEY_FOR_BODY];
    return getBody($translatedBody, $dictionary);
}

function getBody($translatedBody, $dictionary)
{
    $body = '';
    foreach ($translatedBody as $word) {
        $body .= findKey($dictionary, $word . '1');
    }
    return $body;
}

class Node {
    public function __construct($word = null, $num = null, $left = null, $right = null)
    {
        $this->word = $word;
        $this->num = $num;
        $this->left = $left;
        $this->right = $right;
    }

    private function isEnd()
    {
        return is_null($this->word) === false;
    }

    public function getDictionary($dictionary = [], $parentNum = '')
    {
        $selfNum = $parentNum . (string)$this->num;
        if ($this->isEnd()) {
            $dictionary[$this->word] = $selfNum;
            return $dictionary;
        }
        return $dictionary
            + $this->left->getDictionary($dictionary, $selfNum)
            + $this->right->getDictionary($dictionary, $selfNum);
    }
}