<?php 
include('tabs.php');

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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Friends</title>
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
</head>
<body>
    <h1>Friends</h1>
<div class="container">

                                




    <?php
                                

                                $sql1="SELECT friendid from friend where userid='$userid' and approved=TRUE;";
                                
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
                                        
                                         <a href="friends.php?rmv2_id=<?php echo $fid;?>"><i class="fa fa-minus-circle fa-3x " title="click for delete" onclick="return confirm('sure to delete ?')"></i></a>
                                    </div>
                                
                                </div> 


                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php
                                
                            }
                                }?>
            





</div>
  



</div>


 </body>
 </html>       