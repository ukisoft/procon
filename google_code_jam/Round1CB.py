
test_case = int(input())

for case_no in range(test_case):
    result = ['Case #' + str(case_no + 1) + ':']
    inputs = input().split(' ')
    building_num = int(inputs[0])
    requested_route_num = int(inputs[1])
    if building_num <= requested_route_num:
        result.append('IMPOSSIBLE')
        print(' '.join(result))
        continue
    matrix = ['' for _ in range(building_num)]
    for i in range(building_num):
        for j in range(building_num):
            if j + 1 > building_num - i - 1:
                matrix[j] = '0' + matrix[j]
                continue
            if j + 1 <= building_num - i - 1 - requested_route_num:
                matrix[j] = '0' + matrix[j]
                continue
            matrix[j] = '1' + matrix[j]
    result.append('POSSIBLE')
    print(' '.join(result))
    for m in matrix:
        print(m)
