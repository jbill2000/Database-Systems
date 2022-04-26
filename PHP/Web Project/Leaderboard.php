<!-- Leaderboard File -->
<!DOCTYPE html>
<html>
	<head>
		<title>Leaderboard</title>
	</head>
	<body style = "background-image: url('gamer-background.jpg'); background-repeat: repeat; background-attachment: fixed;">
		<center><h1 style = "display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px;">
			<b>
				The Leaderboard
			</b>
		</h1></center>
		<?php
		$Display=true;
			//Database Connection
			$conn=@mysqli_connect("php-website-updated.czfgh6scnpgz.us-east-1.rds.amazonaws.com","admin","password","TriviaGame");
			//if database fails
			if(!$conn)
			{
				die("Connection Failed: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
			}
			
			$sqlt = "SELECT * FROM Leaderboard";
			$rst = mysqli_query($conn, $sqlt);


			echo "<center><p style = 'display:inline-block; font-family:times new roman; color: white; border-style: dotted; padding: 5px; font-size: 30px;'>Click here to go back to the Home page and play again!</p></center>";
                echo "<form action = 'VGTG.php' method='POST' style= color:black>";
				echo "<center><input type = 'submit' name='Submit' value='Submit'></center>";
				echo "</form>";
		?>
		
		<center><table style = "display:inline-block; font-family:times new roman; border-style: dotted; padding: 5px; color: white;">
			<tr>
				<th style = "color: white; border-style: solid;  padding: 5px; font-size: 30px;">Number</th>
				<th style = "color: white; border-style: solid;  padding: 5px; font-size: 30px;">Username</th>
				<th style = "color: white; border-style: solid;  padding: 5px; font-size: 30px;">Total</th>
			<?php
				mysqli_data_seek($rst, 0);
				while ($row = mysqli_fetch_assoc($rst))
				{
					echo "</tr>";
					echo "<td style = 'color: white; border-style: solid;  padding: 5px; font-size: 20px;'><center>" . $row["numpeople"] . "</center></td>";
					echo "<td style = 'color: white; border-style: solid;  padding: 5px; font-size: 20px;'><center>" . $row["Username"] . "</center></td>";
					echo "<td style = 'color: white; border-style: solid;  padding: 5px; font-size: 20px;'><center>" . $row["Total"] . "</center></td>";
					echo "</tr>";
				}
			?>
		</table></center>
	</body>
</html>