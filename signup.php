<?php
require "header.php"
?>

<main>
    <h1>Sign up</h1>
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo "<p>Empty fields</p>";
            } elseif ($_GET['error'] == "invalidmail") {
                echo "<p>Invalid E-mail</p>";
            } elseif ($_GET['error'] == "invalidmailuid") {
                echo "<p>Invalid E-mail and Login</p>";
            } elseif ($_GET['error'] == "invaliduid") {
                echo "<p>Invalid Login</p>";
            } elseif ($_GET['error'] == "passwordcheck") {
                echo "<p>Repeated password doesn't match</p>";
            } elseif ($_GET['error'] == "usernametaken") {
                echo "<p>User name has been taken</p>";
            }
        } elseif ($_GET['signup'] == "success") {
            echo "<p>SignUp successful</p>";
        }
    ?>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="uid" placeholder="Username">
        <input type="text" name="mail" placeholder="E-Mail">
        <input type="password" name="pwd" placeholder="Password">
        <input type="password" name="pwd-repeat" placeholder="Repeat Password">
        <button type="submit" name="signup-submit">Sign Up</button>
    </form>
</main>

<?php
require "footer.php"
?>

