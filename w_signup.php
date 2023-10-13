<!-- 
  COMP 333: Software Engineering
  Sebastian Zimmeck (szimmeck@wesleyan.edu) 

  PHP sample script for querying a database with SQL. This script can be run 
  from inside the htdocs directory in XAMPP. 
  
  NOTE: The script assumes that there is a database set up (e.g., via phpMyAdmin) 
  named COMP333_SQL_Tutorial with students and student_grades tables per the 
  sql_tutorial.md.
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
    <link rel="stylesheet" href="styles.css">
</head>

<body>
  <?php session_start();
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

    // Variables for the output and the web form below.
    if(isset($_REQUEST['submit'])){
      $out_value = "";
      $name = $_REQUEST['username'];
      $pass = $_REQUEST['password'];

      // The following is the core part of this script where we connect PHP
      // and SQL.

      // Check that the user entered data in the form.
      // code --> if(!isset($_REQUEST['username']) && !isset($_REQUEST['password'])){

      // If so, prepare SQL query with the data to query the database.
      $sql_query = "SELECT * FROM users WHERE username = ('$name')";

      // Send the query and obtain the result.
      // mysqli_query performs a query against the database.
      $result = mysqli_query($conn, $sql_query);

      // number of rows that match the query
      $num = mysqli_num_rows($result);  

      // insert data into SQL databse unless username is taken 
      if($num>0){ 
        echo "Username is taken. Try another";  
      }else {
        
        $hash = password_hash($pass,  PASSWORD_DEFAULT); 
        $out_value = "Success!";
        
      
        // sql query for the username and password
        $p_query = "INSERT INTO users (username, password) VALUES (?, ?)";
        echo "<br /><a href="."index.html" . ">Home</a>";

        // bind the parameters of the sql statemtn to avoid SQL injection
        $stmt = mysqli_prepare($conn, $p_query);
        mysqli_stmt_bind_param($stmt, "ss", $name, $hash);

        if(mysqli_stmt_execute($stmt)){     
          // code for starting a user log in session. The user will stay logged in 
          // as long as the global username variable in session is equal to their own. 
          $_SESSION['username'] = $name;
          header("Location: signup.php");
        };
        
      }
      // end bracket for the if statement above }
    }  
    // Close SQL connection.
    $conn->close();
  ?>

  <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html">Features</a></li>
            <li><a href="index.html">Pricing</a></li>
            <li><a href="index.html">FAQs</a></li>
        </ul>
  </nav>

  <h1>Sign Up</h1>
    <hr color="#a01d88"/>
    <p class = "middle">Please create your username and password down below</p>
    
  <!-- 
    HTML code for the form by which the user can query data.
    Note that we are using names (to pass values around in PHP) and not ids
    (which are for CSS styling or JavaScript functionality).
    You can leave the action in the form open 
    (https://stackoverflow.com/questions/1131781/is-it-a-good-practice-to-use-an-empty-url-for-a-html-forms-action-attribute-a)
  -->
  <form method="GET" action="signup.php">
  Username: <input type="text" name="username" placeholder="username" /><br>
  Password: <input type="password" name="password" placeholder="password" /><br>
  <input type="submit" name="submit" value="Submit"/>

  
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