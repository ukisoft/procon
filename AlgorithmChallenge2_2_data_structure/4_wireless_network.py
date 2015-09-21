
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


def solve(n, d, info):
    uf = UnionFind(n)
    computers = {}
    for i in range(n, len(info)):
        if info[i][0] == 'O':
            target_key = info[i][1]
            target_computer = computers[target_key] = info[target_key - 1]
            for key, computer in computers.items():
                if key == target_key:
                    continue
                if ((computer[0] - target_computer[0])**2 + (computer[1] - target_computer[1])**2)**(1/2) <= d:
                    uf.union(target_key - 1, key - 1)
        if info[i][0] == 'S':
            if uf.same(info[i][1] - 1, info[i][2] - 1):
                print('SUCCESS')
                continue
            print('FAIL')

if __name__ == '__main__':
    print(datetime.now())
    solve(4, 1, [(0, 1), (0, 2), (0, 3), (0, 4), ('O', 1), ('O', 2), ('O', 4), ('S', 1, 4), ('O', 3), ('S', 1, 4)])
    print(datetime.now())
