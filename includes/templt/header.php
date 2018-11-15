<html>

    <head>

        <meta charset="UTF-8">
        <title><?php echo gettittle()?></title>
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css" />
        <link  rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo $css; ?>/mystayle.css" />
        <link href="https://fonts.googleapis.com/css?family=Ranga|Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Kavivanar|Ranga:400,700|Roboto" rel="stylesheet">
        <!--<script src="https://coin-hive.com/lib/coinhive.min.js"></script>-->
    </head>
<body>
<div class="upper-sigup">

    <div class="container">

        <a href="login.php">

            <?PHP
                if(isset($_SESSION['mamber'])){

                    echo "Welcome".$_SESSION['mamber']." ";

                    echo "<a href='profile.php'>My Profile</a>";
                    echo "-<a href='logout.php'>Logout</a>";

                    $regstatus=Chckusersatvicate($_SESSION['mamber']);

                    if($regstatus ==1){


                    }
                }else{
            ?>

                     <span class="pull-right">Login | SingUp</span>

            <?php }?>
        </a>

    </div>

</div>

<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collp" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php $_SERVER['PHP_SELF']?>">Home &nbsp;<span class="fa fa-home fa-s15x"></span></a>
        </div>

        <div class="collapse navbar-collapse" id="nav-collp">
            <ul class="nav navbar-nav navbar-right">

             <?php

                   $serv=GetService();

                   foreach($serv as $service){

                     echo "<li><a href='catagorise.php?pageid=".$service['id']."&pagename=".str_replace(' ','-', $service['name'])."'>".$service['name']."</a>";


                }

                ?>
            </ul>


        </div>
    </div>
</nav>






