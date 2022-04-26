<!DOCTYPE html>
<!----Jeremy Bill, ISS4014, 04/12/2022 MODIFIED 4/21/2022 to include PHP-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Title-->
    <title>The Giants of the Video Game Industry</title>
</head>
<header>  
</header>
<body style= "background-image: url(d_3.jpg)";>

<?php 
    //Sets Display to true
    $Display=true;
    //If submit was pressed
    if(isset($_POST['Submit']))
    {

        //Various inputs
        $fname= $_POST['fname'];
        $lname= $_POST['lname'];
        $email= $_POST['email'];

        //Makes connection
        $conn=@mysqli_connect("php-fanpage.czfgh6scnpgz.us-east-1.rds.amazonaws.com","admin","password","fanpage");
        //If connection no bueno die
        if(!$conn){
            die("Connection Failed: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
        }
        //Insert statement
        $sqlInsertion= "INSERT INTO Formdata VALUES('" . $fname . " ',' " . $lname . "','". $email . "');";
        //Query 
        if(mysqli_query($conn,$sqlInsertion))
        {
            //echo
            echo "<p style='color:white'> Thanks for inputting your information.";

        }
        //close connection
        mysqli_close($conn);
        //set display to false
        $Display=false;
    }
    //If display is true
    if($Display)
    {

    //Database Connection
    $dbc=@mysqli_connect("php-fanpage.czfgh6scnpgz.us-east-1.rds.amazonaws.com","admin","password","fanpage");
    //if database fails
    if(!$dbc){
        die("Connection Failed: ". mysqli_connect_errno() . ": ". mysqli_connect_error());
    }
    //SQL Statements to fetch data
    $sqlNintendoFacts = "Select * FROM NintendoFacts";
    $sqlNintendoGames = "Select * FROM NintendoGames";
    $sqlPSFacts = "Select * From PlaystationFacts";
    $sqlPSGames = "Select * FROM PlaystationGames";
    $sqlXboxFacts = "Select * FROM XboxFacts";
    $sqlXboxGames= "Select * From XboxGames";
    //Pulls from table
    $sqlNintendoTable = "Select * From Tabledata where Company_Name = 'Nintendo'";
    $sqlPlaystationTable = "Select * From Tabledata where Company_Name = 'Playstation'";
    $sqlXboxTable = "Select * From Tabledata where Company_Name = 'Xbox'";

    //Result Set Queries
    $NintendoFactsRes= mysqli_query($dbc, $sqlNintendoFacts);
    $NintendoGamesRes= mysqli_query($dbc, $sqlNintendoGames);
    $PSFactsRes= mysqli_query($dbc, $sqlPSFacts);
    $PSGamesRes= mysqli_query($dbc, $sqlPSGames);
    $XboxFactsRes= mysqli_query($dbc, $sqlXboxFacts);
    $XboxGamesRes= mysqli_query($dbc, $sqlXboxGames);

    //Pulls from Table
    $NintendoTableRes= mysqli_query($dbc, $sqlNintendoTable);
    $PlaystationTableRes= mysqli_query($dbc, $sqlPlaystationTable);
    $XboxTableRes=mysqli_query($dbc, $sqlXboxTable);



?>
    <!---Big title and Background info-->
    <h1 style="text-align: center;color: white;"> The Giants of the Gaming Industry </h1>
    <p style="text-align: center;color: white"> Many companies have risen and fallen in the lifespan of the gaming industry. Two notable companies who fit this description are SEGA and Atari. Today however, we have three very strong companies that make up the staple of the gaming industry: Microsoft, Sony, and Nintendo. </p>

    <div style="text-align: center">
    <!---Table---->
<table style="text-align: center; color: white; border:1px solid white; margin-left:auto; margin-right:auto;">
    
<colgroup>
        <!---Column Names-->
    <th> Company Name</th>
    <th> Year of first gaming console release</th>
    <th> # of consoles released in lifetime</th>
    <th> # of First Party Studios</th>
    <th> Current console</th>
    <th> Console price</th>
</colgroup>
<!---Diff Companies-->
<?php
//Nintendo Table data
echo "<tr>";
$row= mysqli_fetch_assoc($NintendoTableRes);

    echo '<td>' . $row["Company_Name"] . '</td>';
    echo '<td>' . $row["YearofConsole"] . '</td>';
    echo '<td>' . $row["NumReleasedConsoles"] . '</td>';
    echo '<td>' . $row["NumofFirstParty"] . '</td>';
    echo '<td>' . $row["CurConsole"] . '</td>';
    echo '<td>' . $row["ConsolePrice"] . '</td>';

echo "</tr>";

//Playstation table data
echo "<tr>";
$row= mysqli_fetch_assoc($PlaystationTableRes);

    echo '<td>' . $row["Company_Name"] . '</td>';
    echo '<td>' . $row["YearofConsole"] . '</td>';
    echo '<td>' . $row["NumReleasedConsoles"] . '</td>';
    echo '<td>' . $row["NumofFirstParty"] . '</td>';
    echo '<td>' . $row["CurConsole"] . '</td>';
    echo '<td>' . $row["ConsolePrice"] . '</td>';

echo "</tr>";

//Xbox Table 
echo "<tr>";
$row= mysqli_fetch_assoc($XboxTableRes);

    echo '<td>' . $row["Company_Name"] . '</td>';
    echo '<td>' . $row["YearofConsole"] . '</td>';
    echo '<td>' . $row["NumReleasedConsoles"] . '</td>';
    echo '<td>' . $row["NumofFirstParty"] . '</td>';
    echo '<td>' . $row["CurConsole"] . '</td>';
    echo '<td>' . $row["ConsolePrice"] . '</td>';

echo "</tr>";
?>

</table>
</div>
<!---Nintendo Detaisl-->
<div style=" margin-left:auto; margin-right:auto; color:white"> 
<section style= "margin:3em">
    <h2 style="text-align: center;color: white"> Nintendo</h2>
    <p style="text-align: center;color: white;"> Nintendo is the household console name that has truly survived the test of time. Ever since the NES, Nintendo has constantly taken innovation after innovation with their products and continues to do so to this day. The most notable strides Nintendo has taken are as follows: </p>
    
    <?php
    //Prints out the bulleted List
        echo "<ul>";
        //While data to fetch
        while($row = mysqli_fetch_assoc($NintendoFactsRes))
        {
            echo "<li>" . $row['nintendofacts'];
        }
        echo "</ul>";

    ?>
    
    <!---List-->
    <h3 style="text-align: center; color: white;">Notable Exclusives and Franchises</h3>
    <?php
        //Prints out the numbered list
        echo "<ol>";
        //While data for games
        while($row = mysqli_fetch_assoc($NintendoGamesRes))
        {
            //printing
            echo "<li>" . $row['nintendogames'];
        }
        echo "<ol>";

    ?>
   </section>
    <!---Image and img source-->
<img src="nintendo-2.jpeg" alt="Nintendo" class="center;">
<a href="https://vagrantrant.com/2014/10/17/my-top-30-favourite-nintendo-franchises-closer/"><br> Nintendo Image Source</a>
</div>
<div style="margin-left:auto; margin-right:auto;color:white">
<section style= "margin:3em">
    <!---Playstation info-->
    <h2 style="text-align: center;color: white;"> Playstation</h2>
    <p style="text-align: center;color: white;"> Playstation has been a household name longer than Xbox but shorter than Nintendo. Originally, Nintendo and Sony were working together on a console. Sony then parted ways and created the Playstation. Over the years, Playstation has made many strides in the gaming industry. These strides include but are not limited to:  </p>
    
    
    <?php
    //Prints out the bulleted List
        echo "<ul>";
        //While data to pull
        while($row = mysqli_fetch_assoc($PSFactsRes))
        {
            //Prints playstation facts
            echo "<li>" . $row['playstationfacts'];
        }
        echo "</ul>";

    ?>
    
    <!---List-->
    <h3 style="text-align: center; color: white;">Notable Exclusives and Franchises</h3>
    <?php
        //Prints out the numbered list
        echo "<ol>";
        //Playstation games 
        while($row = mysqli_fetch_assoc($PSGamesRes))
        {
            //print
            echo "<li>" . $row['playstationgames'];
        }
        echo "<ol>";

    ?>
    
    
    </section>
    <!---Image name and source-->
    <img src="PS Studios.jpg" alt="Playstation Studios" class="center">
    <a href="https://theplaystationbrahs.com/2022/01/02/rumor-longtime-playstation-insider-teases-action-stealth-open-world-game-from-a-playstation-studios-team/">Playstation Image Source</a>

</div>
<div style="margin-left:auto; margin-right:auto;color:white">
<section style= "margin:3em">
    <!---Xbox Info-->
    <h2 style="text-align: center; color: white;"> Xbox</h2>
    <p style="text-align: center; color: white;">Xbox is the youngest of the 3 console brands to be on the market. However, they can contend with the other two giants on an even playing field. Xbox has made many advances in the world of modern home gaming for the better. These include:  </p> 
   
    <?php
    //Prints out the bulleted List
        echo "<ul>";
        //While data in row
        while($row = mysqli_fetch_assoc($XboxFactsRes))
        {
            //print
            echo "<li>" . $row['xboxfacts'];
        }
        echo "</ul>";

    ?>

     <p style="text-align: center;color: white;"> Recently, Microsoft has stated their intent to purchase Activision Blizzard Inc. In doing this, they will own more studios than Sony and Nintendo combined. </p>

    <!---List-->
    <h3 style="text-align: center; color: white;">Notable Exclusives and Franchises</h3>
    <?php
        //Prints out the numbered list
        echo "<ol>";
        //Fetches while data exists
        while($row = mysqli_fetch_assoc($XboxGamesRes))
        {
            //prints
            echo "<li>" . $row['xboxgames'];
        }
        echo "<ol>";

    ?>
   </section>
    <!---Image name and url-->
    <img src="Microsoft Studios.jpg" alt="Microsoft Studios" class="center";>
    <a href="https://videogamesrepublic.com/in-microsoft-there-are-now-more-blizzard-than-xbox/">Xbox Image Source</a>

</div>
<!---Contact form-->
<div style="margin-left:auto; margin-right:auto; color:white">
<section>
    <h4 style="text-align: center;color: white;"> Contact Information Form:</h4>
    <form style="text-align: center;color: white;" action="fanpage.php" method="POST">
        <label for="fname">First name: </label><br>
        <input type="text" id="fname" name="fname"><br>
        <label for="lname">Last name: </label><br>
        <input type="text" id="lname" name="lname"><br>
        <label for="email"> Email: </label><br>
        <input type="text" id="email" name="email"><br>

        <input type="submit" name="Submit" value="Submit"><br>
    </form>
</section>
</div>
<?php
//close database connection
    mysqli_close($dbc);
    }
?>
</body>
</html>