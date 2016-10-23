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

$matrix[3][10] = 1;
$matrix[4][9]  = 1;
$matrix[4][11] = 1;
$matrix[5][10] = 1;

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

$generationCount = 1;
for ($generation = 0; $generation < $generationCount; $generation++) {
    echo str_repeat('-', 80) . PHP_EOL;
    $nextGenerationMatrix = $matrix;

    for ($row = 1; $row < MATRIX_ROWS - 1; $row++) {
        for ($column = 1; $column < MATRIX_COLUMNS - 1; $column++) {
            if ($matrix[ $row ][ $column ] === 1) {
                $livingNeighbor =
                    $matrix[ $row - 1 ][ $column - 1 ] +
                    $matrix[ $row - 1 ][ $column ] +
                    $matrix[ $row - 1 ][ $column + 1 ] +

                    $matrix[ $row ][ $column - 1 ] +
                    $matrix[ $row ][ $column + 1 ] +

                    $matrix[ $row + 1 ][ $column - 1 ] +
                    $matrix[ $row + 1 ][ $column ] +
                    $matrix[ $row + 1 ][ $column + 1 ];

                if ($livingNeighbor === 3 || $livingNeighbor === 2) {
                    $nextGenerationMatrix[ $row ][ $column ] = 1;
                } elseif ($livingNeighbor === 1 || $livingNeighbor > 3) {
                    $nextGenerationMatrix[ $row ][ $column ] = 0;
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