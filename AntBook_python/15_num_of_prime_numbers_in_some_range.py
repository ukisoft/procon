
from datetime import datetime
from math import sqrt, floor


def solve(a, b):
    if b == 0 or b == 1:
        return 0
    prime_judges = [True for _ in range(b - a)]
    sq = floor(sqrt(b))
    for i in range(2, sq + 1):
        j = (a // i) * i + (0 if a % i == 0 else i)
        while a <= j < b:
            prime_judges[j - a] = False
            j += i
    result = 0
    for judge in prime_judges:
        if judge is True:
            result += 1
    return result


if __name__ == '__main__':
    print(datetime.now())
    print(solve(22, 37) == 3)
    print(solve(22801763489, 22801787297) == 1000)
    print(datetime.now())
