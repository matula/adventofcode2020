<?php

$lines = file('03.txt', FILE_IGNORE_NEW_LINES);
//$lines = file('03test.txt', FILE_IGNORE_NEW_LINES);

$oneSlope = [
    [3, 1]
];

echo 'Part 1: ' . getTotalTrees($lines, $oneSlope, false) . "\n";

$multipleSlopes = [
    [1, 1],
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2]
];
echo 'Part 2: ' . getTotalTrees($lines, $multipleSlopes, true) . "\n";

/**
 * @param $lines
 * @param  array  $slopes
 * @param  false  $getMultiple  - multiply the values? or just return the total
 * @return float|int
 */
function getTotalTrees($lines, array $slopes, $getMultiple = false)
{
    $treeMulti  = 1;
    $totalTrees = 0;
    foreach ($slopes as $slope) {
        $left          = $slope[0];
        $down          = $slope[1];
        $totalTrees    = 0;
        $nextLineIndex = (0 + $down);

        foreach ($lines as $lineIndex => $line) {
            // If the row index we need isn't correct, go to the next one
            if (($lineIndex + $down) != $nextLineIndex) {
                continue;
            }

            // End of the rows
            if (empty($lines[$nextLineIndex])) {
                break;
            }

            // Reset when we get to the end of the line
            $lineLength = strlen($line);
            if ($left > ($lineLength - 1)) {
                $left = $left - $lineLength;
            }

            $character = $lines[$nextLineIndex][$left];

            if ($character == '#') {
                // Update total tree count
                $totalTrees++;
            }

            // Update the indexes needed for the next loop
            $left          = $left + $slope[0];
            $nextLineIndex = $nextLineIndex + $down;
        }

        // Multiply the values together
        $treeMulti = $treeMulti * $totalTrees;
    }

    return $getMultiple ? $treeMulti : $totalTrees;
}
