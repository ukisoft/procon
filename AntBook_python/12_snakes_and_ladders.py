
from datetime import datetime


def solve(a, b):
    stack = []
    while True:
        a, b, c = b % a, a, b // a
        stack.append(c)
        if a == 0:
            if b != 1:
                return -1
            break
    x, y = 0, 1
    while True:
        if len(stack) == 0:
            break
        c = stack.pop()
        x, y = y - c * x, x
    if x > 0:
        if y > 0:
            return x, y, 0, 0
        return x, 0, 0, -y
    if y > 0:
        return 0, y, -x, 0
    return 0, 0, -x, -y


if __name__ == '__main__':
    print(datetime.now())
    print((3, 0, 0, 1) == solve(4, 11))
    print(solve(999998764, 999999997))
    print(datetime.now())
