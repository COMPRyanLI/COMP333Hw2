<!-- 
  COMP 333: Software Engineering
  Lance Gartrell
-->



<!DOCTYPE HTML>
<html lang="en">
<head>
  <!-- This is the default encoding type for the HTML Form post submission. 
  Encoding type tells the browser how the form data should be encoded before 
  sending the form data to the server. 
  https://www.logicbig.com/quick-info/http/application_x-www-form-urlencoded.html -->
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport" content="application_x-www-form-urlencoded">
    <meta name ="description" content = "The signup page">
    <meta name="description" content="">
    <title>Welcome to the Best Music community</title>
    <link rel="stylesheet" href="">
</head>

<body>
  <?php session_start();


    if (!isset($_SESSION['username'])) {
        exit;
    }
    echo "Logged in as: " . $user;
    // PHP code for retrieving data from the database. If you have multiple files
    // relying on the this server config, you can create a config.php file and
    // import it with `require_once "config.php";` at the beginning of each file 
    // where you need it.
    // Database credentials per below are default for a local server. Assuming 
    // running MySQL server with default setting (user 'root' with no password).
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "music_db";
    
    // Create server connection.
    // The MySQLi Extension (MySQL Improved) is a relational database driver 
    // used in the PHP scripting language to provide an interface with MySQL 
    // databases (https://en.wikipedia.org/wiki/MySQLi).
    // Instances of classes are created using `new`.
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check server connection.
    if ($conn->connect_error) {

      // Exit with the error message.
      // . is used to concatenate strings.
      die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_REQUEST['confirm'])) {
      // Get the submitted ratings to delete
      $song = $_REQUEST["song"];
  
      if(!isset($song)) {
          echo "No song was selected.";
      }else {
          // Prepare a SQL query to delete the selected ratings
          $sql = "DELETE FROM ratings WHERE song = ? AND username = ?";
          $stmt = mysqli_prepare($conn, $sql);
          mysqli_stmt_bind_param($stmt, "ss", $song, $user);
  
          if(mysqli_stmt_execute($stmt)){
            echo "your entry has been deleted.";
          } else {
            echo "something went wrong";
          }
        }
    }
  
  ?>
<nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html">Features</a></li>
            <li><a href="index.html">Pricing</a></li>
            <li><a href="index.html">FAQs</a></li>
        </ul>
  </nav>

  <h1>Delete Rating</h1>
    <hr color="#a01d88"/>
    <p class = "middle">Please enter the name of the song you would like to delete </p>
    
  <!-- 
    HTML code for the form by which the user can query data.
    Note that we are using names (to pass values around in PHP) and not ids
    (which are for CSS styling or JavaScript functionality).
    You can leave the action in the form open 
    (https://stackoverflow.com/questions/1131781/is-it-a-good-practice-to-use-an-empty-url-for-a-html-forms-action-attribute-a)
  -->
  <form method="GET" action="">
  Song: <input type="text" name="song" placeholder="song" /><br>
  <input type="submit" name="confirm" value="Submit"/>

  
  <!-- 
    Make sure that there is a value available for $out_value.
    If so, print to the screen.
  -->
  <p><?php 
    if(!empty($out_value)){
      echo $out_value;
    }
        

  ?></p>
  </form>
</body>
</html>