<?php
include('conn.php');
session_start();
$_SESSION['ID']="";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="shortcut icon" href="icon.png">
<link rel="stylesheet" href="style.css" />
</head>
<body>

  
 <script type="text/javascript">
 function validateFormlog()
{
  var emaillog = document.getElementById("email").value;
  var passlog =document.getElementById("password").value;
  if(namelog==null || namelog=="" ||  passlog==null || passlog=="")
  {
    alert ("please complete the fields to login");
    return false;
  }
  else
  {
    return true;
  }

}
</script> 
<div class="left"> <img src="logo.png" width="200" height="60" /></a></div>
<div class="topleft" ><img src="login.png" width="500" height="400" /></div>
<div class="form">
<h1>Log In</h1>
<form action="" method="post" name="login" onsubmit="return  validateFormlog();">
<input type="text" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />
</form>
<p>Not registered yet? <a href='registration.php'><FONT COLOR="#000059">Sign Up!</FONT></a></p>
</div>
</body>
</html>
<?php
if(isset($_POST['email']) and isset($_POST['password']) )
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=hash("md5",$password);

    $sql1= "SELECT user_id FROM users WHERE email= '$email' and password='$password'";

    if($result=mysqli_query($connection,$sql1))
   {
    $rowcount=mysqli_num_rows($result);
   }
   if($rowcount !=0)
   {
      $row = $result->fetch_assoc();
      
      $_SESSION['ID']=$row['user_id'];
      header('location:profile.php');
   }
   else
   {
     echo "invalid username or password";
   }
   
    

}
?>


