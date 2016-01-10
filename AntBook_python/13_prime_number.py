
from datetime import datetime
from math import sqrt, floor

_note = {1: False}


def solve(target):
    """
    targetの平方根を求める
    求めた値以下の自然数の中で、素数のものでtargetを割り、あまりがでないものが１つでもあればtargetは素数
    そうでなければ素数ではない
    http://detail.chiebukuro.yahoo.co.jp/qa/question_detail/q1413052429
    :param int target:
    :return:
    """
    if target in _note:
        return _note[target]
    sq = floor(sqrt(target))
    for i in range(2, sq + 1):
        if solve(i) and target % i == 0:
            _note[target] = False
            return False
    _note[target] = True
    return True
    

if __name__ == '__main__':
    print(datetime.now())
    print(solve(4) is False)
    print(solve(3) is True)
    print(solve(2) is True)
    print(solve(13) is True)
    print(solve(25) is False)
    print(solve(53) is True)
    print(solve(295927) is False)
    print(solve(9999973) is True)
    print(datetime.now())
