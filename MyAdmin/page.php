<?php



    if(isset($_GET['action'])){

        $action=$_GET['action'];
        echo $action;

    }else{

        $action='Mange';
        echo $action;
    }


    switch ($action){

        case 'Mange':
            echo "<a href='page.php?action=add'>.add.</a>" ;
            break;
        case $action=='add':
            echo "You'r Here In Add" ;
            break;
        default:
            echo 'Error';
            exit();





    }