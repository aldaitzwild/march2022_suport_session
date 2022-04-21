<?php
    session_start();

    if(!isset($_SESSION['playerScore']))
    {
        $_SESSION['playerScore'] = 0;
        $_SESSION['opponentScore'] = 0;
    }

    $choices = [
        'Pierre',
        'Feuille',
        'Ciseaux',
    ];

    $playedChoice = '';
    $randChoice = '';

    if(isset($_POST['choice'])) {
        if( $_POST['choice'] == 'raz') {
            session_destroy();
            header('Location: index.php');
            die();
        }

        $playedChoice = $_POST['choice'];

        $idChoice = array_rand($choices);
        $randChoice = $choices[$idChoice];

    }

    $resultPlay = '';
    if($playedChoice != '') {
        if($playedChoice == 'Feuille' && $randChoice == 'Ciseaux') $resultPlay = 'Manche perdue';
        if($playedChoice == 'Feuille' && $randChoice == 'Pierre') $resultPlay = 'Manche gagnée';

        if($playedChoice == 'Pierre' && $randChoice == 'Feuille') $resultPlay = 'Manche perdue';
        if($playedChoice == 'Pierre' && $randChoice == 'Ciseaux') $resultPlay = 'Manche gagnée';

        if($playedChoice == 'Ciseaux' && $randChoice == 'Pierre') $resultPlay = 'Manche perdue';
        if($playedChoice == 'Ciseaux' && $randChoice == 'Feuille') $resultPlay = 'Manche gagnée';

        if($playedChoice == $randChoice) $resultPlay = "Match nul";
    }

    if($resultPlay == 'Manche gagnée')
        $_SESSION['playerScore']++;

    if($resultPlay == 'Manche perdue')
        $_SESSION['opponentScore']++;

    
    if($_SESSION['playerScore'] == 3)
        die("Youpi j'ai gagné");

    if($_SESSION['opponentScore'] == 3)
        die("Pfff ce jeu est cheaté !");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Pierre - Feuille - Ciseaux</h1>

    <form method="POST">
        <h2>Quel coup joué ?</h2>
        <div class="choices">
            <input type="submit" name="choice" value="Pierre">
            <input type="submit" name="choice" value="Feuille">
            <input type="submit" name="choice" value="Ciseaux">
            <input type="submit" name="choice" value="raz">
        </div>
    </form>

    <p>
        Coup choisi : <?= $playedChoice ?>
    </p>

    <p>
        Coup adverse : <?= $randChoice ?>
    </p>

    <p>
        Résultat de la manche : <?= $resultPlay ?>
    </p>

    <p>
        Score : <?=  $_SESSION['playerScore'] ?> - <?=  $_SESSION['opponentScore'] ?>
    </p>
    
</body>
</html>