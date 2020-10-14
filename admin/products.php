<?php  
include('config.php');
session_start();
if (!isset($_SESSION['id'])) {
    header("location:login.php");
} else {
    $username = $_SESSION['username'];  
}

if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pcategory = $_POST['pcategory'];
    $pshort = $_POST['pshort'];
    $plong = $_POST['plong'];
    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];

    move_uploaded_file($tempname, 'resources/uploads/'.$image);

    $query = "INSERT INTO products(`name`,`price`,`image`,`short_description`,`long_description`,`category_id`) VALUES('".$pname."','".$pprice."','".$image."','".$pshort."','".$plong."','".$pcategory."')";
    $run = mysqli_query($conn, $query);
    $pid = mysqli_insert_id($conn);
    if (!$run) {
        echo "Some error occured!".mysqli_error($conn);
    } else {
        if (!empty($_POST['tags'])) {
            $a= implode(",", $_POST['tags']);
            $pid = mysqli_insert_id($conn);
            $tag_query = "INSERT INTO products_tags(`product_id`,`tag_id`) VALUES('".$pid."','".$a."')";
            $runn = mysqli_query($conn, $tag_query);
            if (!$runn) {
                echo "Some error occured!".mysqli_error($conn);
            }
        }
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
                        <li><a href="#tab1" class="default-tab">Manage</a></li> <!-- href must be unique and match the id of target div -->
                        <li><a href="#tab2">Add</a></li>
                    </ul>
                    
                    <div class="clear"></div>
                    
                </div> <!-- End .content-box-header -->
                
                <div class="content-box-content">
                    
                    <div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
                        
                        <!-- <div class="notification attention png_bg">
                            <a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
                            <div>
                                This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
                            </div>
                        </div> -->
                        
                        <table>
                            
                            <thead>
                                <tr>
                                   <th><input class="check-all" type="checkbox" /></th>
                                   <th>Product ID</th>
                                   <th>Name</th>
                                   <th>Price</th>
                                   <th>Category</th>
                                   <th>Image</th>
                                   <th>Short Description</th>
                                   <th>Long Description</th>
                                </tr>
                                
                            </thead>
                         
                            <!--<tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="bulk-actions align-left">
                                            <select name="dropdown">
                                                <option value="option1">Choose an action...</option>
                                                <option value="option2">Edit</option>
                                                <option value="option3">Delete</option>
                                            </select>
                                            <a class="button" href="#">Apply to selected</a>
                                        </div>
                                        
                                        <div class="pagination">
                                            <a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
                                            <a href="#" class="number" title="1">1</a>
                                            <a href="#" class="number" title="2">2</a>
                                            <a href="#" class="number current" title="3">3</a>
                                            <a href="#" class="number" title="4">4</a>
                                            <a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
                                        </div>--> <!-- End .pagination -->
                                        <!--<div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>-->
                         
                            <tbody id="tableBody">
                                <?php 
                                $fetch = "SELECT * FROM products";
                                $run = mysqli_query($conn, $fetch);
                                $rows = mysqli_num_rows($run);
                                if ($rows>0) {
                                    while ($data = mysqli_fetch_assoc($run)) {
                                            
                                        ?>
                                            
                                        <tr>
                                            <td><input type="checkbox" /></td>
                                            <td><?php echo $data['id']; ?></td>
                                            <td><?php echo $data['name']; ?></td>
                                            <td><?php echo $data['price']; ?></td>
                                            <td>
                                                <?php 
                                                $cat = "SELECT name FROM categories WHERE category_id = '".$data['category_id']."'";
                                                $qry= mysqli_query($conn, $cat);
                                                $rows = mysqli_num_rows($qry);
                                                if ($rows>0) {
                                                    $categ = mysqli_fetch_assoc($qry);
                                                    echo ucfirst($categ['name']);
                                                }
                                                ?>
                                            </td>
                                            <td><a href="resources/uploads/<?php echo $data['image']; ?>""><img src="resources/uploads/<?php echo $data['image']; ?>" alt="" width="50" height="50"></a></td>
                                            <td><?php echo $data['short_description']; ?></td>
                                            <td><?php echo substr($data['long_description'], 0, 30)."..."; ?></td>
                                            <td>
                                                <!-- Icons -->
                                                <!-- <a href="#" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
                                                <a href="#"  title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a>  -->
                                            </td>
                                        </tr>
                                        
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                            
                        </table>
                    </div> <!-- End #tab1 -->
                    
                    <div class="tab-content" id="tab2">
                    
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                                 <p>
                                    <label>Product Name</label>
                                        <input class="text-input small-input" type="text" id="small-input" name="pname" required /> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
                                        <br />
                                </p>
                                <p>
                                    <label>Product Price</label>
                                        <input class="text-input small-input" type="text" id="small-input" name="pprice" required /> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
                                        <br />
                                </p>
                                <p>
                                    <label>Product Image</label>
                                        <input class="text-input small-input" type="file" id="small-input" name="image" required /> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
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
                                            while ($data = mysqli_fetch_assoc($run)) {
                                                ?>
                                                <option value="<?php echo $data['category_id']; ?>"><?php echo ucfirst($data['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        
                                        ?>
                                    </select> 
                                </p>

                                <p>
                                    <label>Tags</label>
                                    <?php 
                                    $qry ="SELECT * FROM tags";
                                    $run = mysqli_query($conn, $qry);
                                    $rows = mysqli_num_rows($run);
                                    if ($rows>0) {
                                        while ( $data = mysqli_fetch_assoc($run) ) {
                                            ?>
                                            <input type="checkbox" name="tags[]" value="<?php echo $data['id']; ?>" /><?php echo ucfirst($data['name']); ?>
                                            <?php
                                        }
                                    }
                                    
                                    ?>
                                </p>
                                <p>
                                    <label>Product Short Description</label>
                                        <input class="text-input small-input" type="text" id="small-input" name="pshort" required /> <!--<span class="input-notification success png_bg">Successful message</span>--> <!-- Classes for input-notification: success, error, information, attention -->
                                        <br />
                                </p>
                                <p>
                                    <label>Product Long Description</label>
                                    <textarea class="text-input textarea wysiwyg" id="textarea" name="plong" cols="50" rows="10" required></textarea>
                                </p>
                                
                                <p>
                                    <input class="button" type="submit" name="submit" value="Submit" />
                                </p>
                                
                            </fieldset>
                            
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
            
            <?php include('footer.php'); ?>
