<?php


    ob_start();

    session_start();
    $nonavebar='';
    $printtittle="Login";

    if(isset($_SESSION['mamber'])){

        header("Location:index.php");
        exit();
    }


    require 'routes.php';

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $user=$_POST['username'];
        $pass=$_POST['passw'];

        $sh1password=sha1($pass);


        $stms=$conn->prepare('SELECT username,password FROM shop.users WHERE username=? AND password=? ');

        $stms->execute(array($user,$sh1password));

        $users=$stms->fetchAll();
        $count=$stms->rowCount();

        if($conn > 0){


            $_SESSION['mamber']=$user;

            header('Location:index.php');
            exit();

        }



    }

     ob_end_flush();

?>


<div class="form">

    <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
    </ul>

    <div class="tab-content">
        <div id="signup">
            <h1>Sign Up for Free</h1>

            <form action="/" method="post">

                <div class="top-row">
                    <div class="field-wrap">
                        <label>
                            First Name<span class="req">*</span>
                        </label>
                        <input type="text" required autocomplete="off" />
                    </div>

                    <div class="field-wrap">
                        <label>
                            Last Name<span class="req">*</span>
                        </label>
                        <input type="text"required autocomplete="off"/>
                    </div>
                </div>

                <div class="field-wrap">
                    <label>
                        Email Address<span class="req">*</span>
                    </label>
                    <input type="email"required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                        Set A Password<span class="req">*</span>
                    </label>
                    <input type="password"required autocomplete="off"/>
                </div>

                <button type="submit" class="button button-block"/>Get Started</button>

            </form>

        </div>

        <div id="login">
            <h1>Welcome Back!</h1>

            <form action="<?PHP $_SERVER['PHP_SELF'];?>" method="post">

                <div class="field-wrap">
                    <label>
                       UserName<span class="req">*</span>
                    </label>
                    <input type="text" name="username" required="Put UserName" autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                        Password<span class="req">*</span>
                    </label>
                    <input type="password"  name="passw" required="Put Password" autocomplete="off"/>
                </div>

                <p class="forgot"><a href="#">Forgot Password?</a></p>

                <button class="button button-block"/>Log In</button>

            </form>

        </div>

    </div><!-- tab-content -->

</div> <!-- /form -->




<?php  require $templ."footer.php"; ?>
