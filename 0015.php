<?php

namespace Procon;

class StockHistory
{
    public function maximumEarnings($initialInvestment, $monthlyContribution, $stockPrices)
    {
        /*
         * 起点となる月から未来を見て、いつ買えば最後に売った時に最も利益が得られる月を探す。
         *  function private getBestEarning($firstMonth, $stockPrice) { return $bestEarning; }
         * 儲かるランキングを作る。
         *  function private getBestEarningStock($firstMonth, $stockPrices) { return for {max(this->getBestEarning);}}
         * 手持ち金額を全額、ランキング1位に割り振る。
         * あまりが出たら2位以降・・・と分配。
         * 月が変わって、新しく投資するお金は、起点となる月を合わせて、再度計算する。
         */

        $companyStockFlows = $this->parseStockPrices($stockPrices);

        // メソッド化?
        $maxEarnings = [];
        foreach ($companyStockFlows as $companyStockFlow) {
            $maxEarnings[] = $this->getMaxEarningOfCompany($companyStockFlow);
        }

        arsort($maxEarnings);
        $benefit = 0;
        foreach ($maxEarnings as $companyNo => $maxEarning) {
            if ($maxEarning === 0) {
                break;
            }
            $benefit += ($initialInvestment / $companyStockFlows[$companyNo][0]) * $maxEarning;
            $initialInvestment = $initialInvestment % $companyStockFlows[$companyNo][0];
        }

        return $benefit;
    }

    private function parseStockPrices($stockPrices)
    {
        $stockPrices = $this->explodeBySpace($stockPrices);
        $result = [];
        foreach ($stockPrices as $stockPrice) {
            foreach ($stockPrice as $companyNo => $stock) {
                if (array_key_exists($companyNo, $result) === false) {
                    $result[$companyNo] = [];
                }
                $result[$companyNo][] = $stock;
            }
        }
        return $result;
    }

    private function explodeBySpace($stockPrices)
    {
        $result = [];
        foreach ($stockPrices as $stockPrice) {
            $result[] = explode(" ", $stockPrice);
        }
        return $result;
    }

    private function getMaxEarningOfCompany($companyStockFlow)
    {
        $result = [];
        for ($i = 0; $i < count($companyStockFlow); $i++) {
            $result[] = $companyStockFlow[$i] - $companyStockFlow[0];
        }
        return max($result);
    }
}
