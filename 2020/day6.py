def getGroups(file):
    f = open(file, 'r')
    return f.read().rstrip().split("\n\n")

def countAnsweredQuestions(group):
    return len(set([chr for chr in group.replace("\n", '')]))

def countCommonAnswers(answers):
    i = 0
    common = {}
    while i < len(answers):
        common = answers[i] if i == 0 else common & answers[i]
        i = i + 1
    return len(common)

firstTotal = 0
secondTotal = 0
for group in getGroups('./data/day6.txt'):
    firstTotal = firstTotal + countAnsweredQuestions(group)

    answers = []
    people = group.split("\n")
    for person in people:
        answers.append(set([chr for chr in person]))

    secondTotal += countCommonAnswers(answers)

print(f"First answer: {firstTotal}")
print(f"Second answer: {secondTotal}")
