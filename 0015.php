<?php

namespace Procon;

class StockHistory
{
    private $KEY_BENEFIT = 'benefit';
    private $KEY_STOCK_PRICE = 'stockPrice';

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
        $moneyFlow = $this->getMoneyFlow($initialInvestment, $monthlyContribution, count($companyStockFlows[0]));
        return $this->getBenefit($companyStockFlows, $moneyFlow);
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

    private function getMaxEarningOfCompany($companyStockFlow, $from)
    {
        $result = [];
        for ($i = $from; $i < count($companyStockFlow); $i++) {
            $result[] = [$this->KEY_BENEFIT => $companyStockFlow[count($companyStockFlow) - 1] - $companyStockFlow[$i], $this->KEY_STOCK_PRICE => $companyStockFlow[$i]];
        }

        foreach ($result as $buyTiming => $earning) {
            $sort_key[$buyTiming] = $earning[$this->KEY_BENEFIT];
        }
        array_multisort($sort_key, SORT_DESC, $result);

        return $result[0];
    }

    private function getMoneyFlow($initialInvestment, $monthlyContribution, $term)
    {
        $moneyFlow = [$initialInvestment];
        for ($i = 1; $i < $term; $i++) {
            $moneyFlow[] = $monthlyContribution;
        }
        return $moneyFlow;
    }

    private function getBenefit($companyStockFlows, $moneyFlow)
    {
        $benefit = 0;
        for ($i = 0; $i < count($moneyFlow); $i++) {
            $maxEarnings = [];
            foreach ($companyStockFlows as $companyStockFlow) {
                $maxEarnings[] = $this->getMaxEarningOfCompany($companyStockFlow, $i);
            }

            foreach ($maxEarnings as $companyNo => $maxEarning) {
                $sort_key[$companyNo] = $maxEarning[$this->KEY_BENEFIT];
            }
            array_multisort($sort_key, SORT_DESC, $maxEarnings);

            $benefit += ($moneyFlow[$i] / $maxEarnings[0][$this->KEY_STOCK_PRICE]) * $maxEarnings[0][$this->KEY_BENEFIT];
        }
        return round($benefit);
    }
}
