<!DOCTYPE html>
<head>
    <title>Event Selector - Log-in</title>
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

<section id="login-section" class="fixed-background">
    <div class="form-div">
        <form class="entry-form" action="Controller/loginHandler.php" method="POST">
            <div class="form-header">
                <h1>Login Form</h1>
            </div>
            <div class="form-group">
                <label class="form-label" for="user">Username:</label>
                <input class="form-control" type="text" name="user" placeholder="Username...">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" name="password" placeholder="Password...">
            </div>
            <button class="btn btn-primary mb-2" type="submit" name="submit">Sign-in</button>
            <?php
            if (isset($_GET["error"])) {
                echo "<div>";
                if ($_GET["error"] == "emptyInput") {
                    echo "<p class='message-error'>All fields must not be left blank!</p>";
                } else if ($_GET["error"] == "incorrectLogin") {
                    echo "<p class='message-error'>Username or password was incorrect!</p>";
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