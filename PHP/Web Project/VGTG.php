<!DOCTYPE html>
<html>
	<!--Audrey: Wrote questions, Attended as many meetings as able, she had lots of prior commitments IE band concerts and most of our meetings were in the evening. Very active on discord though and contributing to ideas. Contributed to pictures associated with the questions

		Spencer:Attended Every Meeting, Wrote questions, Contributed to the pictures associated with the questions. 

		Sara:   Contributed to Question writing by suggesting ideas. Did initial HTML, found our background, wrote the format HTML Code, Got the leaderboard working. Helped with a lot of logic. Worked with Jeremy to bounce ideas off of for PHP and attended every meeting. 

		Jeremy: Contributed to Question writing by suggesting ideas. Did a majority of the PHP and communicating with the DB. However, that was of my own volition and not something that was forced on me by the group. I frequently got into the "zone" because I wanted to get the assignment done and took on a lot of the responsibility myself in that regard. None of the members asked me to do that and were more than willing to help with the majority of the php.

		Hours: Jeremy(10+)
       			Sara (7)
       			Spencer (5)
       			Audrey (4)-->
	<head>
		<title>Video Game Trivia Game</title>
	</head>
	<body style = "background-image: url('gamer-background.jpg'); background-repeat: repeat; background-attachment: fixed;">
		
		<?php
		//Sets display to true
			$Display=true;
			
			//checks if display is true
			if($Display=true)
			{

			
			//Database Connection
			$conn=@mysqli_connect("php-website-updated.czfgh6scnpgz.us-east-1.rds.amazonaws.com","admin","password","TriviaGame");
			//if database fails
			if(!$conn){
				die("Connection Failed: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
			}

			//SQL for questions
			

		?>
	
	
		<center><h2 style = "display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px;">
			<b>
				Video Game Trivia Game<br>Created By<br>Jeremy Bill, Sara Peak, Spencer Southerland, and Audrey Stillwell
			</b>
		</h2></center>
		<!-- HTML Code for the form -->
		<center><form style = "display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 15px;" action="username.php" method="POST">
			<label for = "Username">Username:</label><br>
			<input type = "text" id = "Username" name = "Username"><br>
			<input type = "submit" name="Submit" value="Let's Play"></input>
		</form></center>
		<!-- Sets Div Text Color to White --->
		<?php
			//Closes DB connection, this must be here at all costs. 
			mysqli_close($conn);
			}
		?>
	</body>
</html>