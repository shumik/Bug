<?php

require_once 'src/Bugs.php';


$bugs = new Bugs($bugs = 8, $stones = 19);
var_dump($bugs->lastBug());