
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="application/x-www-form-urlencoded"/>
<meta name="description" content="The login page">
<link rel="stylesheet" href="styles.css">
  <title>Login page</title>
</head>




<body>
  
  
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
   
  if(isset($_REQUEST["submit"])){
    // Variables for the output and the web form below.

    
    $s_id = $_REQUEST['userid'];
    $s_test = $_REQUEST['password'];

    // The following is the core part of this script where we connect PHP
    // and SQL.
    // Check that the user entered data in the form.
    if(!empty($s_id) && !empty($s_test)){
      // If so, prepare SQL query with the data to query the database.
      $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
      // Construct a prepared statement.
      $stmt = mysqli_prepare($db, $sql);

      // Bind the values for username and password that the user entered to the
      // statement AS STRINGS (that is what "ss" means). In other words, the
      // user input is strictly interpreted by the server as data and not as
      // porgram code part of the SQL statement.
        mysqli_stmt_bind_param($stmt, "ss", $s_id, $s_test);
      // Run the prepared statement.
        mysqli_stmt_execute($stmt);
       $result = mysqli_stmt_get_result($stmt);
       $num = mysqli_num_rows($result);
      
       if ($num > 0) {
          echo "Login Success";
        } else {
          echo "Wrong User id or password";
      }
    }
  }
  // Close SQL connection.

?>

  <div id="form">
    <h1>LOGIN Page</h1>
    <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
      <p>
        <label> USER NAME: </label>
        <input type="text" id="user" name="userid" />
      </p>

      <p>
        <label> PASSWORD: </label>
        <input type="text" id="pass" name="password" />
      </p>

      <p>
        <input type="submit" id="button" name = "submit" value="Login" />
      </p>

      
    </form>
  </div>


  
</body>

</html>