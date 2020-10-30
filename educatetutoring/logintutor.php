<?php include "includes/header.php"; ?>
   
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-yellow">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Tutors Portal</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="includes/logintutor.php" method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span>
                                        <i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input class="form-control" placeholder="Username" name="username" type="text" autofocus
                                       autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span>
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                            </div>    
                        </div>
<!--
                        <div class="checkbox">
                            <label><input name="remember" type="checkbox" value="Remember Me">Remember Me</label>
                        </div>
-->
                        <button class="btn btn-lg btn-success btn-block" name="login" type="submit">Sign In</button>
                    </form>
                </div>
                <div class="panel-footer">
                    <p class="text-right"><a href="welcome.php">Change Portal</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php include "includes/footer.php"; ?>