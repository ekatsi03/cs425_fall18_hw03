<?php
// Start the session
session_start();

if(!isset($_SESSION['counter_quest'])){
    $_SESSION['counter_quest'] = 0;
}

if(!isset($_SESSION['level'])){
    $_SESSION['level'] = 1;
}

if(!isset($_SESSION['answer'])){
    $_SESSION['answer'] = "ans1";
}

if(!isset($_SESSION['correct_ans'])){
    $_SESSION['correct_ans'] = "ans1";
}

if(!isset($_SESSION['quest'])){
    $_SESSION['quest'] = 1;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>

    <h1 id="welcome">Welcome to the EPL425 game!</h1>
        
    <button id="start_button" type="button">START</button>

    <br>
    <br>

    <?php
        // define variables and set to empty values
        $answerErr = "";
        //$answer = "";
        //$counter_quest = 0;
        //$level = 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["answer"])) {
                $answerErr = "*An answer is required";
            } else {
                $_SESSION['answer'] = test_input($_POST["answer"]);
            }

        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <!--show the question-->
        <?php $xml=simplexml_load_file("questions.xml") or die("Error: Cannot create object");?>
        <?php   if($_SESSION['counter_quest'] == "0") {
                    $_SESSION['level'] = "1";
                }else{
                    if($_SESSION['answer'] == $_SESSION['correct_ans']){//level up
                        if($_SESSION['level'] != "2")
                        $_SESSION['level'] = $_SESSION['level']++;  
                    }else{//level down
                        if($_SESSION['level'] != "0")
                        $_SESSION['level'] = $_SESSION['level']--;
                    }
                }
                $_SESSION['quest'] = rand (0,4);//select a random question for the level
        ?>

        <?php echo $xml->difficulty[$_SESSION['level']]->quest[$_SESSION['quest']] . "<br>";?>
        <br>
        <input type="radio" name="answer" value="ans1"><?php echo $xml->difficulty[$_SESSION['level']]->quest[$_SESSION['quest']]->answer[0] . "<br>";?>
        <input type="radio" name="answer" value="ans2"><?php echo $xml->difficulty[$_SESSION['level']]->quest[$_SESSION['quest']]->answer[1] . "<br>";?>
        <input type="radio" name="answer" value="ans3"><?php echo $xml->difficulty[$_SESSION['level']]->quest[$_SESSION['quest']]->answer[2] . "<br>";?>  
        <input type="radio" name="answer" value="ans_correct"><?php echo $xml->difficulty[$_SESSION['level']]->quest[$_SESSION['quest']]->valid_answer . "<br>";?>
        <br>
        <span class="error"><?php echo $answerErr;?></span>
        <br><br>
        <?php 
            if($_SESSION['counter_quest'] == "6"){//the last question to the user (7 questions)
               echo '<input type="submit" name="finish" value="Finish">';    
            }else{
                echo '<input type="submit" name="next" value="Next">'; 
            }
        ?>
        <button type="button">End Game</button>
        <?php $_SESSION['counter_quest'] = $_SESSION['counter_quest']++; 
              $_SESSION['correct_ans'] = $xml->difficulty[$_SESSION['level']]->quest[$_SESSION['quest']]->valid_answer;

              echo $_SESSION['counter_quest'];
              echo $_SESSION['level'];
              echo $_SESSION['answer'];
              echo $_SESSION['correct_ans'];
              echo $_SESSION['quest'];
        ?>
    </form>

    <?php
        echo "<br>";
        echo $_SESSION['answer'];
    ?>

    </body>

</html>