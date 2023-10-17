<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
<meta name="description" content="view rating page">
<link rel="stylesheet"  href="style.css" />
  <title>Login page</title>
</head>


<body>
    <?php
    if (isset($_GET["id"])){
        $id_chosen = $_GET["id"];
    }
    else{
        echo "view error";
    }
    session_start();

    echo('You are logged in as user:'. $_SESSION['name']. '<br />'); //search for user in the rating table
    echo '<br /><a href="login.php">Log out</a>';
   ?>
   <h1>View Rating</h1>
   <br />
   <h4>username</h4>
   <?php


   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "Music_db";

   $db = mysqli_connect($servername, $username, $password, $dbname);

 
   if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: "
     . mysqli_connect_error();
   }
   $sql = "SELECT * FROM ratings WHERE id = ?";
   $stmt = mysqli_prepare($db, $sql);
   mysqli_stmt_bind_param($stmt, "i", $id_chosen);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);

   $num = mysqli_num_rows($result);
   $artist = [];
   $song = [];
   $rating = [];
   if ($num > 0){
    while($rows = mysqli_fetch_array($result)){
        $user_chosen[] = $rows['username'];
        $artist[] = $rows['artist'];
        $song[] = $rows['song'];
        $rating[] = $rows['rating'];
    }
    foreach ($user_chosen as $uc) {
        echo $uc;
       }
     echo '<h4>artist</h4>' ;
    foreach ($artist as $ar) {
        echo $ar;
       }
    echo "<h4>" .'song' . "</h4>";
    foreach ($song as $sn) {
        echo $sn;
    }
    echo "<h4>" .'rating' . "</h4>";
    foreach ($rating as $rt) {
        echo $rt;
   }
}else{
    echo 'no artist found';
    echo "<h4>" .'song' . "</h4>";
    echo 'no song found';
    echo "<h4>" .'rating' . "</h4>";
    echo 'no rating found';
   }
  
 
   echo '<br /><a href="index.php">Back</a>';
   ?>






</body>