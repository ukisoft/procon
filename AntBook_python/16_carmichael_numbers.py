
from datetime import datetime
from math import sqrt, floor


def solve(target):
    if _is_prime_number(target):
        return False
    for i in range(2, target):
        bit = bin(target)[2:]
        _target = 1
        _next = i
        while len(bit) > 0:
            if bit[len(bit) - 1] != '1':
                _next = _next * _next % target
                bit = bit[:len(bit) - 1]
                continue
            _target = _target * _next % target
            _next = _next * _next % target
            bit = bit[:len(bit) - 1]
        if (_target - i) % target != 0:
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
    print(solve(63973))
    print(datetime.now())
