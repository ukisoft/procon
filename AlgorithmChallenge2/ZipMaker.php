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
if (isForZip($fileNameSet)) {
    /*
     * 圧縮
     * 文字をカウントする
     * Asciiに変換する
     * 変換できなければエラーで終了
     * 変換できたら、FenceRepairのアルゴリズムを使って、最小バイト数になるように辞書を作る
     * 最小バイト数の数字に変換する
     * 辞書との間に;を挟んで、結合してファイルに書き出す
     */
    if (hasUnreadableWords($contents)) {
        echo '圧縮するファイルには、半角英数スペースのみ記載することができます。';
        return;
    }
    $counter = [];
    foreach (str_split($contents) as $content) {
        if (array_key_exists(ord($content), $counter)) {
            $counter[ord($content)] += 1;
            continue;
        }
        $counter[ord($content)] = 1;
    }



    return;
}

/*
 * 辞書と本文を;で分割する
 * 辞書と照らしあわせて本文を復元する
 * ファイルに書き出して終了
 * ファイル名は、拡張子をtxtに変換したもの
 */


function isForZip($fileNameSet)
{
    return count($fileNameSet) <= 1 || $fileNameSet[1] !== 'pzip';
}

function hasUnreadableWords($contents)
{
    return preg_match('/^[a-zA-Z0-9\s]+$/', $contents) !== 1;
}