<?php
    session_start();

    //setando a seção e colunas e linhas
    $cols = 0;
    $rows = 0;
    
    //Validando se foram enviadas as dificuldades e, consequentemente, setando as linhas e colunas
    if (isset($_POST['easy'])) {
        $cols = 4;
        $rows = 3;
    }
    elseif (isset($_POST['medium'])) {
        $cols = 4;
        $rows = 4;
    }
    elseif(isset($_POST['hard'])){
        $cols = 6;
        $rows = 6;
    }

    //Valido se foi enviado nome de algum player e já aproveito pra guardar na seção as respectivas dificuldades
    if (isset($_POST['player'])) {
        $_SESSION['player'] = $_POST['player'];
        if (isset($_POST['easy'])) {
            $_SESSION['difficulty'] = 'easy';
        }
        elseif (isset($_POST['medium'])) {
            $_SESSION['difficulty'] = 'medium';
        }
        elseif (isset($_POST['hard'])){
            $_SESSION['difficulty'] = 'hard';
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css"> 
    <title>Memory-game</title>
</head>
<body>
    <?php
    //Optei por fazer o jogo em uma unica pagina, pq tive a ideia do layout minimalista, então eu basicamente tenho uam condição que valida se o jogo está ou não acontecendo
    if ($cols === 0 && $rows === 0) {
    ?>
    <section class="center-container">
        <form action="" method="post">
            <div class="cozy-input">
                <input type="text" value="" class="quick600" name="player" placeholder="Digite seu nome aqui..." required>
            </div>
            <div class="difficulty">
                <input type="submit" value="Easy" class="quick700" name="easy" id="easy">
                <input type="submit" value="Medium" class="quick700" name="medium">
                <input type="submit" value="Hard" class="quick700" name="hard">
            </div>
        </form>
    </section>
    <?php
    } 
    else {
        $playerName = isset($_SESSION['player']) ? $_SESSION['player'] : 'Player 01';
        $difficulty = isset($_SESSION['difficulty']) ? $_SESSION['difficulty'] : 'easy';

        $numberOfCards = $cols * $rows;
        $maxNumberOfImages = 18;

        // Função de geração de cartas para cada nível
        function generateCardsEasy($maxNumberOfImages){
            $images = [];
        
            $usedNumbers = [];

            //Estava tendo um problema com o for, pois o meu pode rand gerar numeros aleatorios que correspondem a pares gerados anteriormente, ou seja, acaba levando a menos cartas
            while (count($usedNumbers) < 6) {
                $rand = rand(1, $maxNumberOfImages);
                
                //Verifiamos se o numero ja foi usado
                if (!in_array($rand, $usedNumbers)) {
                    array_push($images, $rand);
                    array_push($images, $rand);
                    //Numero já foi usado para não repetir
                    $usedNumbers[] = $rand;
                }
            }
        
            shuffle($images);
            return $images;
        }
        
        function generateCardsMedium($maxNumberOfImages){
            $images = [];
        
            $usedNumbers = [];
                  
            while (count($usedNumbers) < 8) {
                $rand = rand(1, $maxNumberOfImages);
                    
                //Verificamos se o numero ja foi usado
                if (!in_array($rand, $usedNumbers)) {
                    array_push($images, $rand);
                    array_push($images, $rand);
                    //Numero já foi usado para não repetir
                    $usedNumbers[] = $rand;
                }
            }
            
        
        
            shuffle($images);
            return $images;
        }

        function generateCardsHard($maxNumberOfImages){
            $images = [];
            for ($i = 1; $i <= $maxNumberOfImages; $i++) {
                array_push($images, $i - 1);
                array_push($images, $i - 1);
            }
            shuffle($images);
            return $images;
        }

        // Inicializar as variáveis de imagens para o nível selecionado
        if (isset($_POST['easy'])) {
            $images = generateCardsEasy($maxNumberOfImages);
        } elseif (isset($_POST['medium'])) {
            $images = generateCardsMedium($maxNumberOfImages);
        } elseif (isset($_POST['hard'])) {
            $images = generateCardsHard($maxNumberOfImages);
        }

        // Exibir as cartas
        echo "<div class='full-page'>";
        if (!empty($images)) { //Estou utilizando esse empty $images para verificar se o meu array ainda tem elementos antes de gerar qualquer carta, pois antes estavam sendo geradas cartas vazias
            echo "<section class='memory-game'>";
            for ($rowIndex = 0; $rowIndex < $rows; $rowIndex++) {
                echo '<div class="memory-col">';
                for ($colIndex = 0; $colIndex < $cols; $colIndex++) {
                    $takeCard = array_shift($images);
                    echo '<div class="memory-card" data-number=' . $takeCard . '>';
                    echo '<img class="up-card" src="./img/' . $takeCard . '.png" alt="">';
                    echo '<img class="down-card" src="./img/back-card.png" alt="">';
                    echo '</div>';
                }
                echo '</div>'; 
            }
            echo "</section>";
        
            echo "<section class='infos'>";
            echo "<div class='timer' id='timer'></div>";
            echo "<div class='attempts' id='attempts'></div>";
            echo "</section>";

            echo "<section class='popup invisible quick600' id='popup'>";
            echo "<div class='playerName quick600' id='playerName'>". "Nome do jogador: " . $playerName ."</div>";
            echo "<div class='score' id='score'></div>";
            echo "<button class='button-47' id='backButton'>Voltar</button>";
            echo "</section>";

            echo "</div>";
        }
        
        
    }
    
    ?>
    <script src="./js/memory-game.js"></script>
</body>
</html>
