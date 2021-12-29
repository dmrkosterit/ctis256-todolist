<?php
include_once "../DBSetup/db.php";
extract($_POST);
if(isset($action)){
$error=[];
//The rule of the username is 
//1- The username must start with letter
//2- Username should be between 5-32 characters
//3- Letters and numbers only
$usernameRE='/^[A-Za-z][A-Za-z0-9]{4,31}$/';
if(preg_match($usernameRE,$username)===0){
   $error[]="username";
 }

// Password  \s : all whitespace chars.  \S : non-whitespace chars.
$passwordRE='/^\S{6,12}$/';
 if(preg_match($passwordRE,$password)===0){
   $error[]="password";
 }

 if(!empty($username) && !empty($password) && !empty($password_confirmed) && empty($error)){
	 
	if($password==$password_confirmed){
		$sql="insert into users (usertype,username, passwd) values(?,?,?)";
		$stmt = $db->prepare($sql);
		$stmt->execute([1,$username, $password]);
		header("Location:login.php");
	}
	else{
		$error[]="confirmPassword";
	}
 }

}
?>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../style/loginRegister.css" media="screen">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <div class="wrapper" id="boxRegister">
	  <header>Register</header>
	  <div class="inputField">
	  <form method="post" action="">
    	 <table>
			 <tr>
				 <td>
					 <label for="username">Username</label>
					 <input type="text" name="username" value="<?=$username??''?>" required>
				 </td>
			 </tr>
			 <tr>
         		 <td>
            		<?php
                	 if(isset($error)){
                  		 echo in_array("username",$error) ? "<span style='color:red;'>Enter a valid username</span>" : "";
                 		}
           			?>
         		</td>
        	</tr>
			 <tr>
				 <td>
					 <label for="password">Password</label>
					 <input type="password" name="password" required>
				 </td>
			 </tr>
			 <tr>
          		<td>
           			 <?php
                 	if(isset($error)){
                   	echo in_array("password",$error) ? "<span style='color:red;'>Enter a valid password</span>" : "";
                 	}
            		?>
          		</td>
        	</tr>
			 <tr>
				 <td>
					 <label for="password_confirmed">Confirm password</label>
					 <input type="password" name="password_confirmed" required>
				 </td>
			 </tr>
			 <tr>
          		<td>
           			 <?php
                 	if(isset($error)){
                   	echo in_array("confirmPassword",$error) ? "<span style='color:red;'>Your password did not match</span>" : "";
                 	}
            		?>
          		</td>
        	</tr>
			 <tr>
			 	<td>
			 		<button type="submit" name="action" class="btn btn-primary btn-lg btn-block">Create new user</button>
				 </td>
			 </tr>
			 <tr>
				<td>
					 <p>Already a member? <a href="login.php">Sign in</a></p>
				</td>
			 </tr>
	 	</table>
  	</form>
	</div> 
  </div>
</body>
</html>
