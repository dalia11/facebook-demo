<?php
$phone=array();
$type = array();
include ('tabs.php');

    
         $sql1 = "SELECT phone_no,type from phones where user_id=$userid ;";
        $result1 = $connection->query($sql1);
        if($result1->num_rows>0)
        {
                while($row1 = $result1->fetch_assoc())
                {array_push($phone, $row1['phone_no']);
                array_push($type, $row1['type']);}
        }
        
        list($year,$month,$day)=explode("-", $birthdaydate);


 

if(isset($_POST['update'])&&$_POST['update']!=null)
{
    
     $imgFile = $_FILES['user_image']['name'];
     $tmp_dir = $_FILES['user_image']['tmp_name'];
     $imgSize = $_FILES['user_image']['size'];


    
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $day=$_POST['day'];
    $month=$_POST['month'];
    $year=$_POST['year'];
    if (isset($_POST['gend']) && $_POST['gend']=="female"){ $gen= TRUE; echo "genderrr".$gen;}
    if (isset($_POST['gend'])&& $_POST['gend']=="male") {$gen= FALSE;echo "genderrr".$gen;}
    echo "gender".$gen;
    $sharta='-';
    $birthday=$year.$sharta;
    $birthday=$birthday.$month;
    $birthday=$birthday.$sharta;
    $birthday=$birthday.$day;
    $password=$pass;

    if($_POST['pass'] != null)
    {
        $password=$_POST['pass'];
        $password=hash("md5",$password);
        echo "yeaaay";
    }


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
    
    if(isset($_POST['aboutme']))
    {
      $about=$_POST['aboutme'];
    }
      if (empty($imgFile))
    {
    }
  else
    {
      
       $upload_dir = 'pictures/'; // upload directory
 
       $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
       $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
       $userpic = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
       if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
          if($imgSize < 5000000)    {
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
    
    if($password==$pass )
    {
        if($_POST['pass2'] != null)
        { 
          $pass2=$_POST['pass2'];
          $pass2=hash("md5",$pass2);
          $password=$pass2;
        }

       $sql="UPDATE `users` SET `First_name`='$firstname' , `Last_name`='$lastname' , `Nickname`='$nickname' , `Email`='$email' , `Password`='$password', `Gender`='$gen' , `Birthday_Date`='$birthday' , `aboutme`='$about', `hometown`='$hometown' , `marital_status`='$status',`userPic`='$userpic' WHERE `user_id`='$userid';";
       
       if($_POST['phones'] != null && $_POST['types'] != null)
      {for( $i = 0; $i < count($_POST['phones']); $i++ )
      {
        $phonenew=$_POST['phones'][$i];
        $typenew=$_POST['types'][$i];
        //echo $typenew .' = '. $phonenew .'rakam'.$i.'<br >';
        //echo $phone[$i];
        $sql2="UPDATE `phones` SET `phone_no`='$phonenew' , `type`='$typenew' WHERE `user_id`='$userid' AND `phone_no`='$phone[$i]'; ";
        
        if($connection->query($sql2) === TRUE)
        {
          //echo "phone updated ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}}}
        if($_POST['phone1'] != null && $_POST['type1'] != null)
      {for( $i = 0; $i < count($_POST['phone1']); $i++ )
      {
        $phone2=$_POST['phone1'][$i];
        $type2=$_POST['type1'][$i];
        //echo $type2 .' = '. $phone2 .'rakam'.$i.'<br >';
        if($phone2 !=null)
        {$sql1="INSERT INTO `phones`(`user_id`, `phone_no`, `type`) VALUES('$userid','$phone2','$type2');";
        
        if($connection->query($sql1) === TRUE)
        {
          echo "phone updated ";
        }
        else{echo "Error:".$sql1."<br>".$connection->connect_error;}}}}
    

    if($connection->query($sql) === TRUE)
    {
       echo ' successfuly updated !';
       if($userpic!=$userpic2)
    {
        if($gen==TRUE)
            $pst=$firstname.' '.$lastname.' has changed her profile picture';
        else
            $pst=$firstname.' '.$lastname.' has changed his profile picture';
        $flag='t';
        $img1=$userpic;
        $sql = "INSERT INTO post (statpost,ispublic,postedtime,user_id,img) VALUES ('$pst','$flag',now(),'$userid','$img1');";

if ($connection->query($sql) === true) {
 // echo "NEW RECORD CREATED SUCCESSFULLY";
} else {
    echo "ERROR: " . $sql . "<BR>" . $connection->error;
}

    }
       header('location:about.php');

    }
    else{echo "Error:".$sql."<br>".$connection->connect_error;}
}
else
{
    echo "Wrong Password";
}

} 

?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript">
<!-- DONT FORGET TO INCLUDE JQUERY //-->
$(document).ready(function() {
   $('.add_phone').click(function() {
      $('p.number:last').after('<p class="number">'+ $('p.number').html() +'</p>');
   });
});
</script>
    <style type="text/css">
        h1 {
            color: red;
            text-align: center;
        }
        </style>
</head>

<body>
 <h1> <?php echo 'Welcome ' . $firstname; ?> </h1>

<center>


<H1>Edit your profile </H1>
<br/>

        
        <FORM action="" method="POST" enctype="multipart/form-data">
            <img width='100' height='100' src="pictures/<?php echo $userpic;?>" alt='Default Profile Pic'><br>
            <input type="file" name="user_image" id="fileToUpload" ><br>
           <FONT size="5" COLOR="#000059"> First Name:</FONT></a><br>
            <input type="text"  name="firstname" value="<?php echo $firstname; ?>" size=10><br>
            <FONT size="5" COLOR="#000059">Last Name:</FONT></a><br>
            <input type="text" name="lastname" value="<?php echo $lastname; ?>" size=10><br>
            <FONT size="5" COLOR="#000059">Email:</FONT></a><br>
            <input type="text" name="email" value="<?php echo $email; ?>" size=10><br>
            <FONT size="5" COLOR="#000059">Nickname:</FONT></a><br>
            <input type="text" name="nickname" value="<?php echo $nickname; ?>" size=10><br>
            <FONT size="5" COLOR="#000059">Gender:</FONT></a><br>
            <input type="radio" name="gend" value="female" <?php if($gen==TRUE){?> checked="checked"<?php } ?> /> Female
            <input type="radio" name="gend" value="male" <?php if($gen==FALSE){?> checked="checked"<?php } ?> /> male<br>
            <FONT size="5" COLOR="#000059">About me:</FONT></a><br>
            <textarea name="aboutme" rows="4" cols="50">
            <?php echo $aboutme; ?>
            </textarea><br>
            <FONT size="5" COLOR="#000059">Hometown:</FONT></a><br>
            <input type="text" name="hometown" value="<?php echo $hometown; ?>  " size=10><br>
            <FONT size="5" COLOR="#000059">Old Password:</FONT></a><br>
            <input type="Password" name="pass" size=10><br>
            <FONT size="5" COLOR="#000059">New Password:</FONT></a><br>
            <input type="Password" name="pass2" size=10><br>
            <FONT size="5" COLOR="#000059">Status:</FONT></a><br>
            </select>   
            <select name="status" id="status" onchange="" class="form-control" size="1">
            <option value="<?php echo $status; ?>" selected><?php echo $status; ?></option>
            <?php if($status=="Single"){?>
            <option value="Married">Married</option>
            <option value="Engaged">Engaged</option>
            <option value="Complicated">Complicated</option>
            <?php } if($status=="Engaged"){?>
            <option value="Married">Married</option>
            <option value="Single">Engaged</option>
            <option value="Complicated">Complicated</option>
            <?php } if($status=="Married"){?>
            <option value="Single">Married</option>
            <option value="Engaged">Engaged</option>
            <option value="Complicated">Complicated</option>
            <?php } if($status=="Complicated"){?>
            <option value="Single">Married</option>
            <option value="Engaged">Engaged</option>
            <option value="Married">Complicated</option>
            <?php }
            if($status== null){?>
            <option value="Single">Married</option>
            <option value="Engaged">Engaged</option>
            <option value="Married">Complicated</option>
            <option value="Complicated">Complicated</option>
            <?php }?>
        </select><br>

<div class="row">
            <FONT size="5" COLOR="#000059">Birthday Date:</FONT></a><br>
            <select name="year" id="year" class="form-control">
            <option value="<?php echo $year; ?>" selected><?php echo $year; ?></option>                       
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
            <option value="<?php echo $month; ?>" selected><?php echo $month; ?></option>
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
        </select>

        <select name="day" id="day" onchange="" class="form-control" size="1">
        <option value="<?php echo $day; ?>" selected><?php echo $day; ?></option>
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
      </select>
      </div>
      <br>
      <br> 
      <FONT size="5" COLOR="#000059">Phone number:</FONT></a><br>  
      <label for="name"></label>
  <?php for($i = 0; $i < count($phone); $i++ ){?>
  <input type="text" name="phones[]" value="<?php echo $phone[$i]; ?>" class="sf" />
  <select name="types[]">
    <option value="<?php echo $type[$i]; ?>"><?php echo $type[$i]; ?></option>
    <option value="Office">Office</option>
    <option value="Cell">Cell</option>
    <option Value="Fax">Fax</option><?php}?>
  </select><br><?php }?>

  <p class="number">
  <input type="text" name="phone1[]" class="sf" />
  <select name="type1[]">
    <option value="Office">Office</option>
    <option value="Cell">Cell</option>
    <option Value="Fax">Fax</option>
  </select>
</p>
<a href="javascript:void();" class="add_phone">Add More</a>  <br>         
        <input type="submit" name="update" value="update">



        

</FORM>
</center>
</body>
</html>

