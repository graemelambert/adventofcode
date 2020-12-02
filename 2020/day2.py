import re

f = open('./data/day2.txt', 'r')
data = []
for line in f.readlines():
    res = re.search("^([\d]+)-([\d]+) ([a-z]): ([a-z]+)$", line)
    data.append(dict(
        Min=int(res.group(1)),
        Max=int(res.group(2)),
        Letter=res.group(3),
        Password=res.group(4)
    ))

def firstAnswer(data):
    total = 0
    for row in data:
        count = len(re.findall(row['Letter'], row['Password']))
        if count >= row['Min'] and count <= row['Max']:
            total += 1
    print(f"First answer: {total} valid passwords")

firstAnswer(data)

def secondAnswer(data):
    total = 0
    for row in data:
        firstPos = row['Min'] - 1
        secondPos = row['Max'] - 1
        split = [chr for chr in row['Password']]
        if (split[firstPos] != split[secondPos] and (split[firstPos] == row['Letter'] or split[secondPos] == row['Letter'])):
            total += 1
    print(f"Second answer: {total} valid passwords")

secondAnswer(data)
