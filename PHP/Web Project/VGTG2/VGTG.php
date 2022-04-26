<!DOCTYPE html>
<html>
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
				if(!$conn)
				{
					die("Connection Failed: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
				}
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
		<br><br><center><img src = "Title.gif" width = "237" height = "200" style = "display:inline-block; color: white; border-style: dotted; padding: 5px;"></center>
	</body>
</html>