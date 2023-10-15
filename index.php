<?php
    session_start();

    $cols = 0;
    $rows = 0;
    $_SESSION['player'];
    

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
    
    if ($cols === 0 && $rows === 0) {
    ?>
    <section class="center-container">
        <form action="" method="post">
            <div class="cozy-input">
                <input type="text" value="" class="quick600" name="player" placeholder="Digite seu nome aqui...">
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

        $numberOfCards = $cols * $rows;
        $maxNumberOfImages = 18;
        $images = [];

        // Função de geração de cartas para cada nível
        function generateCardsEasy($maxNumberOfImages)
        {
            $images = [];
        
            $usedNumbers = [];
        
            for ($i=1; $i <= 6 ; $i++) { 
                  
                $rand = rand(1, $maxNumberOfImages);
        
                // Verifique se o número ainda não foi usado
                if (!in_array($rand, $usedNumbers)) {
                    array_push($images, $rand);
                    array_push($images, $rand);
        
                    // Marque o número como usado
                    $usedNumbers[] = $rand;
                }
            }
        
            shuffle($images);
            return $images;
        }
        
        function generateCardsMedium($maxNumberOfImages)
        {
            $images = [];
        
            $usedNumbers = [];
        
            for ($i=1; $i <= 8 ; $i++) { 
                  
                $rand = rand(1, $maxNumberOfImages);
        
                // Verifique se o número ainda não foi usado
                if (!in_array($rand, $usedNumbers)) {
                    array_push($images, $rand);
                    array_push($images, $rand);
        
                    // Marque o número como usado
                    $usedNumbers[] = $rand;
                }
            }
        
            shuffle($images);
            return $images;
        }

        function generateCardsHard($maxNumberOfImages)
        {
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
            echo '</div>'; // Fechando a linha
        }
        echo "</section>";
    
        echo "<section class='infos'>";
        echo "<div class='timer' id='timer'></div>";
        echo "<div class='attempts' id='attempts'></div>";
        echo "</section>";
        echo "</div>";
        
    }
    
    ?>
    <script src="./js/memory-game.js"></script>
</body>
</html>
