#!/usr/bin/python3

with open('02.txt') as file:
    count = 0
    for line in file.readlines():
        # break lines into parts
        splitLine = line.strip().split()
        # Get the upper and lower limits
        positions = splitLine[0].split('-')
        # Get the letter to look for
        letter = splitLine[1][:1]
        # get the password to check
        password = splitLine[2]
        totalLettersInPassword = password.count(letter)
        if totalLettersInPassword < int(positions[0]) or totalLettersInPassword > int(positions[1]):
            continue

        count = count + 1

    print('Correct letter amount total: ', count)

with open('02.txt') as file:
    count = 0
    for line in file.readlines():
        # break lines into parts
        splitLine = line.strip().split()
        # Get the first and last position
        positions = splitLine[0].split('-')
        first = int(positions[0])
        last = int(positions[1])
        # Get the letter to look for
        letter = splitLine[1][:1]
        # get the password to check
        password = splitLine[2]

        found = 0
        # loop through the characters in the string
        for i, character in enumerate(password):
            # found the letter at the first position
            if (i + 1) == first and character == letter:
                found += 1

            # found the letter at the last position
            if (i + 1) == last and character == letter:
                found += 1

        # If not found, or found in both positions, skip
        if found == 0 or found > 1:
            continue

        count += 1

    print('Correct position totals: ', count)
