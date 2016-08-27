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
	//validate the form fields on javascript
var x=document.forms["frm"]["userName"].value; //put the value of username field in a variable
if (x==null || x=="")//check whether the username field  is null or empty
  {
  alert("Please fill out the username");//show a message to fill out the username
  return false;  //do not let the form submit if the username is empty or null
  }
//put the value of userpassword in a variable
var y=document.forms["frm"]["userPassword"].value;
if (y==null || y=="")//check whether the userpassword id null or empty
  {
  alert("Please fill out the Password");//show an error message to fill out the password
  return false;//do not let the form submit if password is empty or null
  }
}
</script>
</head>

<body>
<?php include("databaseconnect.php");//include the mysql database connection file to connect to database?>
<?php
// define variables and set to empty values
$usernameErr = $passwordErr = "";
$username = $password =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {//check whether the form was submitted and the request method was post
  if (empty($_POST["userName"])) {//php validation in case javascript was not enabled on the browser
    $usernameErr = "Username is required";//show message that username is required
  } else {
    $username = test_userdata($_POST["userName"]);//if the username is not empty, trim extra spaces, slashes and put htmlspecialchars
  }

  if (empty($_POST["userPassword"])) {//php validation in case javascript was not enabled on browser
    $passwordErr = "Password is required";//show message that pssword is required if it is empty
  } else {
    $password = test_userdata($_POST["userPassword"]);//if the password is not empty,  trim extra spaces, slashes and put htmlspecialchars
  }//if everything is good check whether the username and password entered by user are actually correct
  $sql = "SELECT * FROM checkuser where username='$username' and password='$password'";
  $result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo $result->num_rows." found";//if it is there in the database it will return number of results which logically should be 1
	} else {
		echo "0 results";//if not in the database shows 0 results
	}
	$conn->close();
}
//test all fields

function test_userdata($data) {
  $data = trim($data);//trim spaces
  $data = stripslashes($data);//strip slashes from the data
  $data = htmlspecialchars($data);//add html special characters to data to make it html ready
  return $data;
}
?>
<!--add cdn to fontawesome-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<div class="container">
    <div class="row">
    	<!--form with name as frm, action means where the page should redirect when form is submitted. In this case it is same page $_SERVER["PHP_SELF"], on submit javascript validation of form with validateForm()-->
        <form name="frm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onSubmit="return validateForm();">
        <div class="col-md-4 col-md-offset-4">
            <div class="form-login">
            <h4>Login</h4>
            <!--placeholder field shows defult value for user and required means that user has to enter it. HTML5 error shows up if left blank-->
            <input type="text" id="userName" name="userName" class="form-control input-sm chat-input" placeholder="username" value="<?php echo $username;?>" required/><span class="error">* <?php echo $usernameErr;?></span>
            </br>
            <!--same as username-->
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
