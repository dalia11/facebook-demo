<?php
include('tabs.php');


$userid=$_SESSION['ID'];
if(isset($_GET['view_id']) && !empty($_GET['view_id']))
{$friendid=$_GET['view_id'];
}   
$sql = "SELECT * from users where user_id=$friendid ;";
$result = $connection->query($sql);
$phone=array();
$type = array();
    
if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $firstname=$row["First_name"];
        $lastname=$row["Last_name"];
        $nickname=$row["Nickname"];
        $email=$row["Email"];
        $pass=$row["Password"];
        $gender=$row["Gender"];
        $birthdaydate=$row["Birthday_Date"];
        $aboutme=$row["aboutme"];
        $hometown=$row["hometown"];
        $status=$row["marital_status"];
        $userpic=$row["userPic"];

        list($year,$month,$day)=explode("-", $birthdaydate);
        if($nickname==null)
            $nickname=$firstname;
        if($gender==True)
            $g='female';
        else
            $g='male';
              
        }
         $sql1 = "SELECT phone_no,type from phones where user_id=$friendid ;";
        $result1 = $connection->query($sql1);
        if($result1->num_rows>0)
        {
                while($row1 = $result1->fetch_assoc())
                {array_push($phone, $row1['phone_no']);
                array_push($type, $row1['type']);}
        }
if(isset($_POST['addr']))
{
    $sql2="Insert into friend (`userid`,`friendid`,`approved`)Values('$friendid','$userid',True);";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship saved ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
     $sql3="UPDATE  friend set `approved`=True where userid='$userid' and friendid='$fid';";
    if($connection->query($sql3) === TRUE)
        {
          echo "friendship saved ";
        }
        else{echo "Error:".$sql3."<br>".$connection->connect_error;}
      }
else if(isset($_POST['rmvr']))
{
    $sql2="DELETE FROM friend where userid='$userid' and friendid='$friendid';";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship removed ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
      }
