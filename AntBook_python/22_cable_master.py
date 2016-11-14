
from math import floor
from datetime import datetime


def solve(n: int, k: int, l: tuple):
    """
    最大の長さ（m）で、全ての紐を割る -> 目標分割数に到達していればオワリ
    達していなければ、m/2 で再度試す（このとき、右辺が条件を満たせず、左辺が条件を満たすように、次に分割する箇所を選択していく）
        -> 右辺と左辺の小数点第二より下を切り捨てしたときに一致すれば、それが答え
    :param n: 紐の本数
    :param k: 目標分割数
    :param l: 紐の長さ
    :return: 分割後の紐の最大長
    """
    rope_length = max(l)
    if sum((rope // rope_length for rope in l)) >= k:
        return rope_length
    return _solve(rope_length / 2, rope_length, k, l)


def _solve(left_rope_length: float, right_rope_length: float, k: int, l: tuple):
    """
    right_rope_length は必ず目標分割数を満たせない長さ
    """
    if sum((rope // left_rope_length for rope in l)) < k:
        return _solve(left_rope_length / 2, left_rope_length, k, l)
    if floor(left_rope_length * 100) == floor(right_rope_length * 100):
        return floor(left_rope_length * 100) / 100
    return _solve((left_rope_length + right_rope_length) / 2, right_rope_length, k, l)


if __name__ == '__main__':
    print(datetime.now())
    print(solve(10, 11, (8.02, 7.43, 4.57, 5.39)) == 2.00)
    print(datetime.now())
