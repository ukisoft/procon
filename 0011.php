<?php

namespace Procon;

class BadNeighbors
{
    public function maxDonations($donations)
    {
        $copiedDonations = $donations;
        array_shift($copiedDonations);
        array_pop($donations);
        return max($this->calcLineDonation($copiedDonations), $this->calcLineDonation($donations));
    }

    private function calcLineDonation($lineDonations)
    {
        $dp = [];
        foreach ($lineDonations as $numberOfPerson => $donation) {
            if ($numberOfPerson < 2) {
                $dp[$numberOfPerson] = $lineDonations[$numberOfPerson];
                continue;
            } elseif ($numberOfPerson === 2) {
                $dp[$numberOfPerson] = $lineDonations[$numberOfPerson] + $dp[0];
                continue;
            } else {
                $dp[$numberOfPerson] = $lineDonations[$numberOfPerson]
                                       + max($dp[$numberOfPerson - 2], $dp[$numberOfPerson - 3]);
            }
        }
        return max($dp);
    }
}