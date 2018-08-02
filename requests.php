<?php include('tabs.php');?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style>
    body{ background-image: url(fo1.png) ;
           background-repeat: repeat;
           border:none;
           margin-left: 0px;
        margin-top: 0px;}
    </style>
</head>
<body>
<h3>Requests:</h3>
       <?php
              if( isset($_GET['add_id']) && !empty($_GET['add_id']))

{
   $fid=$_GET['add_id'];
   $sql3="Insert into friend (`userid`,`friendid`,`approved`)Values('$fid','$userid',True);";
     if($connection->query($sql3) === TRUE)
        {
          echo "friendship saved ";
        }
        else{echo "Error:".$sql3."<br>".$connection->connect_error;}
    $sql3="UPDATE  friend set `approved`=True where userid='$userid' and friendid='$fid';";
    if($connection->query($sql3) === TRUE)
        {
          echo "friendship saved ";
        }
        else{echo "Error:".$sql3."<br>".$connection->connect_error;}

} 
if( isset($_GET['rmv_id']) && !empty($_GET['rmv_id']))
{
    $fid=$_GET['rmv_id'];
$sql2="DELETE FROM friend where userid='$userid' and friendid='$fid';";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship removed ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
}
if( isset($_GET['rmv2_id']) && !empty($_GET['rmv2_id']))
{
    $fid=$_GET['rmv2_id'];
$sql2="DELETE FROM friend where userid='$userid' and friendid='$fid';";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship removed ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
        $sql2="DELETE FROM friend where userid='$fid' and friendid='$userid';";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship removed ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
}


     
                                

                                $sql1="SELECT friendid from friend where userid='$userid' and approved=FALSE;";
                                
                                $results=$connection->query($sql1);
                                //$count=mysqli_num_rows($results);
                                if($results->num_rows>0)
                                {while($row1=$results->fetch_assoc()){
                                    $fid=$row1["friendid"];
                                    $sql2="Select First_name,Last_name,userPic From users where user_id='$fid'; ";
                                    $result2=$connection->query($sql2);
                                    $row2=$result2->fetch_assoc();
                                    $first=$row2["First_name"];
                                    $last=$row2["Last_name"];
                                    $img=$row2["userPic"];        
                                                      ?>
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-5">

                                   <div id="img_head" class="thumbnail">
                                        <img class="img-thumbnail img-responsive" alt='zhisong ge's head photo' width="200" height="200" src="pictures/<?php echo $img;?>" >
                                    </div>
                                      
                                </div>
                                <div class="col-sm-7">
                                    
                                    <div id="name">
                                       <a  href="friendpage.php?view_id=<?php echo $fid;?>" ><?php echo $first." ".$last;?> </a>
                                    </div>
                                
                                </div> 
                                <div class="col-sm-7">
                                    
                                    <div id="name">
                                         <a  href="requests.php?add_id=<?php echo $fid;?>" ><i class="fa fa-plus fa-3x "></i></a>

                                         <a href="requests.php?rmv_id=<?php echo $fid;?>"><i class="fa fa-times fa-3x "></i></a>
                                    </div>
                                
                                </div> 

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                                
                            }
                                }
                                ?>

</body>
</html>