
from collections import namedtuple
from datetime import datetime
from fractions import gcd
from math import fabs, floor

Point = namedtuple('Point', ('x', 'y'))


def solve(_start, _end):
    start = Point(x=_start[0], y=_start[1])
    end = Point(x=_end[0], y=_end[1])
    if start.x == end.x and start.y == end.y:
        return 0
    return gcd(fabs(end.x - start.x), fabs(end.y - start.y)) - 1  # 終点を引く

if __name__ == '__main__':
    print(datetime.now())
    print(3 == solve((1, 11), (5, 3)))
    print(0 == solve((0, 0), (0, 0)))
    print(0 == solve((0, 0,), (0, -1)))
    print(datetime.now())
