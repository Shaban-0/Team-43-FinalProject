


<?php 

//To do:




 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the registration form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate password complexity
    if (validatePassword($password)) {
        // Password meets complexity requirements
        
        try{
    
            //register user by inserting the user info 
            $stat=$db->prepare("insert into users values(default,?,?)");
            $stat->execute(array($email, $password));
            
            $id=$db->lastInsertId();
            echo "Congratulations! You are now registered. Your ID is: $id  ";      
            
         }
         catch (PDOexception $ex){
            echo "Sorry, a database error occurred! <br>";
            echo "Error details: <em>". $ex->getMessage()."</em>";
         }

        echo "Account created successfully!";

    } else {
        // Password does not meet complexity requirements
        echo "Password must be at least 8 characters long and include at least 1 number, 1 capital letter, and 1 special character.";
    }
}

// Function to validate password complexity with regex
function validatePassword($password) {
    // Check if at least 8 characters long
    if (strlen($password) < 8) {
        return false;
    }

    // Check if has at least 1 number
    if (!preg_match("/[0-9]/", $password)) {
        return false;
    }

    // Check if contains at least 1 capital letter
    if (!preg_match("/[A-Z]/", $password)) {
        return false;
    }

    // Check if contains at least 1 special character
    if (!preg_match("/[^a-zA-Z0-9]/", $password)) {
        return false;
    }

    // Password meets all requirements
    return true;
}

 ?>
