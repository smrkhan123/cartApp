<?php 
include('config.php');
$error = '';
session_start();
if (isset($_SESSION['id'])) {
    header("location:index.php");
} else {
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $qry = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password'";
        $run = mysqli_query($conn, $qry);
        $row = mysqli_num_rows($run);
        if ($row<1) {
            $error = 'Please enter a valid Username or Password';
        } else {
            $data = mysqli_fetch_assoc($run);
            $id = $data['id'];
            $username = $data['username'];
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            header("location:index.php");
        }
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simpla Admin | Sign In</title>
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
                
                <form action="" method="POST">
                
                    <div>
                        <?php if($error) :?>
                        <p style='background-color: red; color: white; padding:5px; margin-bottom:10px;'>
                        <?php echo $error; ?></p>
                        <?php endif; ?>
                    </div>
                    
                    <p>
                        <label>Username</label>
                        <input class="text-input" type="text" name="username" />
                    </p>
                    <div class="clear"></div>
                    <p>
                        <label>Password</label>
                        <input class="text-input" type="password" name="password" />
                    </p>
                    <div class="clear"></div>
                    <p id="remember-password">
                        <input type="checkbox" />Remember me
                    </p>
                    <div class="clear"></div>
                    <p style="color:white" id="remember-password">
                        Do not have account? <a href="register.php">Register Here</a>
                    </p>
                    <div class="clear"></div>
                    <p>
                        <input class="button" type="submit" name="submit" value="Sign In" />
                    </p>
                    
                </form>
            </div> <!-- End #login-content -->
            
        </div> <!-- End #login-wrapper -->
  </body>
</html>
