<?php  
include('config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header("location:login.php");
} else {
    $username = $_SESSION['username'];  
}

$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pcategory = $_POST['pcategory'];
    $pshort = $_POST['pshort'];
    $plong = $_POST['plong'];
    $image = $_FILES['image']['name'];
    if($image == ''){
        $select = "SELECT * FROM products WHERE id = '".$id."'";
            $runn = mysqli_query($conn, $select);
            if(mysqli_num_rows($runn)>0){
                $data = mysqli_fetch_assoc($runn);
                $image = $data['image'];
            }
    }

    
    else{
        $image = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempname, 'resources/uploads/'.$image);
    }


    $query = "UPDATE products SET `name`='".$pname."', `price`='".$pprice."', `category_id`='".$pcategory."', `short_description`='".$pshort."', `long_description`='".$plong."', `image`='".$image."' WHERE id = '".$id."'";
    $run = mysqli_query($conn, $query);
    if (!$run) {
        echo "Some error occured!".mysqli_error($conn);
    } 
    else{
        header("location: products.php");
    }  
}




include('header.php');
include('sidebar.php'); ?>
        
        <div id="main-content"> <!-- Main Content Section with everything -->
            
            <noscript> <!-- Show a notification if the user has disabled javascript -->
                <div class="notification error png_bg">
                    <div>
                        Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
                    </div>
                </div>
            </noscript>
            
            <!-- Page Head -->
            <h2>Hello, <?php echo ucfirst($username); ?>!</h2>
            <p id="page-intro">What would you like to do?</p>
            
            <div class="clear"></div> <!-- End .clear -->
            
            <div class="content-box"><!-- Start Content Box -->
                
                <div class="content-box-header">
                    
                    <h3>Content box</h3>
                    
                    <ul class="content-box-tabs">
                        <li><a href="#tab1" class="default-tab">
                        Edit</a></li> <!-- href must be unique and match the id of target div -->
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content" id="dbContent">

                    <div class="tab-content default-tab" id="tab1">
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php
                                $id = $_GET['id'];
                                $select = "SELECT * FROM products WHERE id = '".$id."'";
                                $run = mysqli_query($conn, $select);
                                if(mysqli_num_rows($run)>0){
                                    $data = mysqli_fetch_assoc($run);
                                    ?>

                                        <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                                             <p>
                                                <label>Product Name</label>
                                                    <input class="text-input small-input" type="text" id="small-input" name="pname" value="<?php echo $data['name']; ?>" required /> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
                                                    <br />
                                            </p>
                                            <p>
                                                <label>Product Price</label>
                                                    <input class="text-input small-input" type="text" id="small-input" name="pprice" value="<?php echo $data['price']; ?>" required /> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
                                                    <br />
                                            </p>
                                            <p>
                                                <label>Product Image</label>
                                                    <input class="text-input small-input" type="file" id="small-input" name="image"/> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
                                                    <img src="resources/uploads/<?php echo $data['image'];?>" width="100" height="100">
                                                    <br />
                                            </p>
                                            <p>
                                                <label>Category</label>              
                                                <select name="pcategory" class="small-input" required>
                                                    <option value="">Select</option>
                                                    <?php 
                                                    $qry ="SELECT * FROM categories";
                                                    $run = mysqli_query($conn, $qry);
                                                    $rows = mysqli_num_rows($run);
                                                    if ($rows>0) {
                                                        while ($cat = mysqli_fetch_assoc($run)) {
                                                            ?>
                                                            <option value="<?php echo $cat['category_id']; ?>" <?php if($data['category_id'] == $cat['category_id']){ echo 'selected="selected"'; }?>><?php echo ucfirst($data['name']); ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    
                                                    ?>
                                                </select> 
                                            </p>
                                            <p>
                                                <label>Product Short Description</label>
                                                    <input class="text-input small-input" type="text" id="small-input" name="pshort" value="<?php echo $data['short_description']; ?>" required /> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
                                                    <br />
                                            </p>
                                            <p>
                                                <label>Product Long Description</label>
                                                <textarea class="text-input textarea wysiwyg" id="textarea" name="plong" cols="50" rows="10" required><?php echo $data['long_description']; ?></textarea>
                                            </p>
                                            
                                            <p>
                                                <input class="button" type="submit" name="submit" value="Submit" />
                                            </p>
                                            
                                        </fieldset>

                                    <?php
                                }
                            ?>
                            
                            
                            <div class="clear"></div><!-- End .clear -->
                            
                        </form>
                        
                    </div> <!-- End #tab2 -->        
                    
                </div> <!-- End .content-box-content -->
                
            </div> <!-- End .content-box -->
            
            <div class="clear"></div>
            
            
            <!-- Start Notifications -->
            
            <!-- <div class="notification attention png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
                </div>
            </div>
            
            <div class="notification information png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification success png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div>
            
            <div class="notification error png_bg">
                <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                <div>
                    Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
                </div>
            </div> -->
            
            <!-- End Notifications -->

            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
            <?php include('footer.php'); ?>


