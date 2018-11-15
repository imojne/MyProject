<?php

        session_start();
        $nonavebar='';
        $printtittle="index";

        if(isset($_SESSION['username'])){

            header('Location:Dashborde.php');
        }

        require "routes.php";

        if ($_SERVER["REQUEST_METHOD"]=='POST') {


                 $username=$_POST['user'];
                 $password=$_POST['pass'];
                 $hashed=md5($password);

                $stmt=$conn->prepare("SELECT 

                                                     userid, username,password 
                                                FROM 
                                                      shop.users
                                                WHERE 
                                                      username= ? 
                                                AND 
                                                      password= ? 
                                                AND 
                                                      groupid=1
                                                LIMIT 1 ");
                $stmt->execute(array($username,$hashed));
                $rows=$stmt->fetch();
                $count=$stmt->rowCount();

                // if count chack date find in mysql or not

            if ($count >0){

               $_SESSION['username']=$username;//regisert session name
               $_SESSION['ID']=$rows['userid']; //regisert session id

                header('Location:Dashborde.php');
                exit();


             }



        }



?>

  <form class="login" action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
       <h4 class="text-center"> Admin Login</h4>
      <input class="form-control input-lg" type="text" name="user" placeholder="Username"  autocomplete="off" >
      <input class="form-control input-lg" type="password" name="pass" placeholder="Passowrd"  autocomplete="new-password">
      <input class="btn btn-danger btn-block btn-lg" type="submit"  value="Login" >

  </form>


<?php

    require $templ."footer.php";

?>



