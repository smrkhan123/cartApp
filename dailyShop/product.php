<?php 
  include('header.php');
  include('../admin/config.php');
  $single_page_results = 9;
  $sql='SELECT * FROM products';
  $result = mysqli_query($conn, $sql);
  $number_of_results = mysqli_num_rows($result);
  $number_of_pages = ceil($number_of_results/$single_page_results);
  if (!isset($_GET['page'])) {
    $page = 1;
  } else {
    $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$single_page_results;
  ?> 
 
  <!-- catg header banner section -->
  <!-- <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Fashion</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Women</li>
        </ol>
      </div>
     </div>
   </div>
  </section> -->
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Show</label>
                  <select name="">
                    <option value="1" selected="12">12</option>
                    <option value="2">24</option>
                    <option value="3">36</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>
            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                <!-- start single product item -->
                <?php 
                    $select = 'SELECT * FROM products LIMIT ' . $this_page_first_result . ',' .  $single_page_results;
                    $run = mysqli_query($conn, $select);
                    if(mysqli_num_rows($run)>0){
                      while($data = mysqli_fetch_assoc($run)){ ?>
                        <li>
                          <figure>
                            <a class="aa-product-img" href="product-detail.php?id=<?php echo $data['id']; ?>"><img src="../admin/resources/uploads/<?php echo $data['image']; ?>" alt="" width="265" height="300"></a>
                            <a class="aa-add-card-btn"href="#" onclick="addCart(<?php echo $data['id']; ?>)"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                              <h4 class="aa-product-title"><a href="#"><?php echo $data['name']; ?></a></h4>
                              <span class="aa-product-price">$<?php echo $data['price']; ?>.00</span>
                              <p class="aa-product-descrip"><?php echo $data['long_description']; ?></p>
                            </figcaption>
                          </figure>                         
                          <div class="aa-product-hvr-content">
                            <!-- <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a> -->
                            <a href="#" onclick="view(<?php echo $data['id']; ?>)" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search"></span></a>                            
                          </div>
                          <!-- product badge -->
                          <!-- <span class="aa-badge aa-sale" href="#">SALE!</span> -->
                        </li>
                <?php }
                    }
                ?>                                         
              </ul>
              <script>
                function addCart(id){
                  
                  $.ajax({
                    url : 'ajax.php',
                    method: 'POST',
                    data : {id: id, action: 'addtoCart'},
                    dataType : "json"
                  }).done(function(msg){
                    $(".aa-cart-notify").html(msg); 
                  });
                }
              </script>
              <!-- quick view modal --> 
              <script>
                function view(id){
                  console.log(id);
                    $.ajax({
                      method: "POST",
                      url: "ajax.php",
                      data: {id : id, action : "product"}
                    }).done(function(msg){
                        $("#quick-view-modal").html(msg);
                    });
                }
              </script>                 
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              </div>
              <!-- / quick view modal -->   
            </div>
            <div class="aa-product-catg-pagination">
              <nav>
                <ul class="pagination">
                  <li>
                    <?php if($page > 1 ): ?>
                      <a href="product.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    <?php endif; ?>
                  </li>
                  <?php
                    for ($page=1;$page<=$number_of_pages;$page++) {
                      echo '<li><a href="product.php?page=' . $page . '">' . $page . '</a><li> ';
                    }
                  ?>
                  <li>
                    <?php if(!isset($_GET['page'])) { ?>
                            <a href="product.php?page=<?php echo 2; ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                            </a>
                        <?php

                      }elseif($_GET['page'] < $number_of_pages){
                        ?>
                            <a href="product.php?page=<?php echo $_GET['page']+1; ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                            </a>
                        <?php
                      } ?>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>
              <ul class="aa-catg-nav">
                <?php 
                  $cat = "SELECT * FROM categories";
                  $run = mysqli_query($conn, $cat);
                  if(mysqli_num_rows($run)){
                    while($data = mysqli_fetch_assoc($run)){
                      ?>
                        <li>
                          <a href="#" onclick="category(<?php echo ($data['category_id']); ?>)">
                            <?php echo ucfirst($data['name']); ?>
                          </a>
                        </li>
                      <?php
                    }
                  }
                ?>
              </ul>
              <script>
                function category(id){
                  $.ajax({
                    url : "ajax.php",
                    method : "POST",
                    data : {id: id, action: 'category'}
                  }).done(function(msg){
                    $(".aa-product-catg-pagination").hide();
                    $(".aa-product-catg").html(msg);
                  });
                }
              </script>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
                <?php 
                  $tags = "SELECT * FROM tags";
                  $run = mysqli_query($conn, $tags);
                  if(mysqli_num_rows($run)){
                    while($data = mysqli_fetch_assoc($run)){
                      ?>
                        <a href="#" onclick="tag(<?php echo $data['id']; ?>)">
                          <?php echo ucfirst($data['name']); ?>
                        </a>
                      <?php
                    }
                  }
                ?>
              </div>
              <script>
                function tag(id){
                  $.ajax({
                    url : "ajax.php",
                    method : "POST",
                    data : {id: id, action: 'tag'}
                  }).done(function(msg){
                    $(".aa-product-catg-pagination").hide();
                    $(".aa-product-catg").html(msg);
                  });
                }
              </script>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               <!-- <form> -->
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">5000.00</span>
                 <button class="aa-filter-btn" onclick="price();">Filter</button>
               <!--   -->
              </div>              
              <script>
                function price(){
                  var lprice = $("#skip-value-lower").html();
                  var uprice = $("#skip-value-upper").html();
                  $.ajax({
                    url : "ajax.php",
                    method : "POST",
                    data : {lprice: lprice, uprice: uprice, action: 'price'}
                  }).done(function(msg){
                    $(".aa-product-catg-pagination").hide();
                    $(".aa-product-catg").html(msg);
                  });
                }
              </script>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">
                <?php 
                  $colors = "SELECT * FROM allcolors";
                  $run = mysqli_query($conn, $colors);
                  if(mysqli_num_rows($run)){
                    while($data = mysqli_fetch_assoc($run)){
                      ?>
                      <a class="aa-color-<?php echo lcfirst($data['color']); ?>" href="#" onclick="clr(<?php echo $data['id']; ?>)" data-id="<?php echo $data['id']; ?>">
                        
                      </a>
                      <?php
                    }
                  }
                ?>
              </div>
              <script>
                function clr(id){
                  $.ajax({
                    url : "ajax.php",
                    method : "POST",
                    data : {id: id, action: 'color'}
                  }).done(function(msg){
                    $(".aa-product-catg-pagination").hide();
                    $(".aa-product-catg").html(msg);
                  });
                }
              </script>                            
            </div>
            <!-- single sidebar -->
<!--             <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div> -->
            <!-- single sidebar -->
<!--             <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div> -->
          </aside>
        </div>
       
      </div>
    </div>
  </section>
  <!-- / product category -->


<?php include('footer.php'); ?>