

class Fractile(object):

    @classmethod
    def _get_originals(cls, num):
        originals = ['']
        for i in range(num):
            _originals = []
            for original in originals:
                _originals.append(original + 'G')
                _originals.append(original + 'L')
            originals = _originals
        return originals

    @classmethod
    def get_all_tile_patterns(cls, K, C):
        tile_patterns = []
        for original in cls._get_originals(K):
            next_words = original
            _next_words = ''
            for _ in range(C - 1):
                for i in range(len(next_words)):
                    if next_words[i] == 'L':
                        _next_words += original
                        continue
                    _next_words += 'G' * len(original)
                next_words = _next_words
            tile_patterns.append(next_words)
        return tile_patterns

    @classmethod
    def find_L_nums(cls, tile_patterns):
        nums = {}
        for tile_pattern in tile_patterns:
            for k in range(len(tile_pattern)):
                if tile_pattern[k] == 'L':
                    nums.setdefault(k, 0)
                    nums[k] += 1
        return nums

tile_patterns = Fractile.get_all_tile_patterns(3, 2)
print(Fractile.find_L_nums(tile_patterns))
