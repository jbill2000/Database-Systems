<!DOCTYPE html>
<html>
    <head>
        <title> Username </title>
    </head>
    <body style= "background-image: url('gamer-background.jpg'); background-attachment: fixed;">
<?php
	$Display=true;
	//If submit is pressed
			
    if(isset($_POST['Submit']))
	{
		//Vars
		$username= $_POST['Username'];
				
		//Necessary to do Insert but not necessary if we UPDATE
		$total=0;
		$percent=0;
		
		//DB connection
		$dbc= @mysqli_connect("php-website-updated.czfgh6scnpgz.us-east-1.rds.amazonaws.com","admin","password","TriviaGame");
		//Dies if failed to make connect
		if(!$dbc)
		{
			die("Connection Failed: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
		}
		//Inserts into Leaderboard and updates Q and A. 
        $UpdateQandAwithUser= "UPDATE QandA SET Currentuser = '" . $username . "';";
        mysqli_query($dbc, $UpdateQandAwithUser);

        //Checks if User Exists
        $CheckifUserexists= "SELECT * FROM Leaderboard WHERE Username = '". $username ."';";
        $readResult= mysqli_query($dbc,$CheckifUserexists);

        //If they dont, insert
        if(mysqli_num_rows($readResult) == 0)
        {
			$sqlUpdater= "INSERT INTO Leaderboard Values(' ','". $username ."','" . $total . "');";
        }
        //If user exists reset their score.
        else
        {
			$sqlUpdater= "UPDATE Leaderboard SET total = '".$total."' WHERE Username = '".$username."';";
        }
            
		$sqlQuestion1= "SELECT * FROM QandA where QuestionNum = 1;";

		$test= mysqli_query($dbc,$sqlQuestion1);
		$row= mysqli_fetch_assoc($test);
		
        //SEts count to 1 each time a username is submitted
        $sqlCountUpdate= "UPDATE QandA SET Count = 1";
        mysqli_query($dbc,$sqlCountUpdate);

        //Resets score each time a new game has begun
        $sqlResetScore = "UPDATE QandA SET Score = 0";
        mysqli_query($dbc,$sqlResetScore);

		//If valid query
		if(mysqli_query($dbc,$sqlUpdater))
       	{        
			//echo
			echo "<center><p style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; font-size: 20px;'>Thanks for inputting your information.</p></center>";
			//For first picture
			echo "<center><img src ='" . $row['PictureUrl'] . "' alt = '' width = '" . $row['Width'] . "' height = '" . $row['Height'] . "' style = 'display:inline-block; color: white; border-style: dotted; padding: 5px;'></center>";
			//Question
			echo "<center><p style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; font-size: 30px;'>" . $row["QuestionNum"] . ": ". $row["Question"].  "</p></center>";
			//Answers
			echo "<center><form action = 'radial.php' method='POST' style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; text-align: left; font-size: 20px;'>";
				//Prints out th Form
				echo "<input type = 'hidden' name='test' value= '0'>";
				echo "<input type= 'radio' name='answer' value= '$row[AnswerA]' >".$row["AnswerA"].  "<br>"."</input>";
				echo "<input type= 'radio' name='answer' value= '$row[AnswerB]' >".$row["AnswerB"].  "<br>"."</input>";
				echo "<input type= 'radio' name='answer' value= '$row[AnswerC]' >".$row["AnswerC"].  "<br>"."</input>";
				echo "<input type= 'radio' name='answer' value= '$row[AnswerD]' >".$row["AnswerD"].  "<br>"."</input>";
				echo "<center><input type = 'submit' name='Submit' value='Submit'></center>";
			echo "</form>";
        }
		//close connection
       	mysqli_close($dbc);
        //set display to false
		$Display=false;
	}
?>
</body>
</html>