# -*- coding: utf-8 -*-

import heapq


def solve(gas_station_num, distance, start_gas, gas_station_positions, tank_sizes):
    gas_count = 0
    h = []
    next_position = start_gas
    gas_position = 0
    while next_position < distance:
        for i in range(gas_position, gas_station_num):
            if gas_station_positions[i] > next_position:
                gas_position = i
                break
            heapq.heappush(h, -tank_sizes[i])
        try:
            new_gas = heapq.heappop(h)
        except IndexError:
            return -1
        next_position += -new_gas
        gas_count += 1
    return gas_count


if __name__ == '__main__':
    print(solve(4, 25, 10, [10, 14, 20, 21], [10, 5, 2, 4]) == 2)
