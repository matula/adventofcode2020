<?php

$entries = file('01.txt', FILE_IGNORE_NEW_LINES);
$values  = array_map('intval', $entries);
echo 'Part One: ' . getAnswerPartOne($values) . "\n";
echo 'Part Two: ' . getAnswerPartTwo($values) . "\n";

/**
 * Find the TWO entries that sum to 2020; what do you get if you multiply them together?
 * @param  array  $values
 * @return float|int
 */
function getAnswerPartOne(array $values)
{
    $totalValues = count($values);
    // Loop through all the values
    for ($i = 0; $i < $totalValues; $i++) {
        // Get the first value, then loop through the rest of the array
        $start = $values[$i];
        for ($y = ($i + 1); $y < $totalValues; $y++) {
            $end = $values[$y];
            if ($start + $end == 2020) {
                return $start * $end;
            }
        }
    }
}

/**
 * Find the THREE entries that sum to 2020; what do you get if you multiply them together?
 * @param  array  $values
 * @return float|int
 */
function getAnswerPartTwo(array $values)
{
    $totalValues = count($values);
    for ($i = 0; $i < $totalValues; $i++) {
        $start = $values[$i];
        for ($y = ($i + 1); $y < $totalValues; $y++) {
            $mid = $values[$y];
            for ($z = ($y + 1); $z < $totalValues; $z++) {
                $end = $values[$z];
                if ($start + $mid + $end == 2020) {
                    return $start * $mid * $end;
                }
            }
        }
    }
}
