
from datetime import datetime
from heapq import heappush, heappop
from copy import copy


def solve(paths, start, goal):
    global _map, dp, steps
    _map = {}
    dp = {}
    steps = []
    for path in paths:
        if path[0] not in _map:
            _map[path[0]] = []
        _map[path[0]].append((path[1], path[2]))
        dp[path[0]] = 99999
        if path[1] not in _map:
            _map[path[1]] = []
        _map[path[1]].append((path[0], path[2]))
        dp[path[1]] = 99999
    dp[start] = 0
    _solve(start)
    while True:
        _next = get_next()
        if _next is None:
            break
        _solve(_next)
    if goal in dp:
        return dp[goal]
    return False


def get_next():
    _dp = copy(dp)
    for step in steps:
        _dp.pop(step)
    if len(_dp) == 0:
        return None
    h = []
    for key, value in _dp.items():
        heappush(h, (value, key))
    return heappop(h)[1]


def _solve(target):
    if target not in _map or target in steps:
        return
    steps.append(target)
    for path in _map[target]:
        if path[0] in steps:
            continue
        dp[path[0]] = min([dp[path[0]], path[1] + dp[target]])


if __name__ == '__main__':
    print(datetime.now())
    print(16 == solve([('A', 'C', 5), ('A', 'B', 2), ('C', 'B', 4), ('B', 'D', 6), ('C', 'D', 2),
                       ('B', 'E', 10), ('D', 'F', 1), ('E', 'F', 3), ('E', 'G', 5), ('F', 'G', 9)], 'A', 'G'))
    print(datetime.now())
