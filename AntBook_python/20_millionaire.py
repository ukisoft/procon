
from datetime import datetime

_TARGET = 1000000


def solve(rest_round, win_rate, money):
    minimum = int(_TARGET / 2 ** rest_round)
    if money < minimum:
        return 0
    if money >= _TARGET:
        return 1
    if rest_round == 1:
        return win_rate
    result = 0
    for target in range(0, money + 1, minimum):
        result = max([result, (solve(rest_round - 1, win_rate, money - target) * (1 - win_rate) +
                               solve(rest_round - 1, win_rate, money + target) * win_rate)])
    return result


if __name__ == '__main__':
    print(datetime.now())
    print(solve(1, 0.5, 500000) == 0.5)
    print(solve(3, 0.75, 600000) == 0.84375)
    print(datetime.now())
