<!DOCTYPE html>
<html>
    <head>
        <title> Questions </title>
    </head>
    <body style= "background-image: url('gamer-background.jpg'); background-attachment: fixed;">

<?php
    $Display=true;
    if(isset($_POST['Submit']))
    {
        $Answer= $_POST['answer'];
        $dbc= @mysqli_connect("php-website-updated.czfgh6scnpgz.us-east-1.rds.amazonaws.com","admin","password","TriviaGame");


        // CODE TO PULL COUNT
        $sqlCount= "SELECT Count FROM QandA;";
        $countfetch= mysqli_query($dbc,$sqlCount);
		$rowval= mysqli_fetch_assoc($countfetch);
        //Increments count
        $Ogcount= $rowval["Count"];
        $count = $Ogcount + 1;

        //Code to pull correct answer and query

        $sqlPrevAnswer= "SELECT CorrectAns FROM QandA WHERE QuestionNum = '".$Ogcount."';";
        $AnswerQuery= mysqli_query($dbc,$sqlPrevAnswer);
        $AnsVal= mysqli_fetch_assoc($AnswerQuery);


        //If they match, update score. 
        if($Answer==$AnsVal["CorrectAns"])
        {
           
            $sqlUpdateScore= "UPDATE QandA SET Score = 1 WHERE QuestionNum = '". $Ogcount ."';";
            mysqli_query($dbc,$sqlUpdateScore);
        }
        //If they dont match then set score to 0.
        else
        { 
           
           $sqlUpdateScore= "UPDATE QandA SET Score = 0 WHERE QuestionNum = '". $Ogcount ."';";
            mysqli_query($dbc,$sqlUpdateScore);
            
        }
        //if all questions have been answered quit.
        if($count == 21)
        {

            //Fetches total
            $sqlSummation = "SELECT SUM(Score) AS total FROM QandA;";
            $test= mysqli_query($dbc,$sqlSummation);   
            $tester= mysqli_fetch_assoc($test); 
            $sum=$tester["total"];

            //Fetches User
            $sqlUser = "SELECT Currentuser FROM QandA;";
            $Userquery= mysqli_query($dbc,$sqlUser);   
            $Userfetch= mysqli_fetch_assoc($Userquery); 
            $User=$Userfetch["Currentuser"];
            //Updates Leaderboard
            $sqlAddLeaderTotal= "UPDATE Leaderboard SET Total = '". $sum ."'WHERE Username = '". $User ."';";
            mysqli_query($dbc,$sqlAddLeaderTotal);

            //Navigates to Leaderboard
            echo "<center><p style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; font-size: 30px;'>Thanks For Playing our Game!</p></center>";
            echo "<center><p style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; font-size: 30px;'>Click the following button to go the Leaderboard!</p></center>";
            echo "<form action = 'Leaderboard.php' method='POST' style= color:black>";
            echo "<center><input type = 'submit' name='Submit' value='Submit'></center>";
            echo "</form>";
        }
        
        //CODE TO UPDATE COUNT
        $sqlUpdateCount= "UPDATE QandA SET Count = ". $count .";";


       if(!mysqli_query($dbc, $sqlUpdateCount))
        {
            die("Error with the update: ".mysqli_connect_errno() . ":" . mysqli_connect_error());
            
        }

        //Select to pull Q's and A's
        $sqlQuestion= "SELECT QuestionNum,Question,AnswerA,AnswerB,AnswerC,AnswerD FROM QandA WHERE QuestionNum= ". $count .";";

        $test= mysqli_query($dbc,$sqlQuestion);
		$row= mysqli_fetch_assoc($test);

			//If valid query and count is < 21
			if(mysqli_query($dbc,$sqlQuestion) && $count<21)
       		{
            	//echo
					//Question
					echo "<center><p style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; font-size: 30px;'>" . $row["QuestionNum"] . ": ". $row["Question"]. "</p></center>";
					//Answers
					echo "<center><form action = 'radial.php' method='POST' style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; text-align: left; font-size: 20px;'>";

                    //Prints out the form each time
				echo "<form action = 'radial.php' method='POST' style= color:black>";
					echo "<input type = 'hidden' name='test' value= '0'>";

                    //Form
					echo "<input type= 'radio' name='answer' value= '$row[AnswerA]' >".$row["AnswerA"].  "<br>"."</input>";
                    echo "<input type= 'radio' name='answer' value= '$row[AnswerB]' >".$row["AnswerB"].  "<br>"."</input>";
                    echo "<input type= 'radio' name='answer' value= '$row[AnswerC]' >".$row["AnswerC"].  "<br>"."</input>";
                    echo "<input type= 'radio' name='answer' value= '$row[AnswerD]' >".$row["AnswerD"].  "<br>"."</input>";
                    echo "<center><input type = 'submit' name='Submit' value='Submit'></center>";
				echo "</form>";
        	}
           
       			
			}

?>
</body>
</html>