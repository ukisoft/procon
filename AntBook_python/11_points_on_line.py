
from collections import namedtuple
from datetime import datetime
from fractions import gcd
from math import fabs, floor

Point = namedtuple('Point', ('x', 'y'))


def solve(_start, _end):
    start = Point(x=_start[0], y=_start[1])
    end = Point(x=_end[0], y=_end[1])
    return fabs(floor(gcd(end.x - start.x, end.y - start.y))) - 1  # 終点を引く

if __name__ == '__main__':
    print(datetime.now())
    print(3 == solve((1, 11), (5, 3)))
    print(datetime.now())
