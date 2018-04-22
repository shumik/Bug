#!/usr/bin/env php

<?php

require_once __DIR__ . '/../src/Bugs.php';

$longOptions = [
    'bugs:',
    'stones:'
];

$options = getopt('', $longOptions);

if (count($options) == 2) {
    try {
        $bugs = new Bugs($bugs = $options['bugs'], $stones = $options['stones']);
        print_r($bugs->lastBug());
    } catch (Exception $e) {
        printf('Exception: %s' . PHP_EOL, $e->getMessage());
    }
} else {
    echo 'Usage: bin/console --bugs [number of bugs] --stones [number of stones]' . PHP_EOL;
}