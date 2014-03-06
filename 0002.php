<?php

class InterestingParty {

    public function bestInvitation(array $first, array $second) {
        $mergedHobby = array_merge($first, $second);
        $countHobby = array_count_values($mergedHobby);
        return max($countHobby);
    }
}