<?php
    require_once 'header.php';
    echo <<<_END
        <script>
            function checkUser(user)
            {
                if(user.value == '')
                {
                    $('#used').html('&nbsp;')
                    return
                }
            params = "user=" + user.value
            request = new ajaxRequest()
            request.open("POST", "checkuser.php", true)

            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

            request.onreadystatechange = function()
            {
                if(this.readyState == 4)
                    if(this.status == 200)
                        if (this.responseText != null)
                            O('info').innerHTML = this.responseText
            }
            request.send(params)
            }

            function ajaxRequest()
            {
             try { var request = new XMLHttpRequest() }
             catch(e1) {
                try { request = new ActiveXObject("Msml2.XMLHTTP") }
                catch(e2) {
                    try { request = new ActiveXOBject("Microsoft.XMLHTTP") }
                    catch(e3) {
                        request = false
                    }
               }
            }
                return request
            }
            </script>
            <div data-role='fieldcontain'><label></label>Please enter your details to sign up</div>
_END;
    $error = $user = $pass = "";
    if (isset($_SESSION["user"])) {destroySession();}

    if (isset($_POST["user"]))
    {
        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST["pass"]);

        if ($user == "" || $pass == "")
         $error = "Not all fields were entered";
        else
        {
            $result = queryMySql("SELECT * FROM members WHERE user='$user'");

            if ($result->num_rows)
             $error = "That username already exists<br><br>";
            else
            {
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                queryMySql("INSERT INTO members VALUES('$user','$hash')");
                die("<h4>Account created</h4>Please log in.<br><br>");
            }
        }
    }

    echo <<<_END
        <form method='post' action='signup.php'>$error

        <div data-role='fieldcontain'>
            <label>Username</label>
            <input type='text' maxlength='16' name='user' value='$user' onBlur='checkUser(this)'>
            <label></label>
        </div>
        <div data-role='fieldcontain'>
            <label>Password</label>
            <input type='text' maxlength='16' name='pass' value='$pass'>
        </div>
        <div data-role='fieldcontain'>
            <label></label>
            <input data-transition='slide' type='submit' value='Sign up'>
        </div>
        </form>
_END;

?>
    </div><br>
</body>
</html>