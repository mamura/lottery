<?php
require 'src/lottery.php';

$lottery = new Lottery(6,6);
var_dump($lottery->gerarJogos());