
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


def solve(n, info):
    crime_max = 10**5
    for case in info:
        uf = UnionFind(case[0][0] + crime_max)
        checked = []
        for key, value in enumerate(case):
            if key == 0:
                continue
            if value[0] == 'D':
                uf.union(value[1] - 1, value[2] - 1 + crime_max)
                uf.union(value[2] - 1, value[1] - 1 + crime_max)
                checked.append(value[1])
                checked.append(value[2])
            if value[0] == 'A':
                if uf.same(value[1] - 1, value[2] - 1 + crime_max) or uf.same(value[2] - 1, value[1] - 1 + crime_max):
                    print('In different gangs.')
                    continue
                if uf.same(value[1] - 1, value[2] - 1):
                    print('In the same gang.')
                    continue
                print('Not sure yet.')

if __name__ == '__main__':
    print(datetime.now())
    solve(1, [[(5, 5), ('A', 1, 2), ('D', 1, 2), ('A', 1, 2), ('D', 2, 4), ('A', 1, 4)]])
    solve(1, [[(2, 1), ('D', 1, 2)]])
    solve(1, [[(4, 3), ('D', 1, 2), ('D', 3, 4), ('A', 1, 3)]])
    print(datetime.now())
