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

<form id="searchbox" class="form-horizontal" role="form" method="POST" action="">
    <input id="srchin" name="srchin" type="text" placeholder="Search..">
    <input id="srch" name="srch" type="submit" value="Search" class="btn btn-info">
</form>
<?php

$flag=0;
if(isset($_POST['srch'])&&isset($_POST['srchin']))
    {

       $searched=explode(" ",$_POST['srchin']);
       

       for($i=0;$i<count($searched);$i++)
       {

         $value="%".$searched[$i];
         $value=$value."%";
         $sql="SELECT distinct  u.user_id as id from `users` as u LEFT JOIN `post` as p on p.user_id=u.user_id WHERE u.First_name LIKE '$value' OR u.Last_name LIKE '$value' OR u.Hometown LIKE '$value' OR u.Email LIKE '$value' OR p.statpost LIKE '$value'";
         if($result=mysqli_query($connection,$sql))
            {
                $rowcount=mysqli_num_rows($result);

            }
         
         if($rowcount>0 )
         {
             $flag=1;
         }
        
         else
         {
            echo "no result found";

         }

       }
    }

$k=0;
if($flag==1){ 
    while($row = $result->fetch_assoc()) 
        {$id=$row["id"];
         
          $sql1="SELECT First_name,Last_name,userPic from `users` WHERE user_id='$id'";
        $res=mysqli_query($connection,$sql1);
        $resu = $res->fetch_assoc();
        $fname=$resu["First_name"];
        $img=$resu["userPic"]; 
        $lname=$resu["Last_name"];

         ?>
<div class="row">
 <div class="col-sm-4">

            <div id="img_head" class="thumbnail">
                <img  width="50" height="50" src="pictures/<?php echo $img;?>" >
            </div>
</div>
        <div class="col-sm-4">
 
            <a class="btn btn-info" href="friendpage.php?view_id=<?php echo $id; ?>" title="click for edit" ><span class="glyphicon glyphicon-edit"></span><?php echo $fname." ".$lname;?> </a> 
            
        </div>
</div>
        
        <?php }}
        //header('location:profi.php?search'); 

        ?>

</body>
</html>
