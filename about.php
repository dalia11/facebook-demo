<?php include('tabs.php');?>
        <head>

<style>
    body{ background-image: url(fo1.png) ;
           background-repeat: repeat;
           border:none;
           margin-left: 0px;
        margin-top: 0px;}
    .list-group-item{
         background-image: url(fo1.png);
        
    }
            </style>
</head>
                 <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="col-sm-5">
                            
                           
                                  <div id="img_head" >
                                        
                                        <img src="pictures/<?php echo $userpic;?>" class="img-thumbnail img-responsive" alt="zhisong ge's head photo" width="200" height="400">
                                    </div>
                               <div class="col-sm-2">
                                    
                                    
                                
                                </div>   
                            <a target="_blank" class="btn btn-info" href="editprofile.php">&nbsp;<i class="fa fa-edit" aria-hidden="true"></i>  Edit</a>
                             

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
                                       <?php echo $status;?>
                                    </div>
                            </div>

                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-map-marker fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                        <?php echo $hometown;?>
                                    </div>
                            </div>


                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-calendar-o fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                      <?php echo $birthdaydate; ?>
                                    </div>
                            </div>
                             <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-envelope fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                        <?php echo $email?>
                                   </div>
                            </div>

                            <div class="row list-group-item">
                                    <div class="col-sm-3">
                                        <i class="fa fa-exclamation fa-3x "></i>
                                    </div>
                                    <div class="col-sm-9">
                                   <?php echo $about?>
                                   </div>
                            </div>
                                
                        </div> 
                        <div id="name">
                                        <h2><?php echo $firstname.' '.$lastname?> </h2>
                                    </div>
                    </div>
                </div>  
            