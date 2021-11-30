<?php
require 'src/lottery.php';

$lottery = new Lottery(9,6);
$lottery->gerarJogos();
$lottery->realizarSorteio();
echo ($lottery->confereJogos());