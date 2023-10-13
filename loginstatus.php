// Put this code at the top of all html/php docs you want the user to interact with!

// Checks if there is a user in session. 
// if true-> ok.  
// if false-> exit the user session. 
<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        exit;
    }
    $g = $_SESSION['username'];
    
    ?>