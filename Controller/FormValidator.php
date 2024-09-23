<?php

class FormValidator {

    /**
     * emptyInputSignup
     * Checks if user submitted an empty sign-up form on signUp.php page
     * Returns true if empty, else false
     * @param $name, $pwd, $pwdRepeat -> all strings
     */
    function emptyInputSignup($name, $pwd, $pwdRepeat) {
        $result = false;
        if (empty($name) || empty($pwd) || empty($pwdRepeat)) {
            $result = true;
        }
        return $result;
    }

    /**
     * emptyInputLogin
     * Checks if user submitted an empty log-in form on index.php page
     * Returns true if empty, else false
     * @param $name, $pwd -> all strings
     */
    function emptyInputLogin($name, $pwd) {
        $result = false;
        if (empty($name) || empty($pwd)) {
            $result = true;
        }
        return $result;
    }

    /**
     * invalidUsername
     * Checks if user submitted an non-alphanumerical name into the sign-up form on signUp.php page
     * Returns true if invalid, else false
     * @param $name -> string
     */
    function invalidUsername($name) {
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
            $result = true;
        }
        return $result;
    }

    /**
     * passwordMatch
     * Checks if user submitted non-matching password into the sign-up form on signUp.php page
     * Returns true if not matching, else false
     * @param $pwd, $pwdRepeat -> strings
     */
    function passwordMatch($pwd, $pwdRepeat) {
        $result = false;
        if ($pwd !== $pwdRepeat) {
            $result = true;
        }
        return $result;
    }

    /**
     * usernameTaken
     * Checks if the user tried to make an account with an already existing username within the attendee table
     * Returns true if the username was taken, else false
     * @param $conn -> connection to the database which holds the data w/ the tables
     * @param $name -> string
     */
    function usernameTaken($conn, $name) {
        //Create the prepared mysql statement
        $sql = "SELECT * FROM attendee WHERE name= ?";
        
        //Prepared statement
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $name, PDO::PARAM_STR);//Bind paramater 
        $stmt->execute();//Execute the statement
 
        //Get the result from the statement
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $row;
        } else {
            //If username is unique, proceed with account creation
            $result = false;
            return $result;
        }
    }

}
