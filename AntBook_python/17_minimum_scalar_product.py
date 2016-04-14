
from datetime import datetime


def solve(n: int, x: tuple, y: tuple):
    _x = sorted(x)
    _y = sorted(y, reverse=True)
    result = 0
    for __x, __y in zip(_x, _y):
        result += __x * __y
    return result


if __name__ == '__main__':
    print(datetime.now())
    print(solve(3, (1, 3, -5), (-2, 4, 1)) == -25)
    print(solve(5, (1, 2, 3, 4, 5), (1, 0, 1, 0, 1)) == 6)
    print(datetime.now())
