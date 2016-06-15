
from datetime import datetime


def solve(n: int, matrix: tuple):
    """
    1 の最も右にある場所を list にする
    1 行目の場所が対角線を超えていた場合、最も近くにある対角線を超えていない行を探して、そこまで入れ替える
    上記を最後まで行い、入れ替えた回数を返す
    """
    move_count = 0
    positions = _get_positions(n, matrix)
    for i in range(n):
        if positions[i] > i + 1:
            for j in range(i + 1, n):
                if positions[j] <= i + 1:
                    positions.insert(i, positions.pop(j))
                    move_count += j - i
                    break
    return move_count


def _get_positions(n, matrix):
    positions = []
    for line in matrix:
        for i in range(n):
            if line[n - i - 1] == 1:
                positions.append(n - i)
                break
        else:
            positions.append(0)
    return positions


if __name__ == '__main__':
    print(datetime.now())
    print(solve(2, ((1, 0), (1, 1))) == 0)
    print(solve(3, ((0, 0, 1), (1, 0, 0), (0, 1, 0))) == 2)
    print(solve(4, ((1, 1, 1, 0), (1, 1, 0, 0), (1, 1, 0, 0), (1, 0, 0, 0))) == 4)
    print(datetime.now())
