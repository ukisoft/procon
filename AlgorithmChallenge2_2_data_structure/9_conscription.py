
from datetime import datetime
from heapq import heappush, heappop

_MAX_COST = 10000


def solve(women_num, men_num, relation_num, relations):
    people_num = women_num + men_num
    full_relations = [[_MAX_COST for _ in range(people_num)] for _ in range(people_num)]
    for man_no, woman_no, relation in relations:
        if full_relations[man_no][men_num + woman_no] > _MAX_COST - relation:
            full_relations[man_no][men_num + woman_no] = _MAX_COST - relation
            full_relations[men_num + woman_no][man_no] = _MAX_COST - relation
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
        for first_person in team:
            for second_person in range(people_num):
                if second_person in team:
                    continue
                heappush(h, (full_relations[first_person][second_person], second_person))
    return cost + _MAX_COST * (people_num - len(team))

if __name__ == '__main__':
    print(datetime.now())
    print(71071 == solve(5, 5, 8, [(4, 3, 6831), (1, 3, 4583), (0, 0, 6592), (0, 1, 3063), (3, 3, 4975), (1, 3, 2049),
                                   (4, 2, 2104), (2, 2, 781)]))
    print(54223 == solve(5, 5, 10, [(2, 4, 9820), (3, 2, 6236), (3, 1, 8864), (2, 4, 8326), (2, 0, 5156), (2, 0, 1463),
                                    (4, 1, 2439), (0, 4, 4373), (3, 4, 8889), (2, 4, 3133)]))
    print(37989 == solve(2, 2, 3, [(0, 0, 1000), (0, 1, 10), (1, 1, 1001)]))
    print(datetime.now())
