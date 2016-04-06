
from datetime import datetime
from math import sqrt, floor


def solve(target):
    if _is_prime_number(target):
        return False
    for i in range(2, target):
        if (i**target - i) % target != 0:
            return False
    return True


def _is_prime_number(target):
    if target == 1:
        return False
    if target == 2:
        return True
    sq = floor(sqrt(target))
    for i in range(2, sq + 1):
        if target % i == 0:
            return False
    return True


if __name__ == '__main__':
    print(datetime.now())
    print(solve(17) is False)
    print(solve(561) is True)
    print(solve(4) is False)
    print(solve(64999))
    print(datetime.now())
