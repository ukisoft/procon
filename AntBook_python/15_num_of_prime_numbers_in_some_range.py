
from datetime import datetime
from math import sqrt, floor


def solve(a, b):
    if b == 0 or b == 1:
        return 0
    prime_judges = [True for _ in range(b - a)]
    sq = floor(sqrt(b))
    for i in range(2, sq + 1):  # todo 1 - ルートb までの list を別にもち、そこでも素数かどうかを管理して次の行を早める
        j = (a // i) * i + (0 if a % i == 0 else i)
        if a // i <= 1:  # ルート b よりも a が小さい場合、i が素数の場合でも素数ではないと判断されてしまうため
            j += i
        while a <= j < b:
            prime_judges[j - a] = False
            j += i
    result = 0
    for i, judge in enumerate(prime_judges):
        if judge is True:
            result += 1
    return result


if __name__ == '__main__':
    print(datetime.now())
    print(solve(22, 37) == 3)
    print(solve(22801763489, 22801787297) == 1000)
    print(solve(999999000000, 1000000000000))
    print(solve(2, 30) == 10)  # 2, 3, 5, 7, 11, 13, 17, 19, 23, 29
    print(datetime.now())
