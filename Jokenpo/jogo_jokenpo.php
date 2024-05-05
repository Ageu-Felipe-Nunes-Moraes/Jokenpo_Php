
<?php

class Jokenpo{
        // Properties related to player choice and machine
        private $machineChoice; // Random machine choice
        private $humanChoice;  // Player choice
        
        // Properties related to available options and game control
        private $optionsList;        // List of options available to the player
        private $personChoice;      // Human player choice
        private $quantityChosen; // Number of time points chosen to wait
        private $controlVariable;    // Control variable for the game
        
        // Properties related to the random second
        private $secondRandomIndex; // Randomly chosen index second

    // Constructor Method
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

    // Method to delay time
    public function delayTime(){
        echo "COMPUTADOR PENSANDO...\n";
        $this->PointsQuantityList = array(2, 3, 4, 5);

        // Randomly choosing an index from a valid range
        $this->randomIndex = array_rand($this->PointsQuantityList);

        // Randomly chosen item
        $this->quantityChosen = $this->PointsQuantityList[$this->randomIndex];

        // Choice of a random time for the computer to respond
        for ($i = 0; $i < $this->quantityChosen; $i++){
            $this->secondsList = array(1, 2);
            $this->secondRandomIndex = array_rand($this->secondsList);
            $this->secondChosen = $this->secondsList[$this->secondRandomIndex];
            sleep($this->secondChosen);
            echo ".\n";
        }
        $this->creatsDoubleLine();
    }
    // Creates double line on screen
    public function creatsDoubleLine(){
        echo "\n========================================\n";
    }
    // Creates simple line on screen
    public function creatsSimpleLine(){
        echo "\n----------------------------------------\n";
    }
    // Shows initial information
    public function introduction(){
        echo "INSTRUCÕES DE COMO JOGAR: \n";
        $this->creatsSimpleLine();
        echo "1--PEDRA\n";
        echo "2--PAPEL\n";
        echo "3--TESOURA\n";
        echo "0--SAIR\n";
        $this->creatsSimpleLine();
    }
    // Function to computer choice
    public function computerChoiceValue(){
        // Randomly choosing an index from a valid range
        $this->randomIndex = array_rand($this->optionsList);

        // Randomly chosen item
        $this->choice = $this->optionsList[$this->randomIndex];

        return $this->choice;
    }
    // Function to person choice
    public function personChoiceValue(){
        echo "DIGITE O NÚMERO DA SUA ESCOLHA: ";
        $this->personChoice = readline();
        $this->creatsSimpleLine();
        return $this->personChoice;
    }
    // Show both choices
    public function showChoices(){
        // Will happen as long as the variable is True
        while ($this->controlVariable){
            $this->personChoice = $this->personChoiceValue();
            // If the choice is equal to zero, the game is over
            if ($this->personChoice == 0){
                echo "FIM DE JOGO!!!\n";
                $this->controlVariable = false;
            }
            // Shows picks, call delay, simple line and winner
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
            // Error treatment
            else{
                echo "VALOR INVÁLIDO!!! TENTE NOVAMENTE!!\n";
                $this->creatsDoubleLine();
            }
        }
    }
    // Checks winner
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

// Instance with functions calls
$startGame = new Jokenpo;
$startGame->introduction();
$startGame->showChoices();

?>
