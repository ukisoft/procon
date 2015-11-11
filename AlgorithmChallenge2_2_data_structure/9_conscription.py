
from datetime import datetime
from heapq import heappush, heappop

_MAX_COST = 10000


def solve(women_num, men_num, relation_num, relations):
    h = []
    for relation in relations:
        heappush(h, (_MAX_COST - relation[2], 'm' + str(relation[0]), 'w' + str(relation[1])))
    cost = 0
    note = set()
    while len(h) > 0:
        relation = heappop(h)
        if relation[1] in note and relation[2] in note:
            continue
        if relation[1] not in note and relation[2] not in note:
            cost += _MAX_COST
        cost += relation[0]
        note.add(relation[1])
        note.add(relation[2])
    result = cost + _MAX_COST * (women_num + men_num - len(note))
    return result

if __name__ == '__main__':
    print(datetime.now())
    print(71071 == solve(5, 5, 8, [(4, 3, 6831), (1, 3, 4583), (0, 0, 6592), (0, 1, 3063), (3, 3, 4975), (1, 3, 2049),
                                   (4, 2, 2104), (2, 2, 781)]))
    print(datetime.now())
