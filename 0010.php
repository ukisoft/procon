<?php

namespace Procon;

class CorporationSalary
{

    public function totalSalary($relations)
    {

        // $salaryを作る。
        // foreachで、$relationsを回す。
        // この時、$salaryに登録されているカラムを除外した結果、全てがNになっているユーザを対象に給与を計算し、$salaryに入れる。
        // 給与の計算は、$salaryにある値と、自分のYのカラムを使って計算する。
        // $salaryのカウントが$relationsと同じになったら終了して、$salaryの総額を返す

        $salaries = [];
        $relationsCountNum = count($relations);

        while (count($salaries) < $relationsCountNum) { // 給与が全部埋まるまでループ
            foreach ($relations as $personNo => $manageListString) {

                if (array_key_exists($personNo, $salaries)) { // すでに給与が計算済みならスキップ
                    continue;
                }

                $manageList = str_split($manageListString);
                if (in_array('Y', $manageList) === false) { // 全部Nなら給与は1
                    $salaries[$personNo] = 1;
                    continue;
                }

                // $manageLstにYがあり、且つ給与計算済みでなければスキップ。そうでなければ計算
                $salary = 0;
                foreach ($manageList as $manageTarget => $manageStatus) {
                    if ($manageStatus === 'Y') {
                        if (array_key_exists($manageTarget, $salaries) === false) {
                            continue 2;
                        } else {
                            $salary += $salaries[$manageTarget];
                        }
                    }
                }
                $salaries[$personNo] = $salary;
            }
        }

        return array_sum($salaries);
    }
}
