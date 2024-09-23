<head>
    <title>Event Selector - Sign-up</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>


<?php
include_once 'View/shared/header.php';
?>

<section id="signUp-section" class="fixed-background">
    <div class="form-div">
        <form class="entry-form" action="Controller/signUpHandler.php" method="POST">
            <div class="form-header">
                <h1>Sign-up Form</h1>
                <p>Create a new account to access the event listing page.</p>
            </div>
            <div class="form-group">
                <label class="form-label" for="user">Username:</label>
                <input class="form-control" type="text" name="user" placeholder="Username...">
            </div>
            <div class="form-group">
                <label class="form-label" for="pass">Password:</label>
                <input class="form-control" type="password" name="password" placeholder="Password...">
            </div>
            <div class="form-group">
                <label class="form-label" for="pass">Re-Password:</label>
                <input class="form-control" type="password" name="passwordRepeat" placeholder="Re-enter password...">
            </div>
            <button class="btn btn-primary mb-2" type="submit" name="submit">Create Account</button>
            <?php
            if (isset($_GET["error"])) {
                echo "<div>";
                if ($_GET["error"] == "emptyInput") {
                    echo "<p class='message-error'>All fields must not be left blank!</p>";
                } else if ($_GET["error"] == "invalidUsername") {
                    echo "<p class='message-error'>Username can only contain alphanumerical values!</p>";
                } else if ($_GET["error"] == "passwordNotMatch") {
                    echo "<p class='message-error'>Passwords must match with each other!</p>";
                } else if ($_GET["error"] == "usernameTaken") {
                    echo "<p class='message-error'>Username was already taken!</p>";
                } else if ($_GET["error"] == "stmtFailed") {
                    echo "<p class='message-error'>Something went wrong. Try again.</p>";
                } else if ($_GET["error"] == "none") {
                    echo "<p class='message-success'>Account has been succesfully created. You may proceed to the login page!</p>";
                }
                echo "</div>";
            }
            ?>
        </form>

    </div>
</section>


<?php
include_once 'View/shared/footer.php';
?>