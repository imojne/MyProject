<?php

    session_start();

    $printtittle="HomePage";

    require "routes.php";


    if(isset($_SESSION['mamber'])){

        echo "welcome ".' '.$_SESSION['mamber'].' ';



    }else{

        header('Location:login.php');
        exit();
    }


    require $templ."footer.php";

?>



