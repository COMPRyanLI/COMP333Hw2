<!DOCTYPE html>
<html>
<head>
    <title>Song Ratings</title>
</head>
<body>
    <h1>Song Ratings</h1>

    <?php
    session_start();
    $user = $_SESSION['username'];
    if($_SESSION["loggedin"]){
        echo '<br />Logged in as: ' . $user;
       }

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

    // Function to retrieve songs and ratings
    $sql = "SELECT * FROM ratings";
    $stmt = mysqli_prepare($db, $sql);
    // Display song ratings
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num = mysqli_num_rows($result);


    // Close the database connection
    
    ?>

    <a href="addnew.php">Add a New Song</a>

</body>
</html>