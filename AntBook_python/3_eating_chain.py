
from datetime import datetime


# http://www.geocities.jp/m_hiroi/light/pyalgo61.html
class UnionFind(object):
    def __init__(self, size):
        self.table = [-1 for _ in range(size)]

    def find(self, x):
        if self.table[x] < 0:
            return x
        self.table[x] = self.find(self.table[x])
        return self.table[x]

    def same(self, x, y):
        return self.find(x) == self.find(y)

    def union(self, x, y):
        if self.same(x, y):
            return False
        s1 = self.find(x)
        s2 = self.find(y)
        if self.table[s1] <= self.table[s2]:  # (´・ω・`)？
            self.table[s1] += self.table[s2]
            self.table[s2] = s1
        else:
            self.table[s2] += self.table[s1]
            self.table[s1] = s2
        return True


def solve(n, k, info):
    uf = UnionFind(n * 3)
    result = 0
    for p, x, y in info:
        if p <= 0 or p > 2 or x <= 0 or x > n or y <= 0 or y > n:  # ダメな数値
            result += 1
            continue
        if p == 1:  # 同じ種類
            if uf.same(x, y) and uf.same(x + n, y + n) and uf.same(x + n*2, y + n*2):
                continue
            if (uf.same(x, y + n) or uf.same(x + n, y + n*2) or uf.same(x + n*2, y) or
                    uf.same(x + n, y) or uf.same(x + n*2, y + n) or uf.same(x, y + n*2)):
                result += 1
                continue
            uf.union(x, y)
            uf.union(x + n, y + n)
            uf.union(x + n*2, y + n*2)
        if p == 2:  # xがyを食べる
            if uf.same(x, y + n) and uf.same(x + n, y + n*2) and uf.same(x + n*2, y):
                continue
            if (uf.same(x, y) or uf.same(x + n, y + n) or uf.same(x + n*2, y + n*2) or
                    uf.same(x + n, y) or uf.same(x + n*2, y + n) or uf.same(x, y + n*2)):
                result += 1
                continue
            uf.union(x, y + n)
            uf.union(x + n, y + n*2)
            uf.union(x + n*2, y)
    print(result)
    return result

if __name__ == '__main__':
    print(datetime.now())
    print(solve(100, 7, [(1, 101, 1), (2, 1, 2), (2, 2, 3), (2, 3, 3), (1, 1, 3), (2, 3, 1), (1, 5, 5)]) == 3)
    print(datetime.now())
