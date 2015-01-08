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

function getWordCount($contents)
{
    $wordCount = [];
    foreach (str_split($contents) as $content) {
        if (array_key_exists($content, $wordCount)) {
            $wordCount[$content] += 1;
            continue;
        }
        $wordCount[$content] = 1;
    }
    arsort($wordCount);
    return $wordCount;
}

function getDictionary($contents)
{
    $wordCount = getWordCount($contents);
    $dictionary = [];
    $translatedKey = '1';
    foreach ($wordCount as $key => $value) {
        $dictionary[$key] = $translatedKey;
        $translatedKey = '0' . $translatedKey;
    }
    return $dictionary;
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
    $translatedBody = explode('1', $unserializedContents[KEY_FOR_BODY]);
    $dictionary = $unserializedContents[KEY_FOR_DICT];
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