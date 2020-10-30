<?php ob_start(); ?>
<?php include "includes/header.php"; ?>
<?php include "admin/includes/connection.php"; ?>
<?php include "admin/includes/functions.php"; ?>
    
    
<?php 
    if (isset($_POST['submit'])){
        $username      = trim($_POST['username']);
        $user_password = trim($_POST['password']);
        $user_email    = trim($_POST['email']);
        
        //validation
        $error = [
            'username'=> '',
            'password'=> '',
            'email'   => ''
        ];
        
        if(strlen($username) < 4){
            $error['username'] = 'Username needs to be longer';
        }
        if($username == ''){
            $error['username'] = 'Username can not be empty';
        }
        if(username_exists($username)){
            $error['username'] = 'Username already exists, please pick another username';
        }
        if($user_password == ''){
            $error['password'] = 'Password can not be empty';
        }
        if($user_email == ''){
            $error['email'] = 'Email can not be empty';
        }
        if(user_email_exists($user_email)){
            $error['email'] = 'Email already exists, please pick another email';
        }
        
        foreach ($error as $key => $value){
            if(empty($value)){
                unset($error[$key]);    
            }
        }
        
        if(empty($error)){
            register_user($username, $user_password, $user_email);
            echo "<h4 class='text-center'>Registration successful. <a href='welcome.php'>Please use the right portal to sign in.</a></h4>";
        }
    }
?>
   
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Please sign up</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username *" 
                                       autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                                <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p> <!-- validation -->
                            </div>
                             <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email *"
                                       autocomplete="on" value="<?php echo isset($user_email) ? $user_email : '' ?>"> 
                                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p> <!-- validation -->
                            </div>
                             <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password *">  
                                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p> <!-- validation -->
                            </div>
                            <input class="btn btn-lg btn-success btn-block" name="submit" type="submit" id="btn-login" value="Register">
                    </form>
                </div>
                <div class="panel-footer">
                    <p class="text-right"><a href="welcome.php">Sign In</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php include "includes/footer.php"; ?>