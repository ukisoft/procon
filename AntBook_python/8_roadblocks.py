
from datetime import datetime
from heapq import heappush, heappop


def solve(node_num, paths):
    """
    まずpathsから_mapを作る
    hはheapq
    dpはnodeをkeyとして、２つの値をlistで持つ。defaultは[99999, 99999]
    startはnode=1なので、距離とnodeを(距離, 1(node))でhに登録していく
    hから取り出した値は、dpの両方の距離と比較して同じ、もしくは大きかったらスキップ、小さい場合はdpの大きい値と入れ替える
    全て探索した後、goalの２番目に大きい値を返す

    :param int node_num:
    :param list paths:
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
    heappush(h, (0, 1))

    def _get_next():
        while True:
            if len(h) == 0:
                return None
            step = heappop(h)
            if (step[0] == dp[step[1]][0] or step[0] == dp[step[1]][1] or
                    (step[0] > dp[step[1]][0] and step[0] > dp[step[1]][1])):
                continue
            if dp[step[1]][0] == dp[step[1]][1]:
                del dp[step[1]][1]
            else:
                dp[step[1]].remove(max(dp[step[1]]))
            dp[step[1]].append(step[0])
            return step

    def _solve(step):
        if step[1] not in _map:
            return
        for _path in _map[step[1]]:
            heappush(h, (step[0] + _path[1], _path[0]))

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
