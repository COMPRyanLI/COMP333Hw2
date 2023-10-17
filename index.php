<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
<meta name="description" content="overview page">
<link rel="stylesheet" type="text/css" href="style.css" />
  <title>Overview page</title>
</head>

<body>
    <?php
     session_start();
     echo('You are logged in as user:'. $_SESSION['name']. '<br />'); 
     echo '<br /><a href="login.php">Log out</a>';
    ?>
    <h1>Song Ratings </h1>
    <?php
    echo ' <a href = "addsong.php" ><h3>Add New Song Rating</h3></a>'; 
    function sum($numbers) {
        // Initialize the variable we will return.
        $sum = 0;
    
        // Sum up the numbers.
        // Using a foreach loop.
        foreach ($numbers as $number) {
            $sum += $number;
        }
    
        // Return the sum to the user.
        return $sum;
    }
    
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "Music_db";
   
 $db = mysqli_connect($servername, $username, $password, $dbname);
   
     if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: "
       . mysqli_connect_error();
     }
    $sql = "SELECT * FROM ratings";
    $result = mysqli_query($db, $sql) or die(mysqli_error($db));
 
  
    $userlist = [];
    $action = [];

    if (mysqli_num_rows($result) > 0) {
     echo "<table>";
     echo "<tr><th>ID</th><th>Username</th><th>Artist</th><th>Song</th><th>Rating</th><th>Action</th></tr>";
    

     while ($row = mysqli_fetch_assoc($result)) {


        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["artist"] . "</td>";
        echo "<td>" . $row["song"] . "</td>";
        echo "<td>" . $row["rating"] . "</td>";
        echo "<td>";
            echo '<a href="view.php?id='. $row["id"] .'">View</a>';
            if ($_SESSION['name'] == $row["username"]) {
                echo '<a href="update.php">Update</a>';
                echo '<a href="delete.php">Delete</a>';
            }
        echo "</td>";

        echo "</tr>";
    }

    
    
    echo "</table>";

} else {
    echo "No records found";
}
    
    ?>

</body>