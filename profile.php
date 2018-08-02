<?php
//session_start();
include('tabs.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Profile</title> 
   <style>
       body{
            background-color: lightgrey;
           background-repeat: no-repeat;
           padding: 10px;
       }
      
       .row{
           background-image: url(fo1.png) ;
           background-repeat: repeat;
           border:none;
           margin-left: 0px;
           margin-top: 0px;
       }
     
    
    </style>
</head>

<body>          

                <div class="container-fluid">
                    <div class="row-fluid">                   
                         <div class="col-sm-12">
                             <div class="row">                      
                        <div class="col-sm-4">
                            <div>
                                <h3>Profile   <?php echo $nickname ;?></h3>
                                    </div>  
                                    <div id="img_head" class="thumbnail">
                                        <img src="pictures/<?php echo $userpic;?>" class="img-thumbnail img-responsive" alt="photo" width="200" height="100">
                                    </div>
                            </div>
                                    <div class="col-sm-3">                             
                                    <div id="name">
                                        <h3><?php echo $firstname.' '.$lastname?></h3>
                                    </div>  
                                     <div  class="col-sm-4">

                     <div id="contact-info" class="list-group">
                                <div class="row list-group-item">
                                    <div class="col-sm-4">
                                       <i class="fa fa-users fa-3x"></i>

                                    </div>
                                </div>
                                </div>
                            </div>      
                                </div> 
                                 
                                  </div> 
                              
                               
                                   
                                    <div class="row list-group-item">
                                    <div class="col-sm-5">     
                              
                                     <?php include('post.php');?>
                                    </div>
                                </div>
                                
                            

                        </div> 
                        
                       
                    </div>
                </div>               
</body>
</html>         