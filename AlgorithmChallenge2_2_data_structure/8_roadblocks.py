
from datetime import datetime
from heapq import heappush, heappop


def solve(node_num, paths):
    """
    まずedgesから_mapを作る
    hはheapq
    dpはnodeをkeyとして、２つの値をlistで持つ。defaultは[99999, 99999]
    startはnode=1なので、nodeと距離を(1, 距離)でhに登録していく
    hから取り出した値は、dpの両方の距離と比較して同じ、もしくは大きかったらスキップ、小さい場合はdpの大きい値と入れ替える
    全て探索した後、goalの２番目に大きい値を返す

    :param int node_num:
    :param list edges:
    :return int:
    """
    _map = {}
    dp = {}
    h = []
    for path in paths:
        _map.setdefault(path[0], []).append((path[1], path[2]))
        _map.setdefault(path[1], []).append((path[0], path[2]))
    for i in range(node_num):
        dp[i + 1] = [99999, 99999]
    heappush(h, (1, 0))

    def _get_next():
        while True:
            if len(h) == 0:
                return None
            step = heappop(h)
            if (step[1] == dp[step[0]][0] or step[1] == dp[step[0]][1] or
                    (step[1] > dp[step[0]][0] and step[1] > dp[step[0]][1])):
                continue
            if dp[step[0]][0] == dp[step[0]][1]:
                del dp[step[0]][1]
            else:
                dp[step[0]].remove(max(dp[step[0]]))
            dp[step[0]].append(step[1])
            return step

    def _solve(step):
        if step[0] not in _map:
            return
        for _path in _map[step[0]]:
            heappush(h, (_path[0], step[1] + _path[1]))

    while True:
        _next = _get_next()
        if _next is None:
            break
        _solve(_next)
    return max(dp[node_num])

if __name__ == '__main__':
    print(datetime.now())
    print(450 == solve(4, [(1, 2, 100), (2, 4, 200), (4, 3, 100), (2, 3, 250)]))
    print(datetime.now())
