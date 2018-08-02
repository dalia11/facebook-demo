<?php
if( isset($_GET['rmv_id']) && !empty($_GET['rmv_id']))
{
    $pid=$_GET['rmv_id'];
$sql2="DELETE FROM post where id='$pid';";
     if($connection->query($sql2) === TRUE)
        {
          echo "post removed ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
       
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<form method="POST" enctype="multipart/form-data" >  
    
  Post: <textarea required name="pst" value="Clear"rows="5" cols="40" placeholder="what's on your mind?" id="pst"></textarea>
  
  <br><br>
  Privacy:
  <input type="radio"  name="privacy" required value='f'>Friend
  <input type="radio"  name="privacy" required value='t'>  Public
  <input type="submit" name="submit" class="btn btn-info" value="Post" required>  
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


  $sqlslc = "SELECT statpost, postedtime , ispublic ,img,id FROM post where user_id='$userid' ORDER BY id DESC";
$selected = $connection->query($sqlslc);

if ($selected->num_rows > 0) {
     // output data of each row
     while($row = $selected->fetch_assoc()) {

     	$img2=$row["img"];
      $pid=$row["id"];
      $postt=$row["statpost"];


            if($row["ispublic"]=='f')
            {
               $print='friend';
            }
            else if($row["ispublic"]=='t'){
              $print='public';
            }
            $sqlemoji="SELECT * FROM emojis;";
            $emojisresults=$connection->query($sqlemoji);
            while($row2=$emojisresults->fetch_assoc())
            {
              $chars=$row2["chars"];
              $img="<img src='emojis/".$row2["image"]."'/>";
              $postt=str_replace($chars, $img, $postt);
            }


         echo "<br>  ". $postt;
if($img2!=null || $img2!=""){
         ?>
         <div class="row">
         <img class="img-thumbnail img-responsive" alt='zhisong ge's head photo' width="200" height="200" src="pictures/<?php echo $img2;?>" >
         </div>
         <?php }
         echo  "<br> ". $row["postedtime"]. " <br>" . $print ;
         ?>
         <a href="profile.php?rmv_id=<?php echo $pid;?>" title="click for delete" onclick="return confirm('sure to delete ?')"><i class="fa fa-minus-circle fa-3x "></i></a>
         <?php
     
     echo "<hr>";
   }
} 

$pst="";
$flag="";

include('conn.php');
$pst="";
$flag="";




?>

</body>
</html>