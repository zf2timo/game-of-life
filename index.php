<?php

define('MATRIX_ROWS', 20);
define('MATRIX_COLUMNS', 60);

$matrix = [];
for ($row = 0; $row < MATRIX_ROWS; $row++) {
    for ($column = 0; $column < MATRIX_COLUMNS; $column++) {
        $matrix[ $row ][ $column ] = 0;
    }
}

// Static
$matrix[3][20] = 1;
$matrix[4][19] = 1;
$matrix[4][21] = 1;
$matrix[5][20] = 1;

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

for ($row = 0; $row < MATRIX_ROWS; $row++) {
    for ($column = 0; $column < MATRIX_COLUMNS; $column++) {
        echo $matrix[ $row ][ $column ] === 1 ? 'X' : '.';
    }
    echo PHP_EOL;
}

$generationCount = 10;
for ($generation = 0; $generation < $generationCount; $generation++) {
    echo str_repeat('*', 80) . PHP_EOL;
    $nextGenerationMatrix = $matrix;

    for ($row = 1; $row < MATRIX_ROWS - 1; $row++) {
        for ($column = 1; $column < MATRIX_COLUMNS - 1; $column++) {
            $livingNeighbor =
                $matrix[ $row - 1 ][ $column - 1 ] +
                $matrix[ $row - 1 ][ $column ] +
                $matrix[ $row - 1 ][ $column + 1 ] +

                $matrix[ $row ][ $column - 1 ] +
                $matrix[ $row ][ $column + 1 ] +

                $matrix[ $row + 1 ][ $column - 1 ] +
                $matrix[ $row + 1 ][ $column ] +
                $matrix[ $row + 1 ][ $column + 1 ];

            if ($matrix[$row][$column] === 1) {
                if ($livingNeighbor === 1) {
                    $nextGenerationMatrix[ $row ][ $column ] = 0;
                } elseif ($livingNeighbor === 2 || $livingNeighbor === 3) {
                    $nextGenerationMatrix[$row][$column] = 1;
                } elseif ($livingNeighbor > 3) {
                    $nextGenerationMatrix[$row][$column] = 0;
                }
            } elseif ($matrix[$row][$column] === 0) {
               if ($livingNeighbor === 3) {
                  $nextGenerationMatrix[$row][$column] = 1;
               }
            }
        }
    }

    for ($row = 0; $row < MATRIX_ROWS; $row++) {
        for ($column = 0; $column < MATRIX_COLUMNS; $column++) {
            echo $nextGenerationMatrix[ $row ][ $column ] === 1 ? 'X' : '.';
        }
        echo PHP_EOL;
    }

    $matrix = $nextGenerationMatrix;
}