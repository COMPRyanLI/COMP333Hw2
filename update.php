<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
<meta name="description" content="The login page">
<link rel="stylesheet" type="text/css" href="" />
  <title>Update Song</title>
</head>

<body>
<?php 

  // insert _GET statement for the global username here 
  if($_SESSION["loggedin"]){
    $u = $_SESSION['name'];
    echo 'logged in as: ';
  }

  // database information
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "music_db";

  $db = mysqli_connect($servername, $username, $password, $dbname);
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check server connection.
  if ($conn->connect_error) {

    // Exit with the error message.
    // . is used to concatenate strings.
    die("Connection failed: " . $conn->connect_error);
  }
  
  // checks if form was submited
  if(isset($_REQUEST['submit'])){
    $artist = $_REQUEST['Artist'];
    $song = $_REQUEST['Song'];
    $rating = $_REQUEST['Rating'];

    
    if (isset($song) | isset($artist) | isset($rating)){
        echo "Please fill out all fields";
    } else {
        $sql = "UPDATE ratings SET artist = ?, song = ?, rating = ?" ;
        $stmt1 = mysqli_prepare($conn, $sql);   
        mysqli_stmt_bind_param($stmt1, "ssi", $artist, $song, $rating);
        mysqli_stmt_execute($stmt1);
        header("Location: index.php");
    }
  }

?>

  <h1>Update Song</h1>
    <hr color="#a01d88"/>
    <p class = "middle">Update Songs Below: </p>
  
  <form method="POST" action="">
  Artist: <input type="text" name="Artist" placeholder="" /><br>
  Song: <input type="text" name="Song" placeholder="" /><br>
  New Rating: <input type="text" name="Rating" placeholder="" /><br>
  <input type="submit" name="submit" value="submit"/>

  </form>
  <br /><a href="index.php">Cancel</a>
</body>
</html>
