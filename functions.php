<?php

    require_once 'sqllogin.php'; #sqllogins saved in file

    $connection = new mysqli($dbhost, $dbuser, $dbpass,$dbname);
    if ($connection->connect_error) die($connection->connect_error);

    function createTable($name, $query)
    {   
        queryMySql("CREATE TABLE IF NOT EXISTS $name($query)");
        echo "Table '$name' created or already exists.<br>";
    }

    function queryMySql($query)
    {
        global $connection;
        $result = $connection->query($query);
        if (!$result) die($connection->error);
        return $result;
    }

    function destroySession()
    {
        $_SESSION=array();

        if (session_id() != "" || isset($_COOKIE[session_name()]))
          setcookie(session_name(), "", time()-2592000,"/");

        session_destroy();
    }

    function sanitizeString($var)
    {
        global $connection;
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = stripslashes($var);
        return $connection->real_escape_string($var);
    }

    function showProfile($user)
    {
        if (file_exists("$user.jpg"))
          echo "<img src='$user.jpg' style='float:left;'>";

        $result = queryMySql("SELECT * FROM profiles WHERE user='$user'");

        if ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
        }
    }
?>