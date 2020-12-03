<?php

$entries = file('02.txt', FILE_IGNORE_NEW_LINES);

echo 'Answer Part One: ' . getAnswerPartOne($entries) . "\n";
echo 'Answer Part Two: ' . getAnswerPartTwo($entries) . "\n";

/**
 * Each line gives the password policy and then the password. The password policy indicates the lowest and highest
 * number of times a given letter must appear for the password to be valid. For example, `1-3 a: aaaa` means that the
 * password `aaaa` must contain `a` at least 1 time and at most 3 times.
 * @param  array  $values
 * @return float|int
 */
function getAnswerPartOne(array $values)
{
    $totalFound = 0;
    foreach ($values as $value) {
        // Separate each line
        $parts = explode(' ', $value);
        // Put the lower and upper limits into an array
        $limits = explode('-', $parts[0]);
        // Get the letter to check for
        $contains = trim($parts[1], ":\t\n\r\0\x0B");
        // Put letters into array
        $passwordParts = str_split($parts[2]);

        // The letter is not found, skip
        if (!in_array($contains, $passwordParts)) {
            continue;
        }

        // Add the letters as a key, with total count as value
        $arrayValues = array_count_values($passwordParts);
        // Number of times the character is repeated
        $containsNumber = $arrayValues[$contains];

        // Outside the limits
        if ($containsNumber < $limits[0] || $containsNumber > $limits[1]) {
            continue;
        }

        $totalFound++;
    }

    return $totalFound;
}

/**
 * Two positions in the password, where 1 means the first character, 2 means the second character, and so on.
 * (Be careful; No concept of "index zero"!) Exactly one of these positions must contain the given letter.
 * @param  array  $values
 * @return int
 */
function getAnswerPartTwo(array $values)
{
    $totalFound = 0;
    foreach ($values as $value) {
        // Separate each line
        $parts = explode(' ', $value);
        // Put the lower and upper positions into an array
        $positions = explode('-', $parts[0]);
        // Get the letter to check for
        $contains = trim(str_replace(':', '', $parts[1]));

        // Letter not in either position
        if ($parts[2][($positions[0] - 1)] != $contains && $parts[2][($positions[1] - 1)] != $contains) {
            continue;
        }

        // Letter in BOTH positions
        if ($parts[2][($positions[0] - 1)] == $contains && $parts[2][($positions[1] - 1)] == $contains) {
            continue;
        }

        $totalFound++;
    }

    return $totalFound;
}
