# -*- coding: utf-8 -*-

import heapq


def solve(gas_station_num, distance, start_gas, gas_station_points, tank_sizes):
    gas_count = 0
    h = []
    start_position = 0
    next_position = start_gas
    while next_position < distance:
        for p, t in filter(lambda x: start_position < x[0] <= next_position, list(zip(gas_station_points, tank_sizes))):
            heapq.heappush(h, 1 / t)
        try:
            new_gas = heapq.heappop(h)
        except IndexError:
            return -1
        start_position = next_position
        next_position += 1 / new_gas
        gas_count += 1
    return gas_count


if __name__ == '__main__':
    print(solve(4, 25, 10, [10, 14, 20, 21], [10, 5, 2, 4]) == 2)