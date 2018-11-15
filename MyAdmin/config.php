<?php

        //Configration ower website


    try{

            $db_conn = "mysql:host=127.0.0.1;dbname:shop";
            $user    = "root";
            $pass    = "";
            $optio=array(

                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );

            $conn=new PDO($db_conn,$user,$pass,$optio);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);



    }catch(PDOException $err){

            echo "Error ::".$err->getMessage();


    }