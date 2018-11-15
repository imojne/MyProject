<?php


        session_start();
        $nonavebar='';
        $printtittle="Profile";


        require 'routes.php';


        if(isset($_SESSION['mamber'])){

        $seesionuser=$_SESSION['mamber'];

        $stmt=$conn->prepare('SELECT * FROM shop.users WHERE username=?');

         $stmt->execute(array($seesionuser));
         $getuser=$stmt->fetch();


 ?>

<div class="bloack">
    <div class="container">


        <h1 class="text-center  font-size: 45px;font-weight: bold;"> My Profile</h1>


        <div class="panel panel-primary"">
            <div class="panel-heading"> Just Test</div>
            <div class="panel-body">

                Name:<?php echo $getuser['username'];?>

            </div>
        </div>

    </div>

    <div class="container">


        <div class="panel panel-primary">
            <div class="panel-heading"> Just Test</div>
            <div class="panel-body">


            </div>
        </div>

    </div>
    <div class="container">

        <div class="panel panel-primary"">
            <div class="panel-heading"> Just Test</div>
            <div class="panel-body">


            </div>
        </div>

    </div>

</div>

<?php

        }else{

            header("Location:login.php");
            exit();
        }
        require $templ."footer.php";


?>
