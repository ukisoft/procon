<?php

namespace ProCon;

class CorporationSalary
{

    private $salaries = [];

    public function totalSalary($relations)
    {

        // $salaryを作る。
        // foreachで、$relationsを回す。
        // この時、$salaryに登録されているカラムを除外した結果、全てがNになっているユーザを対象に給与を計算し、$salaryに入れる。
        // 給与の計算は、$salaryにある値と、自分のYのカラムを使って計算する。
        // $salaryのカウントが$relationsと同じになったら終了して、$salaryの総額を返す

        $relationsCountNum = count($relations);

        while (count($this->salaries) < $relationsCountNum) { // 給与が全部埋まるまでループ
            $this->addSalaryPossibly($relations);
        }

        return array_sum($this->salaries);
    }

    private function addSalaryPossibly($relations)
    {
        foreach ($relations as $personNo => $manageListString) {

            if (array_key_exists($personNo, $this->salaries)) { // すでに給与が計算済みならスキップ
                continue;
            }

            $manageList = str_split($manageListString);
            if (in_array('Y', $manageList) === false) { // 全部Nなら給与は1
                $this->salaries[$personNo] = 1;
                continue;
            }

            // $manageLstにYがあり、且つ給与計算済みでなければスキップ。そうでなければ計算
            try {
                $this->salaries[$personNo] = $this->calculateSalary($manageList);
            } catch (\Exception $e) {
                echo $e->getMessage();
                continue;
            }
        }
    }

    private function calculateSalary($manageList)
    {
        $salary = 0;
        foreach ($manageList as $manageTarget => $manageStatus) {
            if ($manageStatus === 'Y') {
                if (array_key_exists($manageTarget, $this->salaries) === false) {
                    throw new \OutOfRangeException('給与未計算');
                } else {
                    $salary += $this->salaries[$manageTarget];
                }
            }
        }
        return $salary;
    }
}
