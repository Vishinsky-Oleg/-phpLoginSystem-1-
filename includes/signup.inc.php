<?php
if (isset($_POST['signup-submit'])) {

    require "dbh.inc.php";

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $password_repeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($password_repeat))
    {
        header("Location: ../signup.php?error=emptyfields&uid=".$username."email=".$email);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../signup.php?error=invalidmail&uid=".$username);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invaliduid&email=".$email);
        exit();
    }
    elseif ($password !== $password_repeat)
    {
        header("Location: ../signup.php?error=passwordcheck&email=".$email."&uid=".$username);
        exit();
    }
    else
    {

        $sqlvar = "SELECT `uidUsers` FROM `users` WHERE `uidUsers`=?";
        $statement = mysqli_stmt_init($mysql);
        if (!mysqli_stmt_prepare($statement, $sqlvar))
        {
            header("Location: ../signup.php?sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $resultCheck = mysqli_stmt_num_rows($statement);
            if ($resultCheck > 0)
            {
                header("Location: ../signup.php?usernametaken&mail=".$email);
                exit();
            }
            else
            {
                $sqlvar = "INSERT INTO `users` (`uidUsers`, `emailUsers`, `pwdUsers`) VALUES (?, ?, ?)";
                $statement = mysqli_stmt_init($mysql);
                if (!mysqli_stmt_prepare($statement, $sqlvar))
                {
                    header("Location: ../signup.php?sqlerror");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($statement);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }

    }
    mysqli_stmt_close($statement);
    mysqli_close($mysql);
}
else {
    header("Location: ../signup.php");
    exit();
}
