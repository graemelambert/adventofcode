f = open('./data/day1.txt', 'r')
numbers = []
for line in f.readlines():
    numbers.append(int(line))

def firstAnswer(numbers):
    for x in numbers:
        for y in numbers:
            if x + y == 2020:
                print("First answer results:")
                print(f"\t{x} + {y} is 2020")
                print(f"\tanswer = {x * y}")
                return
firstAnswer(numbers)

def secondAnswer(numbers):
    for x in numbers:
        for y in numbers:
            for z in numbers:
                if x + y + z == 2020:
                    print("Second answer results:")
                    print(f"\t{x} + {y} + {z} is 2020")
                    print(f"\tanswer = {x * y * z}")
                    return
secondAnswer(numbers)
