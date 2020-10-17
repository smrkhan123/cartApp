<?php
include('../admin/config.php');
$action = $_POST['action'];

if($action == 'product'){
  $html1 ='';
	$id = $_POST['id'];
	$select = "SELECT * FROM products WHERE id = '".$id."'";
	$run = mysqli_query($conn, $select);
	if(mysqli_num_rows($run)>0){
		$data = mysqli_fetch_assoc($run);
		$image = $data['image'];
		$name = $data['name'];
		$price = $data['price'];
    $long_description = $data['long_description'];
    $short_description = $data['short_description'];


		$category_id = $data['category_id'];
    $categ='';
    $cat = "SELECT * FROM categories WHERE category_id ='".$category_id."'";
    $cat_run = mysqli_query($conn, $cat);
    $rows = mysqli_num_rows($cat_run);
    if($rows>0){
        $category = mysqli_fetch_assoc($cat_run);
        $categ = $category['name'];
    }

		$html1 .= '
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="../admin/resources/uploads/'.$image.'">
                                          <img class="simpleLens-big-image" src="../admin/resources/uploads/'.$image.'">
                                      </a>
                                  </div>
                              </div>
                              <!--<div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-1.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-1.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-3.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-3.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="img/view-slider/large/polo-shirt-4.png"
                                     data-big-image="img/view-slider/medium/polo-shirt-4.png">
                                      <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>-->
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>'.ucfirst($name).'</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$'.$price.'</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>'.$short_description.'</p>
                            <!--<h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>-->
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#"><strong>'.ucfirst($categ).'</strong></a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <button class="aa-add-to-cart-btn" onclick="addCart('.$id.')"><span class="fa fa-shopping-cart"></span>Add To Cart</button>
                              <a href="product-detail.php?id='.$id.'" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->

';
	}
  echo $html1;
}
elseif($action == 'category'){
  $id = $_POST['id'];
  $html2 ='';
  $select = "SELECT * FROM products WHERE category_id = '".$id."'";
  $run = mysqli_query($conn, $select);
  if(mysqli_num_rows($run)>0){
    while($data = mysqli_fetch_assoc($run)){
      $id = $data['id'];
      $image = $data['image'];
      $name = $data['name'];
      $price = $data['price'];
      $long_description = $data['long_description'];
      $short_description = $data['short_description'];


      $category_id = $data['category_id'];
      $categ='';
      $cat = "SELECT * FROM categories WHERE category_id ='".$category_id."'";
      $cat_run = mysqli_query($conn, $cat);
      $rows = mysqli_num_rows($cat_run);
      if($rows>0){
          $category = mysqli_fetch_assoc($cat_run);
          $categ = $category['name'];
      }

      $html2 .= '
                  <li>
                    <figure>
                      <a class="aa-product-img" href="product-detail.php?id='.$id.'"><img src="../admin/resources/uploads/'.$image.'" alt="" width="265" height="300"></a>
                      <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                        <h4 class="aa-product-title"><a href="#">'.$name.'</a></h4>
                        <span class="aa-product-price">$'.$price.'.00</span>
                        <p class="aa-product-descrip">'.$short_description.'</p>
                      </figcaption>
                    </figure>                         
                    <div class="aa-product-hvr-content">
                      <!-- <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a> -->
                      <a href="#" onclick="view('.$id.')" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search"></span></a>                            
                    </div>
                    <!-- product badge -->
                    <!-- <span class="aa-badge aa-sale" href="#">SALE!</span> -->
                  </li>';
    }
  }
  echo $html2;
}

