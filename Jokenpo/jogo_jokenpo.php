
<?php

class Jokenpo{
        // Propriedades relacionadas à escolha do jogador e da máquina
        private $machineChoice; // Escolha aleatória da máquina
        private $humanChoice;  // Escolha do jogador humano
        
        // Propriedades relacionadas às opções disponíveis e controle do jogo
        private $optionsList;        // Lista de opções disponíveis para o jogador
        private $personChoice;      // Escolha do jogador humano
        private $quantityChosen; // Quantidade escolhida de pontos de tempo de espera
        private $controlVariable;    // Variável de controle para o jogo
        
        // Propriedade relacionada ao segundo aleatório
        private $secondRandomIndex; // Índice do segundo escolhido aleatoriamente

    public function __construct(){
        $this->creatsDoubleLine();
        echo "JOKENPÔ - CONTRA O COMPUTADOR\n";
        $this->creatsDoubleLine();
        $this->personChoice = 0;
        $this->machineChoice = "";
        $this->humanChoice = 0;
        $this->controlVariable = true;
        $this->optionsList = array("PEDRA", "PAPEL", "TESOURA");
        $this->choice = "";
        $this->secondRandomIndex = 0.0;
    }


    public function delayTime(){
        echo "COMPUTADOR PENSANDO...\n";
        $this->PointsQuantityList = array(2, 3, 4, 5);

        // Escolha aleatória de um índice dentro do intervalo válido
        $this->randomIndex = array_rand($this->PointsQuantityList);

        // Item escolhido aleatoriamente
        $this->quantityChosen = $this->PointsQuantityList[$this->randomIndex];

        for ($i = 0; $i < $this->quantityChosen; $i++){
            $this->secondsList = array(1, 2);
            $this->secondRandomIndex = array_rand($this->secondsList);
            $this->secondChosen = $this->secondsList[$this->secondRandomIndex];
            sleep($this->secondChosen);
            echo ".\n";
        }
        $this->creatsDoubleLine();
    }

    public function creatsDoubleLine(){
        echo "\n========================================\n";
    }

    public function creatsSimpleLine(){
        echo "\n----------------------------------------\n";
    }

    public function introduction(){
        echo "INSTRUCÕES DE COMO JOGAR: \n";
        $this->creatsSimpleLine();
        echo "1--PEDRA\n";
        echo "2--PAPEL\n";
        echo "3--TESOURA\n";
        echo "0--SAIR\n";
        $this->creatsSimpleLine();
    }

    public function computerChoiceValue(){
        // Escolha aleatória de um índice dentro do intervalo válido
        $this->randomIndex = array_rand($this->optionsList);

        // Item escolhido aleatoriamente
        $this->choice = $this->optionsList[$this->randomIndex];

        return $this->choice;
    }

    public function personChoiceValue(){
        echo "DIGITE O NÚMERO DA SUA ESCOLHA: ";
        $this->personChoice = readline();
        $this->creatsSimpleLine();
        return $this->personChoice;
    }

    public function showChoices(){
   
        while ($this->controlVariable){
            $this->personChoice = $this->personChoiceValue();
            
            if ($this->personChoice == 0){
                echo "FIM DE JOGO!!!\n";
                $this->controlVariable = false;
            }

            elseif ($this->personChoice > 0 && $this->personChoice < 4){
                $this->delayTime();
                $this->machineChoice = $this->computerChoiceValue();
                $this->humanChoice = $this->optionsList[$this->personChoice - 1];
                echo "HUMANO(VOCÊ): $this->humanChoice\n";
                echo "COMPUTADOR: $this->machineChoice\n";
                $this->creatsSimpleLine();
                $this->checksWinner();
                $this->controlVariable = false;
            }

            else{
                echo "VALOR INVÁLIDO!!! TENTE NOVAMENTE!!\n";
                $this->creatsDoubleLine();
            }
        }
    }

    public function checksWinner(){
        if ($this->optionsList[$this->personChoice - 1] == $this->machineChoice){
            echo "EMPATE!!!\n";
        }

        else{
                
            if (
                ($this->optionsList[$this->personChoice - 1] == "PEDRA" && $this->machineChoice == "TESOURA") ||
                ($this->optionsList[$this->personChoice - 1] == "PAPEL" && $this->machineChoice == "PEDRA") ||
                ($this->optionsList[$this->personChoice - 1] == "TESOURA" && $this->machineChoice == "PAPEL")
            ){

                echo "VOCÊ VENCEU!!!\n";
            }

            elseif ($this->personChoice == 0){
                echo "\n";
            }
                
            else{
                echo "VOCÊ PERDEU\n";
            }
        }
        if ($this->personChoice != 0){
            $this->creatsDoubleLine();
            $this->showChoices();
        }
    }
}

$startGame = new Jokenpo;
$startGame->introduction();
$startGame->showChoices();

?>
