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
  <div class="wrapper" id="box">
	  <header>Register</header>
	  <div class="inputField">
	  <form method="post" action="signup.php">
    	 <table>
			 <tr><td>Username</td></tr>
			 <tr>
				<td>
					<input type="text" name="username" value="<?=$username??''?>">
				</td>
			 </tr>
			 <tr><td>Password</td></tr>
			 <tr>
				<td>
					<input type="password" name="password">
				</td>
			 </tr>
			 <tr><td>Confirm password</td></tr>
			 <tr>
				<td>
					<input type="password" name="password_confirmed">
				</td>
		 	</tr>
			 <tr>
			 	<td>
			 		<button type="submit" name="action" class="btn btn-primary btn-lg btn-block">Register</button>
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
