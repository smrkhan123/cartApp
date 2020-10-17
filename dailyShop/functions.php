<?php
/**
 * Doc comment
 *
 * @package Code
*/

include "../admin/config.php" ;


// adding items in the cart


function addCart($product_id)
{
    global $products;
    global $cart;
    if (empty($cart)) {
        $select = "SELECT * FROM products WHERE id = '".$product_id."'";
        $run = mysqli_query($conn, $select);
        if(mysqli_num_rows($run)>0){
            $data = mysqli_fetch_assoc($run);
            $addItems = $data;
            $addItems['quantity'] = 1;
            array_push($cart, $addItems);
        }
    } else {
        $a = 0;
        foreach ($cart as $key => $value) {
            if ($cart[$key]["id"] == $product_id) {
                $cart[$key]['quantity'] = $cart[$key]['quantity'] + 1;
                $a = 1;
            }
        }
        if ($a == 0) {
            $select = "SELECT * FROM products WHERE id = '".$product_id."'";
            $run = mysqli_query($conn, $select);
            if(mysqli_num_rows($run)>0){
                $data = mysqli_fetch_assoc($run);
                $addItems = $data;
                $addItems['quantity'] = 1;
                array_push($cart, $addItems);
                    //print_r($cart);
            }
        }
    }
    $_SESSION['cart'] = $cart;
    return $_SESSION['cart'];
}


?>
