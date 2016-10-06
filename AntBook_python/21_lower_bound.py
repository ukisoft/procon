
from datetime import datetime

_TARGET = 1000000


def solve(n: int, a: list, k: int):
    if a[n - 1] < k:
        return n
    return _solve(a, k)


def _solve(target_list, num):
    l = len(target_list)
    if l == 1:
        return 0 if target_list[0] >= num else 1
    if l % 2 == 1:
        i = int((l + 1) / 2 - 1)
    else:
        i = int(l / 2 - 1)
    if target_list[i] >= num:
        return _solve(target_list[0:i], num)
    return _solve(target_list[i + 1:], num) + i + 1


if __name__ == '__main__':
    print(datetime.now())
    print(solve(5, [2, 3, 3, 5, 6], 3) == 1)
    print(solve(10, [0, 0, 1, 2, 5, 10, 11, 11, 15, 20], 2) == 3)
    print(datetime.now())
