<?php


        require 'config.php';

        //Routes

        $templ= "includes/templt/";
        $lang = "includes/lang/";
        $func= "includes/function/";
        $css  = "layout/css/";
        $js   = "layout/js/";




        require $func."pagetitle.php";
        require $lang."english.php";
        require $templ."header.php";

        if (!isset($nonavebar)){ require $templ."navbar.php";}