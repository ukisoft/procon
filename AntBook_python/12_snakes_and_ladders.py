
from datetime import datetime
from fractions import gcd


def solve(a, b):
    """
    aとbの最小公倍数までの値を、それぞれ求める
    aは-b、bは-aと、１つずつ足し算をし、１になったら、その組み合わせが答え
    なければ−１を返す
    :param a:
    :param b:
    """
    gcd_num = gcd(a, b)
    a_list = []
    for i in range(b * gcd_num):
        if i == 0:
            continue
        a_list.append(a * i)
    for i in range(a * gcd_num):
        if i == 0:
            continue
        for _a in a_list:
            if _a - b * i == 1:
                return _a / a, 0, 0, i
            if -_a + b * i == 1:
                return 0, i, _a / a, 0
    return -1


if __name__ == '__main__':
    print(datetime.now())
    print((3, 0, 0, 1) == solve(4, 11))
    print(datetime.now())
