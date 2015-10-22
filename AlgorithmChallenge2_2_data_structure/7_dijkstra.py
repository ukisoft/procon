
from datetime import datetime
from heapq import heappush, heappop


def solve(paths, start, goal):
    global _map, dp, steps, h
    _map = {}
    dp = {}
    steps = []
    h = []
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
    heappush(h, (0, start))
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
    while True:
        if len(h) == 0:
            return None
        node = heappop(h)
        if node[1] in steps:
            continue
        if node[0] > dp[node[1]]:
            continue
        return node[1]


def _solve(target):
    if target not in _map or target in steps:
        return
    steps.append(target)
    for path in _map[target]:
        if path[0] in steps:
            continue
        min_cost = min([dp[path[0]], path[1] + dp[target]])
        dp[path[0]] = min_cost
        heappush(h, (min_cost, path[0]))


if __name__ == '__main__':
    print(datetime.now())
    print(16 == solve([('A', 'C', 5), ('A', 'B', 2), ('C', 'B', 4), ('B', 'D', 6), ('C', 'D', 2),
                       ('B', 'E', 10), ('D', 'F', 1), ('E', 'F', 3), ('E', 'G', 5), ('F', 'G', 9)], 'A', 'G'))
    print(datetime.now())
