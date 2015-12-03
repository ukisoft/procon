
from datetime import datetime

_MAX_DISTANCE = 1000001


def solve(cow_num, good_relation_num, bad_relation_num, good_relations, bad_relations):
    # cowがindexで、値はcowの位置とする配列を作る。cow_no=1だけ0、それ以外は1000001。
    # cow毎に、全てのrelationsをチェックする
    # good_relationの場合、値の小さい牛を基準として、対象牛の位置を、基準牛位置＋好意距離で更新する
    # bad_relationの場合、値の大きい牛を基準として、対象牛の位置を、基準牛位置−嫌悪距離で更新する
    # ただし、基準牛の位置が1000001であれば何もしない
    # 全てのrelationsのチェックが終わったあとで、牛の最大位置が1000001を超えていた場合、-2を返す
    # 再度、同じ全てのcow、relationsで位置をチェックし、更新があれば無限ループが含まれているので、-2を返す
    # 再チェックで更新がなければ、牛の最大位置を返す
    cow_positions = [_MAX_DISTANCE for _ in range(cow_num)]
    for cow_no, _ in enumerate(cow_positions):
        if cow_no == 0:
            cow_positions[cow_no] = 0
            continue
        for good_relation in good_relations:
            if good_relation[0] < good_relation[1]:
                target_cow = good_relation[1] - 1
                base_cow = good_relation[0] - 1
            else:
                target_cow = good_relation[0] - 1
                base_cow = good_relation[1] - 1
            if cow_positions[base_cow] >= _MAX_DISTANCE:
                continue
            cow_positions[target_cow] = cow_positions[base_cow] + good_relation[2]
        for bad_relation in bad_relations:
            if bad_relation[0] < bad_relation[1]:
                target_cow = bad_relation[0] - 1
                base_cow = bad_relation[1] - 1
            else:
                target_cow = bad_relation[1] - 1
                base_cow = bad_relation[0] - 1
            if cow_positions[base_cow] >= _MAX_DISTANCE:
                continue
            cow_positions[target_cow] = cow_positions[base_cow] - bad_relation[2]
    maximum_distance = max(cow_positions)
    if maximum_distance >= _MAX_DISTANCE:
        return -2
    # もう１回更新出来たらループが発生しているので、-2を返す
    for cow_no, _ in enumerate(cow_positions):
        if cow_no == 0:
            if cow_positions[cow_no] != 0:
                return -2
            continue
        for good_relation in good_relations:
            if good_relation[0] < good_relation[1]:
                target_cow = good_relation[1] - 1
                base_cow = good_relation[0] - 1
            else:
                target_cow = good_relation[0] - 1
                base_cow = good_relation[1] - 1
            if cow_positions[base_cow] >= _MAX_DISTANCE:
                continue
            if cow_positions[target_cow] != cow_positions[base_cow] + good_relation[2]:
                return -2
        for bad_relation in bad_relations:
            if bad_relation[0] < bad_relation[1]:
                target_cow = bad_relation[0] - 1
                base_cow = bad_relation[1] - 1
            else:
                target_cow = bad_relation[1] - 1
                base_cow = bad_relation[0] - 1
            if cow_positions[base_cow] >= _MAX_DISTANCE:
                continue
            if cow_positions[target_cow] != cow_positions[base_cow] - bad_relation[2]:
                return -2
    return maximum_distance


if __name__ == '__main__':
    print(datetime.now())
    print(27 == solve(4, 2, 1, [(1, 3, 10), (2, 4, 20)], [(2, 3, 3)]))
    print(datetime.now())
