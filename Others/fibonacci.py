
from datetime import datetime

_note = {}


def solve(i):
    if i == 0:
        return 0
    if i == 1:
        return 1
    if i in _note:
        return _note[i]
    result = solve(i - 2) + solve(i - 1)
    _note[i] = result
    return result


if __name__ == '__main__':
    print(datetime.now())
    print(solve(100))
    print(datetime.now())
    print(solve(1000))
    print(datetime.now())
