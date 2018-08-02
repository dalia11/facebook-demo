<?php
session_start();
include('conn.php');


$userid=$_SESSION['ID'];
$phone=array();
$type = array();



$sql = "SELECT * from users where user_id=$userid ;";

        $result = $connection->query($sql);
    
        if($result->num_rows > 0)
        {
                $row = $result->fetch_assoc();
                $firstname=$row["First_name"];
                $lastname=$row["Last_name"];
                $nickname=$row["Nickname"];
                $email=$row["Email"];
                $pass=$row["Password"];
                $gen=$row["Gender"];
                $birthdaydate=$row["Birthday_Date"];
                $aboutme=$row["aboutme"];
                $hometown=$row["hometown"];
                $status=$row["marital_status"];
                $userpic=$row["userPic"];
                $about=$row["aboutme"];
              
        }
        if($gen==True)
            $g='female';
        else
            $g='male';
        $sql1 = "SELECT phone_no,type from phones where user_id=$userid ;";
        $result1 = $connection->query($sql1);
        if($result1->num_rows>0)
        {
                while($row1 = $result1->fetch_assoc())
                {array_push($phone, $row1['phone_no']);
                array_push($type, $row1['type']);}
        }
        //list($year,$month,$day)=explode("-", $birthdaydate);
        if($nickname==null || $nickname=="")
        {
            $nickname=$firstname;
           
        }
         $_SESSION['nickname']=$nickname;

         
 $sql2="SELECT COUNT(*) as total FROM `friend` WHERE userid=$userid AND `approved`='0'";
    $result1 = $connection->query($sql2);
    $row1 = $result1->fetch_assoc();
    $number=$row1['total'];
     $_SESSION['counts']=$number; 





         ?>