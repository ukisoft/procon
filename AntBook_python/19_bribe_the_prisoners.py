
from datetime import datetime


def solve(p: int, q: int, a: list):
    """
    動的計画法

    :param p: 全ての部屋の数
    :param q: 空室にする部屋の数
    :param a: 空室にする部屋の位置
    :return: 最小支払いコイン数
    """
    _a = [0]
    _a.extend(a + [p + 1])
    dp = {}
    for _q in range(q + 1):
        dp.setdefault(_q, {})[_q + 1] = 0
    for w in range(2, q + 2):
        for i in range(0, q + 2 - w):
            j = w + i
            t = 100000
            for k in range(i + 1, j):
                t = min(t, dp[i][k] + dp[k][j])
            dp[i][j] = t + _a[j] + _a[i] - 2
    return dp[0][q + 1]


if __name__ == '__main__':
    print(datetime.now())
    print(solve(8, 1, [3]) == 7)
    print(solve(20, 3, [3, 6, 14]) == 35)
    print(datetime.now())
