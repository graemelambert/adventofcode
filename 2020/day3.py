def countTreesAlongSlope(data, right, down):
    x = 0
    y = 0

    trees = 0
    while y <= len(data):
        x = x + right
        y = y + down
        try:
            line = data[y]
        except IndexError:
            break
        while x >= len(line):
            line = line + line
        chr = line[x]
        if chr == '#':
            trees = trees + 1
    return trees

f = open('./data/day3.txt', 'r')
data = []
for line in f.readlines():
    data.append([chr for chr in line.rstrip()])

firstAnswer = countTreesAlongSlope(data, 3, 1)
print(f"First Answer: we have {firstAnswer} trees")

slope1 = countTreesAlongSlope(data, 1, 1)
slope2 = firstAnswer
slope3 = countTreesAlongSlope(data, 5, 1)
slope4 = countTreesAlongSlope(data, 7, 1)
slope5 = countTreesAlongSlope(data, 1, 2)

secondAnswer = slope1 * slope2 * slope3 * slope4 * slope5
print(f"Second Answer: {secondAnswer}")
