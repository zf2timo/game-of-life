<?php

define('MATRIX_ROWS', 20);
define('MATRIX_COLUMNS', 50);

$matrix = [];
for ($row = 0; $row < MATRIX_ROWS; $row++) {
    for ($column = 0; $column < MATRIX_COLUMNS; $column++) {
        $matrix[$row][$column] = 0;
    }
}

// Create Blinker
$matrix[3][5] = 1;
$matrix[3][6] = 1;
$matrix[3][7] = 1;

// Create Glider
$matrix[6][4] = 1;
$matrix[7][5] = 1;
$matrix[8][3] = 1;
$matrix[8][4] = 1;
$matrix[8][5] = 1;

$generationCount = 10;
for ($generation = 0; $generation < $generationCount; $generation++) {
    $nextGenerationMatrix = clone $matrix;

    for ($row = 0; $row < MATRIX_ROWS; $row++) {
        for ($column = 0; $column < MATRIX_COLUMNS; $column++) {
            if ($matrix[$row][$column] === 'X') {
                if (($matrix[$row - 1][$column - 1] + $matrix[$row - 1][$column] + $matrix[$row - 1][$column + 1] +
                        $matrix[$row][$column - 1] + $matrix[$row][$column + 1] +
                        $matrix[$row + 1][$column - 1] + $matrix[$row + 1][$column] + $matrix[$row + 1][$column + 1]) === 3
                ) {

                }
            }
        }
    }

    $matrix = $nextGenerationMatrix;
}