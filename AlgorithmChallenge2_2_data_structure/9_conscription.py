
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
        _cost, man_no, woman_no = heappop(h)
        if man_no in note and woman_no in note:
            continue
        if man_no not in note and woman_no not in note:
            cost += _MAX_COST
        cost += _cost
        note.add(man_no)
        note.add(woman_no)
    return cost + _MAX_COST * (women_num + men_num - len(note))

if __name__ == '__main__':
    print(datetime.now())
    print(71071 == solve(5, 5, 8, [(4, 3, 6831), (1, 3, 4583), (0, 0, 6592), (0, 1, 3063), (3, 3, 4975), (1, 3, 2049),
                                   (4, 2, 2104), (2, 2, 781)]))
    print(54223 == solve(5, 5, 10, [(2, 4, 9820), (3, 2, 6236), (3, 1, 8864), (2, 4, 8326), (2, 0, 5156), (2, 0, 1463),
                                    (4, 1, 2439), (0, 4, 4373), (3, 4, 8889), (2, 4, 3133)]))
    print(datetime.now())
