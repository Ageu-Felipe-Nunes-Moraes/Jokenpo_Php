
<?php

class Jokenpo{
        // Propriedades relacionadas à escolha do jogador e da máquina
        private $escolha_maquina; // Escolha aleatória da máquina
        private $escolha_humano;  // Escolha do jogador humano
        
        // Propriedades relacionadas às opções disponíveis e controle do jogo
        private $lista_opcoes;        // Lista de opções disponíveis para o jogador
        private $escolha_pessoa;      // Escolha do jogador humano
        private $quantidade_escolhida; // Quantidade escolhida de pontos de tempo de espera
        private $variavel_controle;    // Variável de controle para o jogo
        
        // Propriedade relacionada ao segundo aleatório
        private $indice_segundo_aleatorio; // Índice do segundo escolhido aleatoriamente

    public function __construct(){
        $this->cria_linha_dupla();
        echo "JOKENPÔ - CONTRA O COMPUTADOR\n";
        $this->cria_linha_dupla();
        $this->escolha_pessoa = 0;
        $this->escolha_maquina = "";
        $this->escolha_humano = 0;
        $this->variavel_controle = true;
        $this->lista_opcoes = array("PEDRA", "PAPEL", "TESOURA");
        $this->escolha = "";
        $this->indice_segundo_aleatorio = 0.0;
    }


    public function tempo_delay(){
        echo "COMPUTADOR PENSANDO...\n";
        $this->lista_quantidade_pontos = array(2, 3, 4, 5);

        // Escolha aleatória de um índice dentro do intervalo válido
        $this->indice_aleatorio = array_rand($this->lista_quantidade_pontos);

        // Item escolhido aleatoriamente
        $this->quantidade_escolhida = $this->lista_quantidade_pontos[$this->indice_aleatorio];

        for ($i = 0; $i < $this->quantidade_escolhida; $i++){
            $this->lista_segundos = array(1, 2);
            $this->indice_segundo_aleatorio = array_rand($this->lista_segundos);
            $this->segundo_escolhido = $this->lista_segundos[$this->indice_segundo_aleatorio];
            sleep($this->segundo_escolhido);
            echo ".\n";
        }
        $this->cria_linha_dupla();
    }

    public function cria_linha_dupla(){
        echo "\n========================================\n";
    }

    public function cria_linha_simples(){
        echo "\n----------------------------------------\n";
    }

    public function introducao(){
        echo "INSTRUCÕES DE COMO JOGAR: \n";
        $this->cria_linha_simples();
        echo "1--PEDRA\n";
        echo "2--PAPEL\n";
        echo "3--TESOURA\n";
        echo "0--SAIR\n";
        $this->cria_linha_simples();
    }

    public function valor_escolha_computador(){
        // Escolha aleatória de um índice dentro do intervalo válido
        $this->indice_aleatorio = array_rand($this->lista_opcoes);

        // Item escolhido aleatoriamente
        $this->escolha = $this->lista_opcoes[$this->indice_aleatorio];

        return $this->escolha;
    }

    public function valor_escolha_pessoa(){
        echo "DIGITE O NÚMERO DA SUA ESCOLHA: ";
        $this->escolha_pessoa = readline();
        $this->cria_linha_simples();
        return $this->escolha_pessoa;
    }

    public function mostra_escolhas(){
   
        while ($this->variavel_controle){
            $this->escolha_pessoa = $this->valor_escolha_pessoa();
            
            if ($this->escolha_pessoa == 0){
                echo "FIM DE JOGO!!!\n";
                $this->variavel_controle = false;
            }

            elseif ($this->escolha_pessoa > 0 && $this->escolha_pessoa < 4){
                $this->tempo_delay();
                $this->escolha_maquina = $this->valor_escolha_computador();
                $this->escolha_humano = $this->lista_opcoes[$this->escolha_pessoa - 1];
                echo "HUMANO(VOCÊ): $this->escolha_humano\n";
                echo "COMPUTADOR: $this->escolha_maquina\n";
                $this->cria_linha_simples();
                $this->verifica_vencedor();
                $this->variavel_controle = false;
            }

            else{
                echo "VALOR INVÁLIDO!!! TENTE NOVAMENTE!!\n";
                $this->cria_linha_dupla();
            }
        }
    }

    public function verifica_vencedor(){
        if ($this->lista_opcoes[$this->escolha_pessoa - 1] == $this->escolha_maquina){
            echo "EMPATE!!!\n";
        }

        else{
                
            if (
                ($this->lista_opcoes[$this->escolha_pessoa - 1] == "PEDRA" && $this->escolha_maquina == "TESOURA") ||
                ($this->lista_opcoes[$this->escolha_pessoa - 1] == "PAPEL" && $this->escolha_maquina == "PEDRA") ||
                ($this->lista_opcoes[$this->escolha_pessoa - 1] == "TESOURA" && $this->escolha_maquina == "PAPEL")
            ){

                echo "VOCÊ VENCEU!!!\n";
            }

            elseif ($this->escolha_pessoa == 0){
                echo "\n";
            }
                
            else{
                echo "VOCÊ PERDEU\n";
            }
        }
        if ($this->escolha_pessoa != 0){
            $this->cria_linha_dupla();
            $this->mostra_escolhas();
        }
    }
};


$iniciar_jogo = new Jokenpo;
$iniciar_jogo->introducao();
$iniciar_jogo->mostra_escolhas();

?>
