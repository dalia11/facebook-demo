<?php
include('tabs.php');
echo "<br>"."<br>"."<br>";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style>
        body{
     background-image: url(fo1.png) ;
           background-repeat: repeat;
           border:none;
           margin-left: 0px;
           margin-top: 0px;
        }
    </style>
</head>
<body>
<form method="POST" enctype="multipart/form-data" >  
    
  Post:<textarea required name="pst" value="Clear"rows="5" cols="40" placeholder="what's on your mind?" id="pst"></textarea>
  
  <br><br>
  Privacy:
  <input type="radio"  name="privacy" required value='f'>Friend
  <input type="radio"  name="privacy" required value='t'>  Public
  <input type="submit" name="submit" value="Post" class="btn btn-info" required>  
  <input type="file" name="user_image" id="fileToUpload" ;>
</form>
<?php

if (isset($_POST['submit']) && isset($_POST['pst']))
{
	$imgFile = $_FILES['user_image']['name'];
       $tmp_dir = $_FILES['user_image']['tmp_name'];
       $imgSize = $_FILES['user_image']['size'];
    if (empty($imgFile))
    {
             
                    $img1=null;
                
    }
  else
    {
      
       $upload_dir = 'pictures/'; // upload directory
 
       $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
       $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
       $img1 = rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
       if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
          if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$img1);
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
	$pst = $_POST["pst"];
	$flag=$_POST["privacy"];

  $sql = "INSERT INTO post (statpost,ispublic,postedtime,user_id,img) VALUES ('$pst','$flag',now(),'$userid','$img1');";

if ($connection->query($sql) === true) {
 // echo "NEW RECORD CREATED SUCCESSFULLY";
} else {
    echo "ERROR: " . $sql . "<BR>" . $connection->error;
}
}

  $sqlslc = "SELECT * from post as p LEFT JOIN users u ON p.user_id=u.user_id LEFT JOIN friend as f ON f.userid=p.user_id WHERE p.user_id=1 OR p.ispublic='t' OR (p.ispublic='f' and f.approved=1) ORDER by p.postedtime DESC";
$selected = $connection->query($sqlslc);


if ($selected->num_rows > 0) {
     // output data of each row
     while($row = $selected->fetch_assoc()) {
     	$img2=$row["img"];
      $postt=$row["statpost"];
      $sqlemoji="SELECT * FROM emojis;";
            $emojisresults=$connection->query($sqlemoji);
            while($row2=$emojisresults->fetch_assoc())
            {
              $chars=$row2["chars"];
              $img="<img src='emojis/".$row2["image"]."'/>";
              $postt=str_replace($chars, $img, $postt);
            }
      

            if($row["ispublic"]=='f')
            {
               $print='friend';

            }
            else if($row["ispublic"]=='t'){
              $print='public';
            }
         $id3=$row["user_id"];
 
          $sql1="SELECT First_name,Last_name from `users` WHERE user_id=$id3";
        $res=mysqli_query($connection,$sql1);
        $resu = $res->fetch_assoc();
        $fname=$resu["First_name"];
         $lname=$resu["Last_name"]; 
          ?>
          <h4><a  href="friendpage.php?view_id=<?php echo $id3;?>" ><?php echo $fname." ".$lname;?> </a></h4>
          <?php
         echo  $postt. "<br> ";

      if($img2!=null || $img2!=""){
         ?>
         <div class="row">
         <img class="img-thumbnail img-responsive" alt='zhisong ge's head photo' width="200" height="200" src="pictures/<?php echo $img2;?>" >
         </div>

         <?php  

     }
     echo $row["postedtime"].  "<br>";
      
echo "<hr>";
   }

} 
?>
</body>
</html>