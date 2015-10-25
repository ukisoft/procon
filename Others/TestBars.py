
import unittest


class Bars(object):

    def __init__(self, initial):
        self.word = initial

    def next(self):
        _next = ''
        if len(self.word) == 1:
            if self.word == ' ':
                _next = ' '
            if self.word == 'i':
                _next = 'T'
            if self.word == 'T':
                _next = 'i'
            if self.word == 'I':
                _next = 'I'
            self.word = _next
            return self.word
        for i in range(len(self.word)):
            left = i - 1
            right = i + 1
            if i == 0:
                left = len(self.word) - 1
            if i == len(self.word) - 1:
                right = 0
            if self.word[i] == ' ':
                if self.word[left] == ' ' or self.word[left] == 'T':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += ' '
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += 'i'
                        continue
                if self.word[left] == 'i' or self.word[left] == 'I':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += 'i'
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += ' '
                        continue
            if self.word[i] == 'i':
                if self.word[left] == ' ' or self.word[left] == 'T':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += 'T'
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += 'I'
                        continue
                if self.word[left] == 'i' or self.word[left] == 'I':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += 'I'
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += 'T'
                        continue
            if self.word[i] == 'T':
                if self.word[left] == ' ' or self.word[left] == 'T':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += 'i'
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += ' '
                        continue
                if self.word[left] == 'i' or self.word[left] == 'I':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += ' '
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += 'i'
                        continue
            if self.word[i] == 'I':
                if self.word[left] == ' ' or self.word[left] == 'T':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += 'I'
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += 'T'
                        continue
                if self.word[left] == 'i' or self.word[left] == 'I':
                    if self.word[right] == ' ' or self.word[right] == 'T':
                        _next += 'T'
                        continue
                    if self.word[right] == 'i' or self.word[right] == 'I':
                        _next += 'I'
                        continue
        self.word = _next
        return self.word

    # not work well
    # def before(self):
    #     _before = ''
    #     if len(self.word) == 1:
    #         if self.word == ' ':
    #             _before = ' '
    #         if self.word == 'i':
    #             _before = 'T'
    #         if self.word == 'T':
    #             _before = 'i'
    #         if self.word == 'I':
    #             _before = 'I'
    #         self.word = _before
    #         return self.word
    #     prohibits = [set() for _ in range(len(self.word))]
    #     while True:
    #         end = True
    #         for i in range(len(self.word)):
    #             if len(prohibits[i]) == 3:
    #                 continue
    #             end = False
    #             left = i - 1
    #             right = i + 1
    #             if i == 0:
    #                 left = len(self.word) - 1
    #             if i == len(self.word) - 1:
    #                 right = 0
    #             if self.word[i] == ' ':
    #                 prohibits[i].add('i')
    #                 prohibits[i].add('I')
    #                 if ' ' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                 if 'T' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                 if ' ' in prohibits[right] and 'T' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add('T')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add(' ')
    #                 if 'i' in prohibits[right] and 'I' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add(' ')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add('T')
    #             if self.word[i] == 'i':
    #                 prohibits[i].add('i')
    #                 prohibits[i].add('I')
    #                 if ' ' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                 if 'T' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                 if ' ' in prohibits[right] and 'T' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add(' ')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add('T')
    #                 if 'i' in prohibits[right] and 'I' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add('T')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add(' ')
    #             if self.word[i] == 'T':
    #                 prohibits[i].add(' ')
    #                 prohibits[i].add('T')
    #                 if 'i' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                 if 'I' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                 if ' ' in prohibits[right] and 'T' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add('I')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add('i')
    #                 if 'i' in prohibits[right] and 'I' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add('i')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add('I')
    #             if self.word[i] == 'I':
    #                 prohibits[i].add(' ')
    #                 prohibits[i].add('T')
    #                 if 'i' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                 if 'I' in prohibits[i]:
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[right].add(' ')
    #                         prohibits[right].add('T')
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[right].add('i')
    #                         prohibits[right].add('I')
    #                 if ' ' in prohibits[right] and 'T' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add('i')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add('I')
    #                 if 'i' in prohibits[right] and 'I' in prohibits[right]:
    #                     if 'i' in prohibits[left] and 'I' in prohibits[left]:
    #                         prohibits[i].add('I')
    #                     if ' ' in prohibits[left] and 'T' in prohibits[left]:
    #                         prohibits[i].add('i')
    #         if end:
    #             break
    #     for prohibit in prohibits:
    #         for word in [' ', 'i', 'I', 'T']:
    #             if word not in prohibit:
    #                 _before += word
    #                 continue
    #     self.word = _before
    #     return self.word

    def __str__(self):
        return self.word

    def __repr__(self):
        return self.__str__()


