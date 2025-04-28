<?php
    require_once 'header.php';
    $error = $user = $pass= "";
    if (isset($_POST["user"]))
    {
        $user = sanitizeString($_POST["user"]);
        $pass = sanitizeString($_POST["pass"]);

        if ($user == "" || $pass == "")
           $error = "Not all fields were entered<br>";

        else
        {   
            $result = queryMySql("SELECT user,pass FROM members WHERE user='$user'");
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($result->num_rows == 0)
            {
                $error = "<span class='error'>Username/Password invalid</span><br><br>";
            }
            elseif (!(password_verify($pass, $row['pass'])))
            {
                $error = "<span class='error'>Username/Password invalid</span><br><br>";
            }
            else
            {
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
                die("You are now logged in. Please <a href='members.php?view=$user'>" . 
                    "click here</a> to continue.<br><br>");
            }
        }
    }

    echo <<<_END
        <form method='post' action='login.php'>$error
        <div data-role='fieldcontain'>
            <label></label>
            <span class='error'>$error</span>
        </div>
        <div data-role='fieldcontain'>
            <label></label>
            Please enter your details to log in
        </div>
        <div data-role='fieldcontain'>
            <label>Username</label>
            <input type='text' maxlength='16' name='user' value='$user'>
        </div>
        <div data-role='fieldcontain'>
            <label>Password</label>
            <input type='password' maxlength='16' name='pass' value='$pass'>
        </div>
        <div data-role='fieldcontain'>
            <label></label>
            <input data-transition='slide' type='submit' value='Login'>
        </div>
        </form>
_END;
?>


    <br>
    <br></div>
</body>
</html>
