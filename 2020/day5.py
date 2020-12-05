import math

f = open('./data/day5.txt', 'r')

def getValue(steps, min, max, forward, backward):
    val = 0
    for step in steps:
        halfDiff = round((max - min) / 2)
        if step == forward:
            max = max - halfDiff
            val = min
        if step == backward:
            min = min + halfDiff
            val = max
    return val

passes = []
for seat in f.readlines():
    row = getValue([chr for chr in seat[0:7]], 0, 127, 'F', 'B')
    column = getValue([chr for chr in seat[7:10]], 0, 7, 'L', 'R')
    id = row * 8 + column
    passes.append(id)

passes.sort()
print(f"First answer: {passes[-1]}")

for x in range(passes[0], passes[-1]):
    if x not in passes:
        print(f"Second answer: {x}")