class TestBars(unittest.TestCase):
    def setUp(self):
        pass

    def test_simple_rule(self):
        self.assertEquals(str(Bars("     ").next()), "     ")
        self.assertEquals(str(Bars("  i  ").next()), " iTi ")
        self.assertEquals(str(Bars(" i i ").next()), "iT Ti")
        self.assertEquals(str(Bars("  T  ").next()), "  i  ")
        self.assertEquals(str(Bars(" TiT ").next()), "  T  ")
        self.assertEquals(str(Bars(" iTi ").next()), "iTiTi")
        self.assertEquals(str(Bars(" TTT ").next()), " iii ")

    def test_rule(self):
        self.assertEquals(str(Bars(" I  ").next()), "iIi ")
        self.assertEquals(str(Bars(" ii ").next()), "iIIi")
        self.assertEquals(str(Bars(" Ii ").next()), "iTIi")
        self.assertEquals(str(Bars(" TI ").next()), "  Ii")
        self.assertEquals(str(Bars(" II ").next()), "iTTi")

    def test_loop(self):
        bs = Bars("Ti  ")
        self.assertEquals(str(bs.next()), " Ti ")
        self.assertEquals(str(bs.next()), "  Ti")
        self.assertEquals(str(bs.next()), "i  T")
        self.assertEquals(str(bs.next()), "Ti  ")
        bs = Bars("  iT")
        self.assertEquals(str(bs.next()), " iT ")
        self.assertEquals(str(bs.next()), "iT  ")
        self.assertEquals(str(bs.next()), "T  i")
        self.assertEquals(str(bs.next()), "  iT")

    def test_next(self):
        bs = Bars("I    IT ii  i I   I i   i   I  T")
        bs.next()
        self.assertEquals(str(bs), "Ii  iI iIIiiT Ii iI Ti iTi iIi  ")
        bs.next()
        self.assertEquals(str(bs), "TIiiIT IIITI iTI ITi T TiT IIIii")

    def tearDown(self):
        pass

MORSE_SIGNAL = {'iI': 'A', 'Iiii': 'B', 'IiIi': 'C', 'Iii': 'D', 'i': 'E', 'iiIi': 'F', 'IIi': 'G', 'iiii': 'H',
                'ii': 'I', 'iIII': 'J', 'IiI': 'K', 'iIii': 'L', 'II': 'M', 'Ii': 'N', 'III': 'O', 'iIIi': 'P',
                'IIiI': 'Q', 'iIi': 'R', 'iii': 'S', 'I': 'T', 'iiI': 'U', 'iiiI': 'V', 'iII': 'W', 'IiiI': 'X',
                'IiII': 'Y', 'IIii': 'Z', 'iIIII': '1', 'iiIII': '2', 'iiiII': '3', 'iiiiI': '4', 'iiiii': '5',
                'Iiiii': '6', 'IIiii': '7', 'IIIii': '8', 'IIIIi': '9', 'IIIII': '0'}


def decode_morse(target: str):
    decoded = ''
    for signal in target.split(' '):
        if len(signal) == 0:
            continue
        decoded += MORSE_SIGNAL[signal]
    return decoded


def find_next_answer():
    bs = Bars('I    IT ii  i I   I i   i   I  T')
    for i in range(26):
        print(bs)
        bs.next()
    print(bs)
    print(decode_morse(bs.__str__()))


def find_before_answer():
    bs = Bars('T i  I Iii  TTT')
    while True:
        before = bs.__str__()
        print(bs.next())
        if bs.__str__() == 'ITT TI I T TIii':
            print(decode_morse(before))
            return

if __name__ == "__main__":
    suite = unittest.TestSuite()
    suite.addTest(unittest.makeSuite(TestBars))
    unittest.TextTestRunner(verbosity=2).run(suite)
    find_next_answer()
    find_before_answer()
