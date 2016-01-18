
from datetime import datetime


def solve(target):
    if target == 0 or target == 1:
        return 0
    prime_judges = {i: True for i in range(1, target + 1)}
    prime_judges[1] = False
    result = 0
    for i in range(2, target + 1):
        for j in range(i, target + 1):
            if prime_judges[j] is False:
                continue
            if j == i:
                if prime_judges[j] is True:
                    result += 1
                continue
            if j % i == 0:
                prime_judges[j] = False
    return result


if __name__ == '__main__':
    print(datetime.now())
    print(solve(11) == 5)
    print(solve(1000000) == 78498)
    print(datetime.now())
