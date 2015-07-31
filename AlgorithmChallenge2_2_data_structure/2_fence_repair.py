# -*- coding: utf-8 -*-

import heapq


def solve(N, L):
    result = 0
    heapq.heapify(L)
    while len(L) > 1:
        new_item = heapq.heappop(L) + heapq.heappop(L)
        result += new_item
        heapq.heappush(L, new_item)
    return result

if __name__ == '__main__':
    print(solve(3, [8, 5, 8]) == 34)
    print(solve(20000, [50000 for i in range(20000)]))
