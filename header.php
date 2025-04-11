<?php
    session_start();

    echo <<<_INIT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='stylesheet' href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
            <link rel='stylesheet' href='styles.css'>
            <script src='javascript.js'></script>
            <script src='http://code.jquery.com/jquery-2.2.4.min.js'></script>
            <script src='http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js'></script>

_INIT;
    require_once 'functions.php';

    $userstr = 'Welcome Guest';

    if (isset($_SESSION['user'])) 
    {
        $user = $_SESSION['user'];
        $loggedin = TRUE;
        $userstr = "(Logged in as: $user)";
    }
    else $loggedin = FALSE;

    echo "<title>$appname$userstr</title><link rel='stylesheet'"  . 
         "</head><body><div data-role='page'><div data-role='header'>" .
         "<center><canvas id='logo' width='624' " .
         "height='120'>$appname</canvas></center>" .
         "<div class='appname'>$appname $userstr</div>" . 
         "<script src='javascript.js'></script></div>" .
         "<div data-role='content'>";
    
    if ($loggedin)
        echo <<<_LOGGEDIN
            <div class='center'>
                <a data-role='button' data-inline='true' data-icon='home' data-transition="slide" href='members.php?view=$user'>Home</a>
                <a data-role='button' data-inline='true' data-transition="slide" href='members.php'>Members</a>
                <a data-role='button' data-inline='true' data-transition="slide" href='friends.php'>Friends</a>
                <a data-role='button' data-inline='true' data-transition="slide" href='profile.php'>Edit Profile</a>
                <a data-role='button' data-inline='true' data-transition="slide" href='logout.php'>Log Out</a>
            </div>
_LOGGEDIN;
    
    else
    echo "<br ><ul class='menu'>" .
        "<li><a href='index.php'>Home</a></li>" .
        "<li><a href='signup.php'>Sign up</a></li>" .
        "<li><a href='login.php'>Log in</a></li></ul><br>" .
        "<span class='info'>&#8658; You must be logged in to view this page. </span><br><br>";
?>