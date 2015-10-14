
from datetime import datetime


def solve(n, chains):
    """
    nとinfoを元に、つながりを表現する2次元配列を作る: 0がつながりなし、1がつながりありで未チェック、2がつながりありでチェック済み
    未チェックを総当りで調べる
    調べる際に、スタートと歩数を渡し続ける
    チェック済みと照らしあわせて、歩数が奇数であれば、その時点でNoを返す
    """
    global chain_table
    chain_table = {i: {j: 0 for j in range(n)} for i in range(n)}
    for first, second in chains:
        chain_table[first][second] = chain_table[second][first] = 1
    for node_no, chain_row in chain_table.items():
        for _node_no, step_sts in chain_row.items():
            if step_sts == 1:
                chain_table[node_no][_node_no] = chain_table[_node_no][node_no] = 2
                if _check_two_graph(_node_no, {node_no: 0}) is False:
                    return 'No'
    return 'Yes'


def _check_two_graph(target_node, steps):
    steps = {node_no: step + 1 for node_no, step in steps.items()}
    for node_no, step in steps.items():
        if node_no == target_node and step % 2 == 1:
            return False
    global chain_table
    for _node_no, step_sts in chain_table[target_node].items():
        if step_sts == 1:
            chain_table[target_node][_node_no] = chain_table[_node_no][target_node] = 2
            steps[target_node] = 0
            if _check_two_graph(_node_no, steps) is False:
                return False


if __name__ == '__main__':
    print(datetime.now())
    print('No' == solve(3, [(0, 1), (1, 2), (0, 2)]))
    print('Yes' == solve(4, [(0, 1), (1, 2), (2, 3), (0, 3)]))
    print('No' == solve(6, [(1, 2), (2, 3), (3, 4), (4, 5), (5, 1)]))
    print(datetime.now())
