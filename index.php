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
    if (!isset($_POST['send'])) {
    ?>
    <section class="center-container">
        <form action="" method="post">
            <p>Colunas:</p><input type="number" name="number_cols" id="">
            <p>Linhas:</p><input type="number" name="number_rows" id="">
            <input type="submit" value="Enviar" name="send">
        </form>
    </section>
    <?php
    } else {
        $cols = isset($_REQUEST['number_cols']) ? $_REQUEST['number_cols'] : 4;
        $rows = isset($_REQUEST['number_rows']) ? $_REQUEST['number_rows'] : 4;

        //Necessito sempre ter uma réplica da minha imagem

        //echo 'Colunas: '. $cols;
        //echo ' Linhas: '. $rows;
        $numberOfCards = $cols * $rows;
        $numberOfImages = $numberOfCards / 2;
        //echo "<br>".$numberOfCards. "<br>";
        $maxNumberOfImages = 5;
        $images = array();

        //echo $numberOfImages;
        for ($i = 1; $i <= $maxNumberOfImages; $i++) { 
            array_push($images, $i);
            if (in_array($i, $images)) {
                array_push($images, $i);
            }
            echo $images[$i]. "<br>";
        }
        shuffle($images);

        if (!empty($images)) {
            echo "<section class='memory-game'>";
            for ($rowIndex=0; $rowIndex < $rows; $rowIndex++) { 
                for ($colIndex=0; $colIndex < $cols; $colIndex++) { 
                    $takeCard = array_shift($images); 
                    if (isset($images)) {
                        echo '<div class="memory-card" data-number='.$takeCard. ">";
                        echo '<img class="up-card" src="./img/'.$takeCard.'.png" alt="">';
                        echo '<img class="down-card" src="./img/back-card.png" alt="">';
                        echo '</div>';
                    }
    
                }  
            }
            
            echo "</section>";
            echo "</div>";
        }
    }
    ?>
    <script src="./js/memory-game.js"></script>
</body>
</html>
