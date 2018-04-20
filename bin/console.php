#!/usr/bin/env php

<?php

require_once __DIR__ . '/../src/Bugs.php';

$longOptions = [
    'bugs:',
    'stones:'
];

$options = getopt('', $longOptions);
var_dump($options);
if (count($options) == 2) {
    try {
        $bugs = new Bugs($bugs = $options['bugs'], $stones = $options['stones']);
        var_dump($bugs);
        var_dump($bugs->lastBug());
    } catch (Exception $e) {
        printf('Exception: %s' . PHP_EOL, $e->getMessage());
    }
}