elseif($action == 'tag'){
  $id = $_POST['id'];
  $html3 ='';
  $select = "SELECT * FROM products_tags WHERE tag_id = '".$id."'";
  $run = mysqli_query($conn, $select);
  if(mysqli_num_rows($run)>0){
    while($data = mysqli_fetch_assoc($run)){
      $prodid = $data['product_id'];

      $selectProduct = "SELECT * FROM products WHERE id = '".$prodid."'";
      $query = mysqli_query($conn, $selectProduct);
      if(mysqli_num_rows($query)>0){
        $prod = mysqli_fetch_assoc($query);
        $id = $prod['id'];
        $image = $prod['image'];
        $name = $prod['name'];
        $price = $prod['price'];
        $long_description = $prod['long_description'];
        $short_description = $prod['short_description'];


        $category_id = $prod['category_id'];
        $categ='';
        $cat = "SELECT * FROM categories WHERE category_id ='".$category_id."'";
        $cat_run = mysqli_query($conn, $cat);
        $rows = mysqli_num_rows($cat_run);
        if($rows>0){
            $category = mysqli_fetch_assoc($cat_run);
            $categ = $category['name'];
        }

        $html3 .= '
                    <li>
                      <figure>
                        <a class="aa-product-img" href="product-detail.php?id='.$id.'"><img src="../admin/resources/uploads/'.$image.'" alt="" width="265" height="300"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                          <h4 class="aa-product-title"><a href="#">'.$name.'</a></h4>
                          <span class="aa-product-price">$'.$price.'.00</span>
                          <p class="aa-product-descrip">'.$short_description.'</p>
                        </figcaption>
                      </figure>                         
                      <div class="aa-product-hvr-content">
                        <!-- <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a> -->
                        <a href="#" onclick="view('.$id.')" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search"></span></a>                            
                      </div>
                      <!-- product badge -->
                      <!-- <span class="aa-badge aa-sale" href="#">SALE!</span> -->
                    </li>';
      }
    }
  }
  echo $html3;
}


elseif($action == 'price'){
  $html = '';
  $lprice = $_POST['lprice'];
  $uprice = $_POST['uprice'];
  $select = "SELECT * FROM products WHERE price BETWEEN $lprice AND $uprice";
  $qry = mysqli_query($conn, $select);
  if(mysqli_num_rows($qry)>0){
    while($data = mysqli_fetch_assoc($qry)){
      $id = $data['id'];
      $image = $data['image'];
      $name = $data['name'];
      $price = $data['price'];
      $long_description = $data['long_description'];
      $short_description = $data['short_description'];


      $category_id = $data['category_id'];
      $categ='';
      $cat = "SELECT * FROM categories WHERE category_id ='".$category_id."'";
      $cat_run = mysqli_query($conn, $cat);
      $rows = mysqli_num_rows($cat_run);
      if($rows>0){
          $category = mysqli_fetch_assoc($cat_run);
          $categ = $category['name'];
      }

      $html .= '
                  <li>
                    <figure>
                      <a class="aa-product-img" href="product-detail.php?id='.$id.'"><img src="../admin/resources/uploads/'.$image.'" alt="" width="265" height="300"></a>
                      <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                      <figcaption>
                        <h4 class="aa-product-title"><a href="#">'.$name.'</a></h4>
                        <span class="aa-product-price">$'.$price.'.00</span>
                        <p class="aa-product-descrip">'.$short_description.'</p>
                      </figcaption>
                    </figure>                         
                    <div class="aa-product-hvr-content">
                      <!-- <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a> -->
                      <a href="#" onclick="view('.$id.')" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search"></span></a>                            
                    </div>
                    <!-- product badge -->
                    <!-- <span class="aa-badge aa-sale" href="#">SALE!</span> -->
                  </li>';
    }
  }
  echo $html;
}


