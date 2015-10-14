

class SimpleBars(object):
    def __init__(self, bar):
        self.bar = bar

    def next(self):
        next_bar = ''
        bar_len = len(self.bar)
        for i in range(bar_len):
            if self.bar[i] == ' ':
                if i == 0 and bar_len == 1:
                    next_bar += ' '
                    continue
                if i == 0:
                    if self.bar[bar_len - 1] == 'i' and self.bar[1] == 'i':
                        next_bar += ' '
                        continue
                    if self.bar[bar_len - 1] == 'i' or self.bar[1] == 'i':
                        next_bar += 'i'
                        continue
                    next_bar += ' '
                    continue
                if i + 1 >= bar_len:
                    if self.bar[i - 1] == 'i' and self.bar[0] == 'i':
                        next_bar += ' '
                        continue
                    if self.bar[i - 1] == 'i' or self.bar[0] == 'i':
                        next_bar += 'i'
                        continue
                    next_bar += ' '
                    continue
                if self.bar[i - 1] == 'i' and self.bar[i + 1] == 'i':
                    next_bar += ' '
                    continue
                if self.bar[i - 1] == 'i' or self.bar[i + 1] == 'i':
                    next_bar += 'i'
                    continue
                next_bar += ' '
                continue
            if self.bar[i] == 'i':
                next_bar += 'T'
                continue
            if self.bar[i] == 'T':
                if i == 0 and bar_len == 1:
                    next_bar += 'i'
                    continue
                if i == 0:
                    if self.bar[bar_len - 1] == 'i' and self.bar[1] == 'i':
                        next_bar += 'i'
                        continue
                    if self.bar[bar_len - 1] == 'i' or self.bar[1] == 'i':
                        next_bar += ' '
                        continue
                    next_bar += 'i'
                    continue
                if i + 1 >= bar_len:
                    if self.bar[i - 1] == 'i' and self.bar[0] == 'i':
                        next_bar += 'i'
                        continue
                    if self.bar[i - 1] == 'i' or self.bar[0] == 'i':
                        next_bar += ' '
                        continue
                    next_bar += 'i'
                    continue
                if self.bar[i - 1] == 'i' and self.bar[i + 1] == 'i':
                    next_bar += 'i'
                    continue
                if self.bar[i - 1] == 'i' or self.bar[i + 1] == 'i':
                    next_bar += ' '
                    continue
                next_bar += 'i'
        self.bar = next_bar
        return self.bar

    def replace(self, index, word):
        next_bar = ''
        for i in range(len(self.bar)):
            if i != index:
                next_bar += self.bar[i]
                continue
            next_bar += word
        self.bar = next_bar

    def __len__(self):
        return len(self.bar)

    def __str__(self):
        return self.bar

    def __repr__(self):
        return self.__str__()


if __name__ == '__main__':
    import re

    bs = SimpleBars(' '*78)
    pos = 0; acc = 1; accx = 1; output = ""

    commands = "1(///(1iTiTiTi|||[(1 ])1( [L|[L|[L|[(] |1//)/)1i||1)///)1i||||1(///)1i(/////)1iTiTi[L!])|])[L!])])l|])1/( [(1/ ]L!l|[(1 ])1( //(1 ]L[L!|"

    for c in commands:
        if   c == "1": acc = 1
        elif c == "/": acc = acc * 2
        elif c == ")": pos += acc; pos %= len(bs)
        elif c == "(": pos -= acc; pos %= len(bs)
        elif c == "i" or c == "T" or c == " ":
            for i in range(acc): bs.replace(pos, c); pos += 1; pos %= len(bs)
        elif c == "]":
            s = str(bs)[pos:]+str(bs)[:pos+1];         m = re.search("^ *[iT]* ", s)
            acc = (m and m.end() - 1) or 0
        elif c == "[":
            t = str(bs); s = t[pos-1]+t[pos:]+t[:pos]; m = re.search(" [iT]* *$", s)
            acc = (m and len(s) - m.start() - 1) or 0
        elif c == "l": acc, accx = accx, acc
        elif c == "L": acc, accx = accx - acc, accx + acc
        elif c == "|": print(bs); bs.next()
        elif c == "!": output += chr((ord('0') + acc) % 128)

    print("answer: " + output)
