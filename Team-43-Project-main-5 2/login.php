


<?php



	if (isset($_POST['submitted'])){
		if ( !isset($_POST['email'], $_POST['password']) ) {
		 exit('Please fill both the email and password fields!');
	    }
		require_once ("connect_db.php");
		try {
			$stat = $db->prepare('SELECT password FROM users WHERE email = ?');
			$stat->execute(array($_POST['email']));
		    
			if ($stat->rowCount()>0){  
				$row=$stat->fetch();

				if (password_verify($_POST['password'], $row['password'])){ 
					
				  session_start();
					$_SESSION["email"]=$_POST['email'];
					//header("Location:projects.php");
					exit();
				
				 } else {
				  echo "<p style='color:red'>Error logging in, password does not match </p>";
				 }
		    } else {
			  echo "<p style='color:red'>Error logging in, Username not found </p>";
		    }
		}
		catch(PDOException $ex) {
			echo("Failed to connect to the database.<br>");
			echo($ex->getMessage());
			exit;
		}
    }

	//if the form has been submitted
if (isset($_POST['submitted'])){
	#prepare the form input
   
	 // connect to the database
	 require_once('connect_db.php');
	   
	 $username=isset($_POST['username'])?$_POST['username']:false;
	 $password=isset($_POST['password'])?password_hash($_POST['password'],PASSWORD_DEFAULT):false;
	 $email=isset($_POST['email'])?$_POST['email']:false;
   
	 
	 if (!($username)){
	   echo "Username wrong!";
	   exit;
	   }
	 if (!($password)){
	   exit("password wrong!");
	   } 
    
}
		
		?>	



