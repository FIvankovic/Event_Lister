<?php

session_start(); //Start session
setcookie(session_id(), "", time() - 3600);
session_unset(); //Free all sessions
session_destroy(); //Destroy session

//Throw the user back to the login page index.php
header("location: ../index.php");

