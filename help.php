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
                <a href="help.php" style="color:orange;text-decoration: underline">Help Page</a>
                <a href="scores.php">High Scores Page</a>
            </div>

            <a id="top"></a>

        </div>

        <br><br>
        
        <h1>Instructions:</h1>

        <p>The questions have a minimum of three levels of difficulty.The score for each question based on
            the level of difficulty.The difficulty of the next question selected based on the current question’s answer. If you
            answer correctly, the next question will be from a higher level of difficulty. </p>
            
        <p>If you answer wrong, then the next one will be easier. 
            The first question is medium difficulty.</p>
        
        <p> During the game, you will not be aware of the difficulty or if you answered correctly or not, but
            only when the game has finished. You will know how many questions you answered so far and
            how many are left. At the end of the game, you will see an overall score of your performance
            that will show the list of the questions, if you answered correctly or not,
            the difficulty, the score for each answer and your overall score. You will have the option
            to save your score using a nickname.</p>

            <div style="text-align: right;">
                <a href="#top"><img src="arrow_up.png" alt="arrow_up" style="width:20px;"></a>
            </div>
        
            <footer>
                    <hr class="styleHrFooter ">
            </footer>

    </body>

</html>