<?php session_start();
    session_unset();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>EPL425 Game</title>
        <meta name="author" content="game">
        <meta name="description" content="An EPL425 multiple choice game">
        <meta name="keywords" content="game, 425">
        <link rel="icon" type="image/png" href="game.png">
    </head>

    <body style="font-family:Verdana;">


        <div class="container">

            <div class="navbar">
                <a href="index.php">Home Page</a>
                <a href="help.php">Help Page</a>
                <a href="scores.php" style="color:orange;text-decoration: underline">High Scores Page</a>
            </div>

            <a id="top"></a>

        </div>
        <br><br>

        <h1>The scores are: </h1>

    <div style="text-align: right;">
        <a href="#top"><img src="arrow_up.png" alt="arrow_up" style="width:20px;"></a>
    </div>

    <footer>
        <hr class="styleHrFooter ">
    </footer>

    </body>

</html>