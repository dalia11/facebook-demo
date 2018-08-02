<?php
//session_start();
include ('userinfo.php');

?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- google jquery 2.2.2 -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
     
    
    <!-- bootstrap javascript -->
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- google lato -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- main css -->
    <link rel="stylesheet" type="text/css" href="main.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="jquery.js" > </script>
    <script >
$("document").ready(function(){
  var interval = setInterval(refresh_box(), 20000);
  function refresh_box() {
    $("#myDiv").load('userinfo.php');
  }
}
    </script>
<style>
    form{
        margin-left: 28px;
        
    }
.button {
    background-color: cadetblue;
    border-right: 1px solid black;
    color: white;
    padding: 10px 30px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    float: left;
}

.button:hover {
    background-color: cadetblue ;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #F0F8FF;
}
.button__badge {
  background-color: #fa3e3e;
  border-radius: 2px;
  color: white;
 
  padding: 1px 3px;
  font-size: 10px;
  
  position: absolute; /* Position the badge within the relatively positioned button */
  top: 0;
  right: 0;
}
</style>
</head>
<body>

<div class="row">
<form method="POST">
<button class="button" type="submit" name="home"> <i class="fa fa-home" aria-hidden="true"></i></button>
<button class="button" type="submit" name="profile"> <i class=" fa fa-user-circle-o" aria-hidden="true"></i> Profile</button>
<button class="button" type="submit" name="request"> <i class="fa fa-user-plus" aria-hidden="true"></i>  <?php $fr=$_SESSION['counts']; echo $fr;?> </button>
<button class="button" type="submit" name="about"><i class="fa fa-pencil" aria-hidden="true"></i> </button>
<button class="button" type="submit" name="search"><i class="fa fa-search" aria-hidden="true"></i> </button>
<button class="button" type="submit" name="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> </button>
</form>
</div>
    

<?php if(isset($_POST['home']))
{
header('location:home.php');
}
else if(isset($_POST['profile']))
{
header('location:profile.php');
}
else if(isset($_POST['about']))
{
header('location:about.php');
}
else if(isset($_POST['request']))
{
header('location:requests.php');
}
else if(isset($_POST['search']))
{
header('location:search.php');
}
else if(isset($_POST['logout']))
{
	
	session_destroy();
header('location:login.php');
}


?>

</body>
</html>
