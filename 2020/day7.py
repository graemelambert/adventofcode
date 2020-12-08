import re
f = open('./data/day7.txt', 'r')

def getBags():
    bags = {}
    for line in f.readlines():
        containIndex = line.find('contain')
        search = re.search('([\w ]+) bag[s]? contain', line)
        if search == None:
            continue
        bagColour = search.group(1)
        containsSearch = line[containIndex+len('contain'):-1].lstrip()
        if containsSearch == 'no other bags':
            continue
        contains = re.findall('([\d]+) ([\w ]+) bag[s]?', containsSearch)

        bag = {}
        for x in contains:
            bag[x[1]] = x[0]

        bags[bagColour] = bag
    return bags

def contains(bags, colour):
    result = []
    for bag in bags:
        if colour in bags[bag]:
            result.append(bag)
            nested = contains(bags, bag)
            result = result + nested
    return result

def countContents(colour):
    count = 0
    bag = bags[colour]
    if type(bag) is dict:
        for key,value in bag.items():
            count += int(value) + int(value) * countContents(key)
    return count

bags = getBags()

containsShinyGold = set(contains(bags, 'shiny gold'))
firstAnswer = len(containsShinyGold)
print(f"first answer = {firstAnswer}")

secondAnswer = countContents('shiny gold')
print(f"second answer = {secondAnswer}")
