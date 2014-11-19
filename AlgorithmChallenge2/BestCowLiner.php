<?php

namespace ProCon;

class BestCowLiner
{
    static private $right = 'right';
    static private $left = 'left';

    static public function get($inputString)
    {
        /*
         * INPUT文字列を分割する
         * 左右の文字を比較し、昇順の早い方をANSWERの末尾にくっつける
         * 対象の文字列をINPUTから消す
         * 左右が同じ文字だった場合、その次の文字同士で比較する
         * この時、昇順で早い方が属する文字をINPUTからANSWERに移動させる
         * ずっと同じ場合、INPUTの先頭を移動させる
         * 比較は、中央まで行ったら終了する
         * INPUTが0文字になるまで続ける
         * returnでANSWERを返す
         */
        $inputWords = str_split($inputString);
        $restWordNum = count($inputWords);
        $result = '';
        while ($restWordNum > 0) {
            $judge = BestCowLiner::judgeHeadOrTail($inputWords);
            if ($judge === BestCowLiner::$left) {
                $result .= array_shift($inputWords);
            }
            if ($judge === BestCowLiner::$right) {
                $result .= array_pop($inputWords);
            }
            $restWordNum--;
        }
        return $result;
    }

    static private function judgeHeadOrTail($words)
    {
        $leftWordKey = 0;
        $rightWordKey = count($words) - 1;
        while ($leftWordKey <= $rightWordKey) {
            $stringJudge = strcasecmp($words[$leftWordKey], $words[$rightWordKey]);
            if ($stringJudge > 0) {
                return BestCowLiner::$right;
            }
            if ($stringJudge < 0) {
                return BestCowLiner::$left;
            }
            $leftWordKey++;
            $rightWordKey--;
        }
        return BestCowLiner::$left;
    }
}