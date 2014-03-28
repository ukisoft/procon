<?php

class FriendScore {

    function highestScore($friends) {
        // $friendsから1つ分のrow（$friend）を取り出し、分割する
        // 元の$friendでYになっていた場合、該当する$friendで、Y、且つ元の$friendがNの数を数える
        // 上記の合計が最大のものを返す

        return max(array_map(function($friend) use ($friends) {
            $countY = 0;
            $friendStatuses = str_split($friend);

            foreach ($friendStatuses as $friendColumn => $friendStatus) {
                if ($friendStatus === 'Y') {
                    foreach (str_split($friends[$friendColumn]) as $key => $value) {
                        if ($value === 'Y' && $friendStatuses[$key] === 'N') $countY++;
                    }
                }
            }
            return $countY;
        }, $friends));
    }
}