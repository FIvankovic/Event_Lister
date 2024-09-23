<?php
session_start();
?>


<body>
    <!-- Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Visible only when page resized/mobile-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signUp.php">Sign-up</a>
                </li>
                <?php
                if (isset($_SESSION["name"])) {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='myEvents.php'>My Events</a>
                        </li>";
                    echo "<li class='nav-item'>
                                <a class='nav-link' href='eventListing.php'>Event Listing</a>
                             </li>";

                    if ($_SESSION["role"] === 1) {
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='adminBoard.php'>Admin Board</a>
                            </li>";
                    }

                    echo "<li class='nav-item nav-profile'>User: " . $_SESSION["name"] . "<li>";
                    echo "<li class='nav-item logout-btn' data-toogle='tooltip' data-placement='top' title='Logout'><a class='nav-link' href='Controller/logOut.php'><i class='fas fa-door-open logout-icon'></i></a></li>";
                }
                ?>

            </ul>
        </div>
    </nav>