if(isset($_POST['add']))
{
    $sql2="Insert into friend (`userid`,`friendid`,`approved`)Values('$friendid','$userid',False);";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship saved ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
      }

 if(isset($_POST['rmv']))
{
    $sql2="DELETE FROM friend where userid='$friendid' and friendid='$userid';";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship removed ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}


        $sql2="DELETE FROM friend where userid='$userid' and friendid='$friendid';";
     if($connection->query($sql2) === TRUE)
        {
          echo "friendship removed ";
        }
        else{echo "Error:".$sql2."<br>".$connection->connect_error;}
      } 

 if(isset($_POST['rmvrequest']))
{
    $sql2="DELETE FROM friend where userid='$friendid' and friendid='$userid';";
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
    <title>Profile</title>
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
    <div id="heading" align="center">
        <h1><?php// echo $_SESSION['nickname'];?></h1>
        
    </div>
    <div class="container">
        <ul class="nav nav-tabs nav-justified">
            

           <li><a data-toggle="tab" href="#profile1">Profile</a></li>

           <li><a data-toggle="tab" href="#about1">About</a></li>
           

        </ul>
 <div class="tab-content">
        <div id="profile1"  class="tab-pane fade in active">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-5">

                                    <div id="img_head" class="thumbnail">
                                        <img src="pictures/<?php echo $userpic;?>" class="img-thumbnail img-responsive" alt="zhisong ge's head photo" width="200" height="400">
                                    </div>

                                    <div>
                                        <h3>Profile</h3>
                                    </div>

                                 


                                </div>
                                <div class="col-sm-7">
                                    
                                    <div id="name">
                                        <h3><?php echo $firstname.' '.$lastname;?></h3>
                                    </div>
                                
                                </div> 
                            </div> 

                            <div> <?php 
                            $flag=false; 
                            if($friendid != $userid)
    {
        
        $sqlposts="SELECT statpost, postedtime , ispublic ,img FROM post where user_id='$friendid' ORDER BY postedtime DESC";
                                    $done = $connection->query($sqlposts);
                                    if($done->num_rows>0)
                                    {
                                        while($row12 = $done->fetch_assoc())
                                        {
                                            $img2=$row12["img"];
                                            $statpost=$row12["statpost"];
                                            $time=$row12["postedtime"];
                                            $sqlemoji="SELECT * FROM emojis;";
            $emojisresults=$connection->query($sqlemoji);
            while($row2=$emojisresults->fetch_assoc())
            {
              $chars=$row2["chars"];
              $img="<img src='emojis/".$row2["image"]."'/>";
              $statpost=str_replace($chars, $img, $statpost);
            }


            if($row12["ispublic"]=='t')
            {
               $flag=true;
            }
            else if($row12["ispublic"]=='f'){
              $sqla="SELECT approved from friend where userid='$friendid' and friendid='$userid';";
              $result12=$connection->query($sqla);
              if($result12->num_rows>0)
              {$row13=$result12->fetch_assoc();
              $approved=$row13['approved'];
              if($approved==true)
              {
                $flag=true;
              }
              else
                $flag=false;
          }
          else
            $flag=false;
            }
  if($flag==TRUE)
                                    { 
                                    echo "<br>  ". $statpost. "<br> " ;
        if($img2!=null || $img2!=""){
         ?>
         <img class="img-thumbnail img-responsive" alt='zhisong ge's head photo' 

width="200" height="200" src="pictures/<?php echo $img2;?>" >
         <?php
     }
     echo "<br>".$time. " <br><hr>";
                                    }

         
                                        }

                                    }
                                    
                                }
                                else if($friendid==$userid)
                                {
                                  $sqlposts="SELECT statpost, postedtime , ispublic ,img FROM post where user_id='$friendid' ORDER BY postedtime DESC";
                                    $done = $connection->query($sqlposts);
                                    if($done->num_rows>0)
                                    {
                                        while($row12 = $done->fetch_assoc())
                                        {
                                            $img2=$row12["img"];
                                            $statpost=$row12["statpost"];
                                            $time=$row12["postedtime"];
                                            $sqlemoji="SELECT * FROM emojis;";
            $emojisresults=$connection->query($sqlemoji);
            while($row2=$emojisresults->fetch_assoc())
            {
              $chars=$row2["chars"];
              $img="<img src='emojis/".$row2["image"]."'/>";
              $statpost=str_replace($chars, $img, $statpost);
            }


            if($row12["ispublic"]=='t')
            {
               echo "<br>  ". $statpost. "<br> " ;
        if($img2!=null || $img2!=""){
         ?>
         <img class="img-thumbnail img-responsive" alt='zhisong ge's head photo' 

width="200" height="200" src="pictures/<?php echo $img2;?>" >
         <?php
     }
     echo "<br>".$time. " <br><hr>";
            }
          }}}

                                    ?></div>

                        </div> 
                        <div class="col-sm-4">

                     <div id="contact-info" class="list-group">
                                <div class="row list-group-item">
                                    <div class="col-sm-3">
                                       <i class="fa fa-user fa-3x"></i>
                                    </div>
    <form method="POST">
    <?php
    if($friendid != $userid)
    {$sql3="SELECT approved from friend where userid='$friendid' and friendid='$userid';";
    
    $result3=$connection->query($sql3);
    if($result3->num_rows>0)
    {

        $row3=$result3->fetch_assoc();

        $approved=$row3['approved'];
        if($approved==TRUE)
        {    
    ?>

                                    <div class="col-sm-9">
                                       <input type="submit" name="rmv" class="btn btn-info" value="remove friend">
                                    </div>
    <?php
      }
      else
      {
    ?>
                                    <div class="col-sm-9">
                                        <input type="submit" name="rmvrequest" class="btn btn-info" value="remove friend request">
                                    </div>
    <?php
      }}     

      else{
        $sql4="SELECT approved from friend where userid='$userid' and friendid='$friendid';";
    
    $result4=$connection->query($sql4);
    if($result4->num_rows>0)
    {

        
    ?>
                                    <div class="col-sm-9">
                                        <input type="submit" name="rmvr" class="btn btn-info" value="remove friend request" >
  
                                    </div>
                                     <div class="col-sm-9">
                                          <input type="submit" name="addr" class="btn btn-info" value="accept friend request">
                                    </div>
<?php
}
else
{
?>
                                    <div class="col-sm-9">
                                       <input type="submit" name="add" class="btn btn-info" value="add">
                                    </div>
<?php
      }}}
?>
</form>

                                </div>

                                
                                   
                    


                                </div>
                            </div> 
                    </div>
                </div>  
            </div> 

        <div id="about1" class="tab-pane fade">
                 <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="col-sm-5">
                           
                                  <div id="img_head" class="thumbnail">
                                        
                                        <img src="pictures/<?php echo $userpic;?>" class="img-thumbnail img-responsive" alt="zhisong ge's head photo" width="200" height="400">
                                    </div>

                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-transgender fa-3x "></i>
                                    </div>
                                    
                                    <div class="col-sm-9">
                                        
                                         <?php echo $g?>
                                    </div>
                            </div>

                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                       <i class="fa fa-phone fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                         <?php for($i = 0; $i < count($phone); $i++ ){echo $phone[$i].' '; echo $type[$i]."<br>";}?>
                                    </div>
                            </div>



                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-heartbeat fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                       <?php echo $status?>
                                    </div>
                            </div>

                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-map-marker fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                        <?php echo $hometown?>
                                    </div>
                            </div>
                            <?php
                            $private=false;
                            $sql4="SELECT approved from friend where userid='$friendid' and friendid='$userid';";
    
    $result4=$connection->query($sql4);
    if($result4->num_rows>0){
        $row4=$result4->fetch_assoc();

   
         $approved=$row4['approved'];
        if($approved==TRUE)
        {    $private=False;
            echo $private;
        }
    else
        {$private=true;
        echo $private;}


    }
    else{$private=true;
    if($friendid==$userid)
$private=false;}

                            ?>
<?php if($private==false){?>

                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                     <i class="fa fa-calendar-o fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                       <?php echo $birthdaydate?>
                                    </div>
                            </div>

                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-exclamation fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                       <?php echo $aboutme?>
                                   </div>
                            </div>
                            <?php }?>
                                    
                        </div> 
                        <div class="col-sm-7">
                                    
                                    <div id="name">
                                        <h2><?php echo $firstname.' '.$lastname;?></h2>
                                    </div>
                                
                                </div>
                    </div>
                </div>  
            </div>  
                         
                          
    
       </div>    

    </div>    
</body>
<!-- main js -->
<script type="text/javascript" src="main.js"></script>

</html>