<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name ="description" content = "The signup page">
    <meta name="description" content="">
    <title>Welcome to the Best Music community</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
        session_start();
        if (!isset($_SESSION['username'])) {
            exit;
        }
        $user = $_SESSION['username'];
        echo "Logged in: " . $user
        
    ?>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html">Features</a></li>
            <li><a href="index.html">Pricing</a></li>
            <li><a href="index.html">FAQs</a></li>
        </ul>
    </nav>


    <h1>Success</h1>
    <hr color="#a01d88"/>
    <p class = "middle">Your Account has Been Made <?php echo $user ?> !</p>
    <p class ="middle" ><a href="index.html">Back Home</a> </p>
      
    </a>.

</body>
</body>
</html>