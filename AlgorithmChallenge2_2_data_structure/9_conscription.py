
from datetime import datetime
from heapq import heappush, heappop

_MAX_COST = 10000


def solve(women_num, men_num, relation_num, relations):
    h = []
    heappush(h, (_MAX_COST, 0))
    cost = 0
    team = set()
    while len(h) > 0:
        _cost, person_no = heappop(h)
        if person_no in team:
            continue
        team.add(person_no)
        cost += _cost
        if len(team) == women_num + men_num:
            break
        for man_no, woman_no, relation_num in relations:
            if man_no in team and men_num + woman_no + 1 in team:
                continue
            if man_no in team:
                heappush(h, (_MAX_COST - relation_num, men_num + woman_no + 1))
                continue
            if men_num + woman_no + 1 in team:
                heappush(h, (_MAX_COST - relation_num, man_no))
                continue
            heappush(h, (_MAX_COST, man_no))
            heappush(h, (_MAX_COST, men_num + woman_no + 1))
    cost += (women_num + men_num - len(team)) * _MAX_COST
    return cost

if __name__ == '__main__':
    print(datetime.now())
    print(71071 == solve(5, 5, 8, [(4, 3, 6831), (1, 3, 4583), (0, 0, 6592), (0, 1, 3063), (3, 3, 4975), (1, 3, 2049),
                                   (4, 2, 2104), (2, 2, 781)]))
    print(54223 == solve(5, 5, 10, [(2, 4, 9820), (3, 2, 6236), (3, 1, 8864), (2, 4, 8326), (2, 0, 5156), (2, 0, 1463),
                                    (4, 1, 2439), (0, 4, 4373), (3, 4, 8889), (2, 4, 3133)]))
    print(37989 == solve(2, 2, 3, [(0, 0, 1000), (0, 1, 10), (1, 1, 1001)]))
    print(datetime.now())
