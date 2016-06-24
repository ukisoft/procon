
from datetime import datetime


def solve(p: int, q: int, a: list):
    """
    最後に空室にした際に、支払わなければならないコインの数を計算する
    最も支払いが少ない部屋が最後に支払われるべき部屋となる
    上記で計算した最少支払コイン数を result に追加する
    上記の部屋が空室ではないという条件で、再度支払わなければならないコインの数を計算する
    これを空室がなくなるまで続け、最後に result を返す

    :param p: 全ての部屋の数
    :param q: 空室にする部屋の数
    :param a: 空室にする部屋の位置
    :return: 最小支払いコイン数
    """
    a.sort()
    total_coin = 0
    coins = [_get_coin(a, i, p) for i, _ in enumerate(a)]
    while a:
        target_i = coins.index(min(coins))
        total_coin += coins[target_i]
        a.pop(target_i)
        if target_i != 0:
            coins[target_i - 1] = _get_coin(a, target_i - 1, p)
        if target_i != len(a):
            coins[target_i + 1] = _get_coin(a, target_i, p)
        coins.pop(target_i)
    return total_coin


def _get_coin(a, i, p):
    if i == 0 and i == len(a) - 1:
        left_coin = a[i] - 1
        right_coin = p - a[i]
    elif i == 0:
        left_coin = a[i] - 1
        right_coin = a[i + 1] - a[i] - 1
    elif i == len(a) - 1:
        left_coin = a[i] - a[i - 1] - 1
        right_coin = p - a[i]
    else:
        left_coin = a[i] - a[i - 1] - 1
        right_coin = a[i + 1] - a[i] - 1
    return left_coin + right_coin


if __name__ == '__main__':
    print(datetime.now())
    print(solve(8, 1, [3]) == 7)
    print(solve(20, 3, [3, 6, 14]) == 35)
    print(datetime.now())
