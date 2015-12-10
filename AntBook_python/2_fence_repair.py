# -*- coding: utf-8 -*-

import heapq
from datetime import datetime


def solve(N, L):
    result = 0
    heapq.heapify(L)
    while len(L) > 1:
        new_item = heapq.heappop(L) + heapq.heappop(L)
        result += new_item
        heapq.heappush(L, new_item)
    return result

if __name__ == '__main__':
    print(datetime.now())
    print(solve(3, [8, 5, 8]) == 34)
    print(solve(20000, [50000 for i in range(20000)]))
    print(solve(4, [8, 6, 5, 7]) == 52)
    print(solve(4, [1, 8, 1, 1]) == 16)
    print(solve(1, [1]) == 0)
    print(datetime.now())