elseif($action == 'color'){
  $html5 ='';
  $id = $_POST['id'];
  $qry = "SELECT * FROM allcolors WHERE id = '".$id."'";
  $run = mysqli_query($conn, $qry);
  if(mysqli_num_rows($run)){
    $data = mysqli_fetch_assoc($run);
    $color = "SELECT * FROM colors WHERE color = '".$data['color']."'";
    $runn = mysqli_query($conn, $color);
    if(mysqli_num_rows($runn)){
      while($data = mysqli_fetch_assoc($runn)){
        $finalProd = "SELECT * FROM products WHERE id = '".$data['product_id']."'";
        $finalQuery = mysqli_query($conn, $finalProd);
        if(mysqli_num_rows($finalQuery)>0){
          $prod = mysqli_fetch_assoc($finalQuery);
          $id = $prod['id'];
          $image = $prod['image'];
          $name = $prod['name'];
          $price = $prod['price'];
          $long_description = $prod['long_description'];
          $short_description = $prod['short_description'];


          $category_id = $prod['category_id'];
          $categ='';
          $cat = "SELECT * FROM categories WHERE category_id ='".$category_id."'";
          $cat_run = mysqli_query($conn, $cat);
          $rows = mysqli_num_rows($cat_run);
          if($rows>0){
              $category = mysqli_fetch_assoc($cat_run);
              $categ = $category['name'];
          }
          $html5 .= '
                    <li>
                      <figure>
                        <a class="aa-product-img" href="product-detail.php?id='.$id.'"><img src="../admin/resources/uploads/'.$image.'" alt="" width="265" height="300"></a>
                        <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                          <h4 class="aa-product-title"><a href="#">'.$name.'</a></h4>
                          <span class="aa-product-price">$'.$price.'.00</span>
                          <p class="aa-product-descrip">'.$short_description.'</p>
                        </figcaption>
                      </figure>                         
                      <div class="aa-product-hvr-content">
                        <!-- <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a> -->
                        <a href="#" onclick="view('.$id.')" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal" ><span class="fa fa-search"></span></a>                            
                      </div>
                      <!-- product badge -->
                      <!-- <span class="aa-badge aa-sale" href="#">SALE!</span> -->
                    </li>';
        }
      }
    } 
  }
  echo $html5;
}

elseif($action == 'addtoCart'){
  $allrows;
  $id = $_POST['id'];
  $select = "SELECT * FROM products WHERE id = '".$id."'";
  $run = mysqli_query($conn, $select);
  if(mysqli_num_rows($run)>0){
    $data = mysqli_fetch_assoc($run);
    $pname = $data['name'];
    $pprice = $data['price'];
    $pimage = $data['image'];

    $check = "SELECT * FROM cart";
    $runCheck = mysqli_query($conn, $check);

    if(mysqli_num_rows($runCheck)>0){
      $a = 0;
      while($cartRow = mysqli_fetch_assoc($runCheck)){
        if($cartRow['product_id'] == $id){
          $pid = $cartRow['product_id'];
          $name = $cartRow['name'];
          $price = $cartRow['price'];
          $image = $cartRow['image'];
          $quantity = $cartRow['quantity']+1;
          $insertItem = "UPDATE cart SET `product_id` = '".$pid."', `name` = '".$name."', `price` = '".$price."', `image` = '".$image."', `quantity` = '".$quantity."' WHERE product_id = '".$pid."'";
            $qry = mysqli_query($conn, $insertItem);
            if($qry == true){
              $cart = "SELECT * FROM cart";
              $cart_query = mysqli_query($conn, $cart);
              $allrows = mysqli_num_rows($cart_query);
              $a++;
            }
        }
      }
      if($a == 0){
        $insertItem = "INSERT INTO cart(`product_id`,`name`,`price`,`image`,`quantity`) VALUES('".$id."', '".$pname."', '".$pprice."', '".$pimage."', 1) ";
            $qry = mysqli_query($conn, $insertItem);
            if($qry == true){
              $cart = "SELECT * FROM cart";
              $cart_query = mysqli_query($conn, $cart);
              $allrows = mysqli_num_rows($cart_query);
            }
      }
    }
    elseif(mysqli_num_rows($runCheck)==0){
      $insertItem = "INSERT INTO cart(`product_id`, `name`, `price`, `image`, `quantity`) VALUES('".$id."', '".$pname."', '".$pprice."', '".$pimage."', 1)";
            $qry = mysqli_query($conn, $insertItem);
            if($qry == true){
              $cart = "SELECT * FROM cart";
              $cart_query = mysqli_query($conn, $cart);
              $allrows = mysqli_num_rows($cart_query);

            }
            else{
              echo "Some error occured! ".mysqli_error($conn);
            }
    } 
  }
  // $cart = array();
  // $finalQuery = "SELECT * FROM cart";
  // $run = mysqli_query($conn, $finalQuery);
  // if(mysqli_num_rows($run)>0){
  //   $i = 0;
  //   while($data = mysqli_fetch_assoc($run)){
  //     $cart[i] = $data;
  //     $i++;
  //   }
  // }
  echo $allrows;
}
?>
                                     