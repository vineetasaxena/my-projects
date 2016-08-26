<!doctype html>
<html lang="en-US">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bootstrap Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script>
  function validateForm()
{
var x=document.forms["frm"]["userName"].value;
if (x==null || x=="")
  {
  alert("Please fill out the username");
  return false;
  }

var y=document.forms["frm"]["userPassword"].value;
if (y==null || y=="")
  {
  alert("Please fill out the Password");
  return false;
  }
}
</script>
</head>

<body>
<?php include("databaseconnect.php");?>
<?php
// define variables and set to empty values
$usernameErr = $passwordErr = "";
$username = $password =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["userName"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_userdata($_POST["userName"]);
  }

  if (empty($_POST["userPassword"])) {
    $passwordErr = "Password is required";
  } else {
    $password = test_userdata($_POST["userPassword"]);
  }
  $sql = "SELECT * FROM checkuser where username='$username' and password='$password'";
  $result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo $result->num_rows." found";
	} else {
		echo "0 results";
	}
	$conn->close();
}
//test all fields

function test_userdata($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <form name="frm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onSubmit="return validateForm();">
        <div class="col-md-4 col-md-offset-4">
            <div class="form-login">
            <h4>Login</h4>
            <input type="text" id="userName" name="userName" class="form-control input-sm chat-input" placeholder="username" value="<?php echo $username;?>" required/><span class="error">* <?php echo $usernameErr;?></span>
            </br>
            <input type="password" id="userPassword" name="userPassword" class="form-control input-sm chat-input" placeholder="password" value="<?php echo $password;?>" required/><span class="error">* <?php echo $passwordErr;?></span>
            </br>
            <div class="wrapper">
            <span class="group-btn">     
                <button class="btn btn-primary btn-md">login <i class="fa fa-sign-in"></i></button>
            </span>
            </div>
            </div>
        
        </div>
        </form>
    </div>
</div>
</body>
</html>
