<?php

namespace Procon;

class AutoLoan
{
    private $price;
    private $monthlyPayment;
    private $loanTerm;
    private $totalPayment;

    public function interestRate($price, $monthlyPayment, $loanTerm)
    {
        /*
         * monthlyPayment * loanTerm が、実際に支払った合計金額
         * result（年利）を12で割り、前月の借金にかけたものが利息
         *
         * 年利を中央値（最初は4）とし、二分探査で、計算した時にPriceを超えない値を求める
         * 次の桁を同様に計算する
         * 18桁まで計算し、最後の1桁を四捨五入する
         */

        $this->price = $price;
        $this->monthlyPayment = $monthlyPayment;
        $this->loanTerm = $loanTerm;
        $this->totalPayment = $monthlyPayment * $loanTerm;

        $monthlyLoan = '0.';
        while (true) {
            $monthlyLoan = $this->getMonthlyLoanAddedDigit($monthlyLoan);
            if ($this->getAvailableFloatDigit($monthlyLoan) > 17) {
                var_dump($monthlyLoan);
                var_dump(bcmul($monthlyLoan, '1200', 100));
                return bcmul($monthlyLoan, '1200', 100);
            }
        }
    }

    private function getMonthlyLoanAddedDigit($monthlyLoan)
    {
        $binarySearchBaseArray = [];
        for ($i = 0; $i < 10; $i++) {
            $binarySearchBaseArray[] = $i;
        }

        for ($i = 9; $i >= 0; $i--) {
            if ($this->isSmallerPaymentThanSamplePayment($monthlyLoan . $i)) return $monthlyLoan . $i;
        }
    }

    private function isSmallerPaymentThanSamplePayment($monthlyInterest)
    {
        $restPayment = $this->price;
        for ($i = 0; $i < $this->loanTerm; $i++) {
            $interest = bcmul($restPayment, $monthlyInterest, 100);
            $restPayment = bcadd($interest, $restPayment, 100);
            $restPayment = bcsub($restPayment, $this->monthlyPayment, 100);
            if ($restPayment <= 0) return true;
        }
        return false;
    }

    private function getAvailableFloatDigit($num)
    {
        $numArray = str_split($num);
        for ($i = count($numArray) - 1; $i >= 0; $i--) {
            if ($numArray[$i] == '0') {
                unset($numArray[$i]);
                continue;
            }
            break;
        }

        for ($i = 2; $i < count($numArray); $i++) {
            if ($numArray[$i] != '0') return count($numArray) - $i;
        }
        return 0;
    }
}