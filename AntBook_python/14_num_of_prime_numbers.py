
from datetime import datetime
from math import sqrt, floor


def solve(target):
    if target == 0 or target == 1:
        return 0
    prime_judges = [True for _ in range(target)]
    prime_judges[0] = False
    sq = floor(sqrt(target))
    for i in range(2, sq + 1):
        j = i**2
        while j <= target:
            prime_judges[j - 1] = False
            j += i
    result = 0
    for judge in prime_judges:
        if judge is True:
            result += 1
    return result


if __name__ == '__main__':
    print(datetime.now())
    print(solve(11) == 5)
    print(solve(1000000) == 78498)
    print(datetime.now())
