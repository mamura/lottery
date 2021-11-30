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

    public function gerarJogos() : void
    {
        for ($row = 0; $row < $this->totalJogos; $row++) {
            $jogos[] = $this->gerarDezenas($this->quantidadeDezenas);
        }

        $this->setJogos($jogos);
    }

    public function realizarSorteio() : void
    {
        $array = [];

        for ($i = 1; $i <= 6; $i++) {
            $valor = rand(1, 60);
            (!in_array($valor, $array)) ? array_push($array, $valor) : $i--;
        }

        sort($array);

        $this->setResultado($array);
    }

    public function confereJogos() : string
    {
        $table = '<table>';
        foreach ($this->getJogos() as $key => $jogo) {
            $table .= '<tr><th colspan='.$this->quantidadeDezenas.'>Jogo ' . ($key+1) . '</th></tr>';
            $table .= '<tr>';
            foreach ($jogo as $j) {
                if (in_array($j, $this->getResultado())) {
                    $table .= '<td><s>' . $j . '</s></td>';
                }
                else {
                    $table .= '<td>' . $j . '</td>';
                }
            }
            $table .= '</tr>';
        }

        $table .= '</table>';
        return $table;
    }

    private function verificaDezenas($dezena) : int
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
