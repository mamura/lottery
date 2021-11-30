<?php
require 'src/lottery.php';

$lottery = new Lottery(6,1);
var_dump($lottery->arrocha());