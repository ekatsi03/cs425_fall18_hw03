<?php
session_start();  // Start the session

// define variables and set to empty values
$answerErr = "";
$answer = "ans1";
$counter_quest = 0;
$level = 1;
$quest = 1;
$theQeust = "";
$answ1 = "";
$answ2 = "";
$answ3 = "";
$answ4 = "";

$xml = simplexml_load_file("questions.xml") or die("Error: Cannot create object");

if(!isset($_SESSION['counter_quest'])){
    $_SESSION['counter_quest'] = 0;
    $counter_quest = $_SESSION['counter_quest'];

    echo "mpike so isset";
    $theQeust = (String)$xml->difficulty[$level]->quest[$quest]->name;
    $answ1 = (String)$xml->difficulty[$level]->quest[$quest]->answer[0];
    $answ2 = (String)$xml->difficulty[$level]->quest[$quest]->answer[1];
    $answ3 = (String)$xml->difficulty[$level]->quest[$quest]->answer[2];
    $answ4 = (String)$xml->difficulty[$level]->quest[$quest]->valid_answer;
}

if(!isset($_SESSION['level'])){
    $_SESSION['level'] = 1;
    $level = $_SESSION['level'];
}

if(!isset($_SESSION['answer'])){
    $_SESSION['answer'] = "ans1";
    $answer = $_SESSION['answer'];
}

if(!isset($_SESSION['correct_ans'])){
    $_SESSION['correct_ans'] = "ans1";
}

if(!isset($_SESSION['quest'])){
    $_SESSION['quest'] = 1;
    $quest = $_SESSION['quest'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["answer"])) {
        $answerErr = "*An answer is required";
    } else {
        $_SESSION['answer'] = test_input($_POST["answer"]);
        $answer = $_SESSION['answer'];
    }

    $_SESSION['counter_quest'] = $_SESSION['counter_quest']++; 
    $counter_quest = $_SESSION['counter_quest'];

    if($_SESSION['counter_quest'] == 0) {//if is the first question
        $_SESSION['level'] = 1;//medium level
        $level = $_SESSION['level'];
    }else{//if is not the first question
        if($_SESSION['answer'] == $_SESSION['correct_ans']){//level up if he answered right
            if($_SESSION['level'] != 2){//if is not at hard level
                $_SESSION['level']++;
                $level = $_SESSION['level'];
            }
        }else{//level down if he answered wrong
            if($_SESSION['level'] != 0){//if is not at easy level
                $_SESSION['level']--;
                $level = $_SESSION['level'];
            }
        }
    }
    
    $_SESSION['quest'] = rand (0,4);//select a random question for the level
    $quest = $_SESSION['quest'];
    
    echo "<p> " .  $_SESSION['level'] . "</p>";
    $theQeust = (String)$xml->difficulty[$level]->quest[$quest]->name;
    $answ1 =(String) $xml->difficulty[$level]->quest[$quest]->answer[0];
    $answ2 = (String)$xml->difficulty[$level]->quest[$quest]->answer[1];
    $answ3 = (String)$xml->difficulty[$level]->quest[$quest]->answer[2];
    $answ4 = (String)$xml->difficulty[$level]->quest[$quest]->valid_answer;

    $_SESSION['correct_ans'] = $answ4;
}

?>

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
                <a href="index.php" style="color:orange;text-decoration: underline">Home Page</a>
                <a href="help.php">Help Page</a>
                <a href="scores.php">High Scores Page</a>
            </div>

            <a id="top"></a>
        </div>
<br><br>

    <h1 id="welcome">Welcome to the EPL425 game!</h1>
        
    <button id="start_button" type="button">START</button>

    <br><br>

    <?php

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <!--show the question-->
        <?php echo $theQeust . "<br>";?>
        <br>
        <input type="radio" name="answer" value="ans1"><?php echo $answ1 . "<br>";?>
        <input type="radio" name="answer" value="ans2"><?php echo $answ2 . "<br>";?>
        <input type="radio" name="answer" value="ans3"><?php echo $answ3 . "<br>";?>  
        <input type="radio" name="answer" value="ans_correct"><?php echo $answ4 . "<br>";?>
        <br>
        <span class="error"><?php echo $answerErr;?></span>
        <br><br>
        <?php 
            if($counter_quest == 6){//the last question to the user (7 questions)
               echo '<input type="submit" name="finish" value="Finish">';    
            }else{
                echo '<input type="submit" name="next" value="Next">'; 
            }
        ?>
         <input type="submit" value="End Game">  
    </form>

    <?php
        //echo "<br>";
        //echo $answer;
    ?>
    <div style="text-align: right;">
        <a href="#top"><img src="arrow_up.png" alt="arrow_up" style="width:20px;"></a>
    </div>

    <footer>
        <br>
        <hr class="styleHrFooter ">
    </footer>


    </body>

</html>