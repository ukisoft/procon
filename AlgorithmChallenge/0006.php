<?php

namespace ProCon;

class FriendScore {

    function highestScore($friends) {
        // $friendsから1つ分のrow（$friend）を取り出し、分割する
        // 元の$friendでYになっていた場合、該当する$friendで、Y、且つ元の$friendがNの数を数える
        // 上記の合計が最大のものを返す

        foreach ($friends as $baseFriendRowNo => $baseFriend) {

            $result[] = array_sum(array_map(function($comparedFriend) use ($baseFriendRowNo, $baseFriend) {

                if ($comparedFriend[$baseFriendRowNo] === 'N') return 0;

                return array_count_values(array_map(function($baseFriendStatus, $comparedFriendStatus) {
                    return $baseFriendStatus.$comparedFriendStatus;
                }, str_split($baseFriend), str_split($comparedFriend)))["NY"];

            }, $friends));
        }

        return max($result);
    }
}