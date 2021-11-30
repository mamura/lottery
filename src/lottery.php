<?php

class Lottery
{
    private $quantidadeDezenas;
    private $resultado;
    private $totalJogos;
    private $jogos;

    function __construct($quantidadeDezenas, $totalJogos)
    {
        if ($this->verificaDezenas($quantidadeDezenas)) {
            $this->quantidadeDezenas = $quantidadeDezenas;
        }

        $this->totalJogos = $totalJogos;
    }

    public function getQuantidadeDezenas()
    {
        return $this->quantidadeDezenas;
    }

    public function setQuantidadeDezenas($quantidadeDezenas)
    {
        $this->quantidadeDezenas = $quantidadeDezenas;
    }

    public function getResultado()
    {
        return $this->resultado;
    }

    public function setResultado($resultado)
    {
        $this->resultado = $resultado;
    }

    public function getTotalJogos()
    {
        return $this->totalJogos;
    }

    public function setTotalJogos($totalJogos)
    {
        $this->totalJogos = $totalJogos;
    }

    public function getJogos()
    {
        return $this->jogos;
    }

    public function setJogos($jogos)
    {
        $this->jogos = $jogos;
    }

    public function gerarJogos()
    {
        for ($row = 0; $row < $this->totalJogos; $row++) {
            $jogos[] = $this->gerarDezenas($this->quantidadeDezenas);
        }
var_dump($jogos);
        $this->setJogos($jogos);
    }

    private function verificaDezenas($dezena)
    {
        try {
            $dezena = filter_var(
                $dezena,
                FILTER_VALIDATE_INT,
                [
                    'options' => [
                        'min_range' => 6,
                        'max_range' => 10
                    ]
                ]
            );

            if ($dezena == false || $dezena == NULL) {
                throw new Exception("Dezena Inválida!");
            }

            return $dezena;

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    private function gerarDezenas()
    {
        $array = [];

        for ($i = 1; $i <= $this->quantidadeDezenas; $i++) {
            $valor   =  rand(1, 60);
            (!in_array($valor, $array)) ? array_push($array, $valor) : $i--;
        }

        sort($array);
        return $array;
    }
}
