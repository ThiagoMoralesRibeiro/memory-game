<?php
    $cols = 0;
    $rows = 0;

    if (isset($_POST['easy'])) {
        $cols = 4;
        $rows = 4;
    }
    elseif (isset($_POST['medium'])) {
        $cols = 5;
        $rows = 5;
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
            <input type="submit" value="Easy" name="easy" id="easy">
            <input type="submit" value="Medium" name="medium">
            <input type="submit" value="Hard" name="hard">
            <input type="submit" value="tutorial" name="tutorial">
        </form>
    </section>
    <?php
    } 
    else {
        $numberOfCards = $cols * $rows;
        $numberOfImages = $numberOfCards / 2;

        //Necessito sempre ter uma réplica da minha imagem



        //echo 'Colunas: '. $cols;
        //echo ' Linhas: '. $rows;
       
        //echo "<br>".$numberOfCards. "<br>";
        $maxNumberOfImages = 18;
        $images =[];

        //echo $numberOfImages;
        for ($i = 1; $i <= $maxNumberOfImages; $i++) { 
            array_push($images, $i);
            if (in_array($i, $images)) {
                array_push($images, $i);
            }
            
        }
        shuffle($images);

        if (!empty($images)) {
            echo "<section class='memory-game'>";
            for ($rowIndex = 0; $rowIndex < $rows; $rowIndex++) {
                echo '<div class="memory-col">';
                for ($colIndex = 0; $colIndex < $cols; $colIndex++) {
                    $takeCard = array_shift($images);
                    echo '<div class="memory-card" data-number=' . $takeCard . '>';
                    if (isset($images)) {
                        echo '<img class="up-card" src="./img/' . $takeCard . '.png" alt="">';
                        echo '<img class="down-card" src="./img/back-card.png" alt="">';
                        echo '</div>';
                    }
                }
                echo '</div>'; // Fechando a linha
            }
            echo "</section>";
            echo "</div>";
        }

        echo "<div class='timer' id='timer'></div>";
        
    }
    
    ?>
    <script src="./js/memory-game.js"></script>
</body>
</html>
