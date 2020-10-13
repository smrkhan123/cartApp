<?php 
include('config.php');
session_start();
if (isset($_SESSION['id'])) {
    header("location: index.php");
}
$errors = array();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $user_type = $_POST['user_type'];
    if ($password != $password2) {
        $errors[] = array('input' => 'password', 'msg' => 'Password & Confirm-Password did not matched!');
    }
    elseif($username == '' || $email == '' || $password == '' || $dob == '' || $address == '' || $user_type == '' ){
        $errors[] = array('input' => 'form', 'msg' => 'Please complete the form and then submit');
    } 
    else {
        $sql = "SELECT * FROM users";
        $run = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($run);
        if ($row>0) {
            $a = 0;
            while ($user = mysqli_fetch_assoc($run)) {
                if ($user['username'] == $username) {
                    $errors[] = array('input' => 'username', 'msg' => 'Username already exists');
                    $a = 1;
                } elseif ($user['email'] == $email) {
                    $errors[] = array('input' => 'email', 'msg' => 'Email already exists');
                    $a = 1;
                }
            }
            if ($a==0) {
                $qry = "INSERT INTO users(`username`, `password`, `email`,`dob`,`address`,`user_type`) VALUES ('".$username."','".$password."','".$email."','".$dob."','".$address."','".$user_type."')";
                $run = mysqli_query($conn, $qry);
                if ($run == true) {
                    header("location:login.php");
                } else {
                    die("Some errror Occured". mysqli_error($conn));
                }
            } 
        } else {
            $qry = "INSERT INTO users(`username`, `password`, `email`,`dob`,`address`,`user_type`) VALUES ('".$username."','".$password."','".$email."','".$dob."','".$address."','".$user_type."')";
            $run = mysqli_query($conn, $qry);
            if ($run == true) {
                header("location:login.php");
            } else {
                die("Some errror Occured". mysqli_error($conn));
            }
        }
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simpla Admin | Register</title>
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
</head>
  
    <body id="login">
        
        <div id="login-wrapper" class="png_bg">
            <div id="login-top">
            
                <h1>Simpla Admin</h1>
                
                <!-- Logo (221px width) -->
                <img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
            </div> <!-- End #logn-top -->
            
            <div id="login-content">
            <h2>Register Here</h2>
                <form action="" method="POST">
                <div id="errors" >
                <?php if (sizeof($errors)>0) : ?>
                    <ul>
                        <?php foreach ($errors as $error):?>
                            <li><?php echo $error['msg']; ?> <a href="#" onclick="hide()">x</a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <script>
                    function hide(){
                        $("#errors").hide();
                    }
                </script>
                    <!-- <div class="notification information png_bg">
                        <div>
                            Just click "Sign In". No password needed.
                        </div>
                    </div> -->
                    
                    <p>
                        <label>Username</label>
                        <input class="text-input" type="text" name='username'/>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Password</label>
                        <input class="text-input" type="password" name='password' />
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Confirm-Password</label>
                        <input class="text-input" type="password" name='password2' />
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Email</label>
                        <input class="text-input" type="email" name='email' />
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>User Type</label>
                        <select name="user_type" class="userType">
                            <option value="">Select</option>
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
                        </select>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>DOB</label>
                        <input class="text-input" type="date" name='dob' />
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Address</label>
                        <textarea name="address" id="" cols="20" rows="7"></textarea>
                    </p>
                    <div class="clear"></div>
                    <p style="color:white" id="remember-password">
                        Already have account? <a href="login.php">Login Here</a>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <input class="button" type="submit" name="submit" value="Register" />
                    </p>
                    
                </form>
            </div> <!-- End #login-content -->
            
        </div> <!-- End #login-wrapper -->
  </body>
</html>
