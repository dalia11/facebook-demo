<?php
include ('conn.php');
session_start();
$_SESSION['ID']="";
$nickname=null;
$phone=null;
$hometown=null;
$status=null;
$about=null;




if(isset($_POST['submit']) and isset($_POST['Firstname']) and isset($_POST['Lastname']) and isset($_POST['email']) and isset($_POST['password'])  and isset($_POST['gender'])  and isset($_POST['month'])  and isset($_POST['day'])  and isset($_POST['year']))
{   if (isset($_POST['gender']) && $_POST['gender']=="female") $bit= TRUE;

    else if (isset($_POST['gender']) && $_POST['gender']=="male") $bit= 0;


    $firstname=$_POST['Firstname'];
    $lastname=$_POST['Lastname'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $gender=$bit;
    $day=$_POST['day'];
    $month=$_POST['month'];
    $year=$_POST['year'];
    $pass=hash("md5",$pass);
    $dash='-';
    $birthday=$year.$dash;
    $birthday=$birthday.$month;
    $birthday=$birthday.$dash;
    $birthday=$birthday.$day;
 ///////////////
     $imgFile = $_FILES['user_image']['name'];
       $tmp_dir = $_FILES['user_image']['tmp_name'];
       $imgSize = $_FILES['user_image']['size'];
$_SESSION['pic'] = $imgFile;
    if(isset($_POST['nickname']))
    {
      $nickname=$_POST['nickname'];
    }
    
    if(isset($_POST['hometown']))
    {
      $hometown=$_POST['hometown'];
    }
     if(isset($_POST['status']))
    {
      $status=$_POST['status'];
    }
     if(isset($_POST['about']))
    {
      $about=$_POST['about'];
    }
    if (empty($imgFile))
    {
             
                    if($bit==TRUE)
                        $userpic='female.jpg';
                    else
                        $userpic='male.jpg';
                
    }
  else
    {
      
       $upload_dir = 'pictures/'; // upload directory
 //y7awel to lower case
       $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
       $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
       $userpic = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
      //ydawar 3ala extension mwgoud wala la2
       if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
          if($imgSize < 5000000)    {
              ////////////////////
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
     //echo "<img width='100' height='100' src='$upload_dir.$userpic' alt='Default Profile Pic'>";
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }


    }

{

    $sql1= "SELECT user_id FROM users WHERE email= '$email'";

   if($result=mysqli_query($connection,$sql1))
   {
    $rowcount=mysqli_num_rows($result);
   }
  if($rowcount!=0)
  {
    echo "email already exists";
  }
  else
  {
    
    $sql2="INSERT INTO `users`(`First_name`,`Last_name`,`Nickname`,`Email`,`Password`,`Gender`,`Birthday_date`,`FB_Join_Date`,`aboutme`,`hometown`,`marital_status`,`userPic`) VALUES('$firstname','$lastname','$nickname','$email','$pass',$gender,'$birthday',curdate(),'$about','$hometown','$status','$userpic');";
    
    


   

    if($connection->query($sql2) === TRUE)
    {
      $sql3="select user_id from users where email='$email';";
      $result=$connection->query($sql3);
      $row=$result->fetch_assoc();
      $id=$row['user_id'];
      $_SESSION['ID']=$id;
        
       if(isset($_POST['phone'])&&isset($_POST['type']))
      {for( $i = 0; $i < count($_POST['phone']); $i++ )
      {
        $phone=$_POST['phone'][$i];
        $type=$_POST['type'][$i];
        if($phone !=null)
        {$sql1="INSERT INTO `phones`(`user_id`, `phone_no`, `type`) VALUES('$id','$phone','$type');";
        
        if($connection->query($sql1) === TRUE)
        {
          echo "phone saved ";
        }
        else{echo "Error:".$sql1."<br>".$connection->connect_error;}}
      }}

       echo "successfuly registered to the table !";
       header('location:profile.php');
    }
    else{echo "Error:".$sql2."<br>".$connection->connect_error;}

    }

    $connection->close();
    
}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>REGISTERATION</title>
<link rel="shortcut icon" href="icon.png">
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
<!-- DONT FORGET TO INCLUDE JQUERY (framework for js)//-->
$(document).ready(function() {
   $('.add_phone').click(function() {
      $('p.number:last').after('<p class="number">'+ $('p.number').html() +'</p>');
   });
});
</script>

<script type="text/javascript">
function validateForm() {
  var year= document.getElementById("year").value;
  var month=document.getElementById("month").value;
  var day =document.getElementById("day").value;
   if(year=="--" || month=="--" || day=="--")
  {
    alert ("please enter your birthdate");
    return false;
  }

}


</script>

</head>

<body>
  <div class="left"> <img src="logo.png" width="200" height="60" /></div>
   <div class="topleft" ><img src="logg.png" width="500" height="330" /></div>
<div class="form">  
<h1><FONT COLOR="#000059">Sign Up</FONT></h1>
<form method="post" action=" " id="form" name="registeration" enctype="multipart/form-data" onsubmit="return  validateForm();">
<FONT size="5" COLOR="#000059">First Name:</FONT>
<input type="text" name="Firstname" placeholder="Firstname" required /><?php echo "*"; ?><br>

<FONT size="5" COLOR="#000059">Last Name:</FONT>
<input type="text" name="Lastname" placeholder="Lastname" required /><?php echo "*"; ?><br>


<FONT size="5" COLOR="#000059">Email:</FONT>
<input type="email" name="email" placeholder="Email" required /><?php echo "*"; ?><br>

<FONT size="5" COLOR="#000059">Nickname:</FONT>
<input type="text" name="nickname" placeholder="Nickname"  /><br>

<FONT size="5" COLOR="#000059">Password:</FONT>
<input type="password" name="password" placeholder="Password" required  /><?php echo "*"; ?><br>

<FONT size="5" COLOR="#000059">Hometown:</FONT>
<input type="text" name="hometown" placeholder="hometown" /><br>


<FONT size="5" COLOR="#000059">Birthday:</FONT>


<select name="year" id="year" class="form-control" >
            <option value="--">Year</option>                       
            <?php
                for($i=date('Y'); $i>1899; $i--) {
                    $birthdayYear = '';
                    $selected = '';
                    if ($birthdayYear == $i) $selected = ' selected="selected"';
                    print('<option value="'.$i.'"'.$selected.'>'.$i.'</option>'."\n");
                }
            ?>                         
          </select>   

<select name="month" id="month" onchange="" class="form-control" size="1">
            <option value="--" >Month</option>
            <option value="01">Jan</option>
            <option value="02">feb</option>
            <option value="03">mar</option>
            <option value="04">apr</option>
            <option value="05">may</option>
            <option value="06">june</option>
            <option value="07">july</option>
            <option value="08">Aug</option>
            <option value="09">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>

        <select name="day" id="day" onchange="" class="form-control" size="1" >
        <option value="--" >Day</option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>
        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select> <?php echo "*"; ?>
      <br>


<FONT size="5" COLOR="#000059">Gender:</FONT>
<input required type="radio" name="gender"  value="female">Female
<input required type="radio" name="gender"  value="male">Male <?php echo "*"; ?> <br> 



<FONT size="5" COLOR="#000059">Status:</FONT><br>
<input type="radio" name="status" <?php if (isset($status) && $status=="Single") echo "checked";?> value="Single">Single
<input type="radio" name="status" <?php if (isset($status) && $status=="Married") echo "checked";?> value="Married">Married<br>
<input type="radio" name="status" <?php if (isset($status) && $status=="Engaged") echo "checked";?> value="Engaged">Engaged
<input type="radio" name="status" <?php if (isset($status) && $status=="Complicated") echo "checked";?> value="Complicated">Complicated <br> 

<FONT size="5" COLOR="#000059">About you:</FONT><br>
<textarea name="about" rows="4" cols="50">

</textarea><br>
<img width='100' height='100' src='pictures/male.jpg' alt='Default Profile Pic'><br>


<FONT size="5" COLOR="#000059">Choose your profile picture:</FONT><br>
//image
<input type="file" name="user_image" id="fileToUpload" ;>
<p class="number">
<FONT size = "5" COLOR="#000059">Phone Number:</FONT>
  <label for="name"></label>
  <input type="text" name="phone[]"  class="sf" />
  <select name="type[]">
    <option value="Office">Office</option>
    <option value="Cell">Cell</option>
    <option Value="Fax">Fax</option>
  </select>
</p>
<a href="javascript:void();" class="add_phone">Add More</a>

<input type="submit" name="submit" value="Register" /><br>

<p>Already registered?<a href="login.php"><FONT COLOR="#000059"> Sign In</FONT></a></p>
</form>
</div>
</body>
</html>
