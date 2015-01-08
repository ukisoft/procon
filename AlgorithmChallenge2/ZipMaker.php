<?php

/*
 * インプットでファイル名をもらう
 * ファイル確認
 * なければ終了
 * あれば、拡張子を確認する
 * pzipだったら解答、それ以外だったら圧縮する
 */

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
    $counter = [];
    foreach (str_split($contents) as $content) {
        if (array_key_exists($content, $counter)) {
            $counter[$content] += 1;
            continue;
        }
        $counter[$content] = 1;
    }

    arsort($counter);
    $dictionary = [];
    $translatedKey = '1';
    foreach ($counter as $key => $value) {
        $dictionary[$key] = $translatedKey;
        $translatedKey = '0' . $translatedKey;
    }

    $translatedContents = '';
    foreach (str_split($contents) as $content) {
        $translatedContents .= $dictionary[$content];
    }

    file_put_contents($fileNameSet[0] . ".pzip", serialize(['dict' => $dictionary, 'body' => $translatedContents]));
    return;
}

/*
 * アンシリアライズで復元する
 * 辞書から本文を復元する
 * ファイルに書き出して終了
 * ファイル名は、拡張子をtxtに変換したもの
 */


function isForPzip($fileNameSet)
{
    return count($fileNameSet) <= 1 || $fileNameSet[1] !== 'pzip';
}

function hasUnreadableWords($contents)
{
    return preg_match('/^[a-zA-Z0-9\s]+$/', $contents) !== 1;
}