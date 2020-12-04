import re

def getPassports():
    f = open('./data/day4.txt', 'r')
    passports = []
    for passport in f.read().split("\n\n"):
        rows = passport.replace("\n", ' ').rstrip().split(' ')
        passport = {}
        for x in rows:
            field, value = x.split(':')
            passport[field] = value
        passports.append(passport)
    return passports

def isValidBirthYear(value):
    return 1920 <= int(value) <= 2002

def isValidIssueYear(value):
    return 2010 <= int(value) <= 2020

def isValidExpirationYear(value):
    return 2020 <= int(value) <= 2030

def isValidHeight(value):
    return re.fullmatch(r'^((1[5-8][0-9]|19[0-3])cm)|((59|6[0-9]|7[0-6])in)$', value)

def isValidHairColour(value):
    return re.fullmatch(r'^#[0-9a-f]{6}$', value)

def isValidEyeColour(value):
    return value in ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']

def isValidPassportId(value):
    return re.fullmatch(r'^[0-9]{9}$', value)

def isValidPassport(passport):
    return isValidBirthYear(passport['byr']) and \
        isValidIssueYear(passport['iyr']) and \
        isValidExpirationYear(passport['eyr']) and \
        isValidHeight(passport['hgt']) and \
        isValidHairColour(passport['hcl']) and \
        isValidEyeColour(passport['ecl']) and \
        isValidPassportId(passport['pid'])

def hasRequiredFields(passport):
    required = ['ecl', 'pid', 'eyr', 'hcl', 'byr', 'iyr', 'hgt']
    valid = True
    for field in required:
        if field not in passport:
            valid = False
    return valid

passports = getPassports()
hasFieldsCount = 0
validPassportCount = 0
for passport in passports:
    if hasRequiredFields(passport):
        hasFieldsCount = hasFieldsCount + 1
        if isValidPassport(passport):
            validPassportCount = validPassportCount + 1

print(f"First answer: {hasFieldsCount}")
print(f"Second answer: {validPassportCount}")
