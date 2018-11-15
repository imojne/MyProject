<?php


        session_start();
        $printtittle="Mambers";

        if(isset($_SESSION['username'])) {

            require "routes.php";

            $action = isset($_GET['action']) ? $_GET['action'] : "Mange";

            if ($action == "Mange") {

                $query='';

                if(isset($_GET['page']) && $_GET['page']=='Panding'){

                    $query='AND regstatus = 0';

                }

                // show All Info Except Admin
                $stmt=$conn->prepare("SELECT * FROM shop.users WHERE groupid != 1 $query");
                $stmt->execute();
                $record=$stmt->fetchAll();



                ?>

                <h1 class="text-center"> Manger Page</h1>
                <div class="container">
                    <div class="table-responsive">
                        <table class=" main-table  text-center table table-bordered">
                            <tr>
                                <td>#ID</td>
                                <td> Username</td>
                                <td> FullName</td>
                                <td> Email</td>
                                <td> Register Date</td>
                                <td> Control</td>
                            </tr>
                            <?php

                                    foreach($record as $data){
                                        echo "<tr>";
                                            echo "<td>"  .$data['userid'].   "</td>";
                                            echo "<td>"  .$data['username']. "</td>";
                                            echo "<td>"  .$data['fullname']. "</td>";
                                            echo "<td>"  .$data['email'].    "</td>";
                                            echo "<td>"  .$data['Date']."     </td>";
                                            echo "<td>";
                                                 echo "<a href='mambers.php?action=Edit&userid=".$data['userid']."' class='btn btn-success'><i class='fa fa fa-edit'></i>&nbsp; Edite</a> &nbsp;";

                                                 echo "<a href='mambers.php?action=Delete&userid=".$data['userid']."' class='btn btn-danger'><i class='fa fa-close'></i> &nbsp; Delete</a>&nbsp;";

                                                if($data["regstatus"]== 0){

                                                        echo "<a href='mambers.php?action=Activate&userid=".$data['userid']."' class='btn btn-info'><i class='fa fa-close'></i> &nbsp; Activate</a>";
                                                }

                                        echo "</td>";
                                        echo "</tr>";

                                    }
                            ?>

                        </table>

                    </div>
                    <a href='mambers.php?action=Add' class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Add New Mamber </a>
                </div>




            <?php } elseif ($action == "Add") { ?>

                <!-- start  Form Add Mabmers page with boodtrap -->

                <h1 class="text-center"> Add New Mambers </h1>

                <div class="container">

                    <form class="form-horizontal" action="?action=insert" method="POST">


                        <!--start group username-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Username</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="user" placeholder="username" class="form-control"
                                       autocomplete="off" required="required">

                            </div>

                        </div>
                        <!--end group usrenmae -->

                        <!--start group Emile-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Emile</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="email" placeholder="Emile" class="form-control"
                                       autocomplete="off required=" required"">

                            </div>

                        </div>
                        <!--end group Emile

                        <!--start group Password-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Password</label>
                            <div class="col-sm-10 col-md-4">

                                <input type="password" name="newpass" class="form-control" autocomplete="new-password"
                                       required="required" placeholder="Password">

                            </div>

                        </div>
                    <!--end group Password -->

                        <!--start group FullName-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> FullName</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="fulln" placeholder="username" class="form-control"
                                       required="required">

                            </div>

                        </div>
                        <!--end group FullName -->

                        <!--start group bottun-->
                        <div class="form-group">

                            <div class="col-sm-offset-2 col-md-4">
                                <input type="submit" value="Add Mambers" class="btn btn-primary ">

                            </div>

                        </div>
                        <!--end group bottun -->

                    </form>


                </div>

                <!-- End  Form Add Mabmers page with boodtrap -->

                <?php

            } elseif ($action == 'insert') {



                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    echo "<h1 class='text-center'> Update Mambers</h1>";
                    echo "<div class='container'>";


                    $name = $_POST['user'];
                    $pass = $_POST['newpass'];
                    $email = $_POST['email'];
                    $fulln = $_POST['fulln'];

                    $shaed = md5($_POST['newpass']);

                    //check if you want let's the oldpassowrd still work or change to the new password

                    $ErrorsArray = array();

                    if (strlen($name) < 4) {

                        $ErrorsArray[] = 'Must Be Less Than 4 Charactars';
                    }
                    if (strlen($name) > 10) {

                        $ErrorsArray[] = 'Must Be Great Than 10 Charactars';

                    }


                    if (empty($name)) {

                        $ErrorsArray[] = ' Username You Can\'t Be empty';

                    }

                    if (empty($pass)) {

                        $ErrorsArray[] = ' Password You Can\'t Be empty';

                    }

                    if (empty($email)) {

                        $ErrorsArray[] = 'You Can\'t Be empty';

                    }
                    if (empty($fulln)) {

                        $ErrorsArray[] = 'Check At Form Again';

                    }

                    foreach ($ErrorsArray as $error) {

                        $check = "<div class='container'>";
                        $check .= "<div class='row'>";
                        $check .= "<div class='col-lg-4'>";

                        $check .= "<div class='alert alert-danger'>" . $error . "</div>";
                        $check .= "</div>";
                        $check .= "</div>";
                        $check .= "</div>";

                        echo $check;


                    }

                    //check if not Error In Array Allow To proced The Databaes => Updated

                    if (empty($ErrorsArray)) {

                        //this function check username is exists in database or not

                        $check=CheckNameExsistInDB('username','shop.users',$name);

                        if($check == 1){

                            echo "<div class='alert alert-danger'> Username Is Already Exists </div>";

                        }else{


                        try{
                        $stmt = $conn->prepare("INSERT INTO shop.users(`username`,`password`,`fullname`,`email`,`Date`)
                                                         VALUES (:username,:password,:fullname,:email , now())");
                        $stmt->bindParam(':username',$name);
                        $stmt->bindParam(':password',$shaed);
                        $stmt->bindParam(':fullname',$fulln);
                        $stmt->bindParam(':email',$email);

                        $stmt->execute();
                        }catch (PDOException $e){

                                echo '<div class="alert alert-danger">'.'Error ->'.$e->getMessage().'</div>';

                        }
                        echo "<div class='container'>";

                        $theMssg= "<div class ='alert alert-success'>" . $stmt->rowCount() . ' ' . 'Recorde Success' . "</div>";
                        echo redirection($theMssg,'back');

                        echo "</div>";

                        }

                    }


                }else {

                    $error= '<div class="alert alert-danger">You Can\'t Access In This Page Derctliy</div>';

                ECHO "<div class='alert alert-danger'>".redirection($error)."</div> ";
                echo "</div>";
            }


           }elseif($action=="Edit"){

                //get userid and check is numeric or not

                $userid=isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']):0;


              $stmt=$conn->prepare('SELECT * FROM shop.users WHERE userid=? LIMIT 1');
              $stmt->execute(array($userid));
              $rows=$stmt->fetch();
              if($stmt->rowCount() > 0){ ?>

                <!-- start Edit page with boodtrap -->

                <h1 class="text-center"> Edit Mambers </h1>

                <div class="container">

                    <form class="form-horizontal" action="?action=update" method="POST">

                        <input type="hidden" name="userid" value="<?php echo $userid;?>">
                        <!--start group username-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Username</label>
                            <div class="col-sm-10 col-md-4">
                                <input  type="text" name="user" placeholder="username"  value="<?php echo $rows['username']; ?>" class="form-control" autocomplete="off" required="required">

                            </div>

                        </div>
                        <!--end group usrenmae -->

                        <!--start group Emile-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Emile</label>
                            <div class="col-sm-10 col-md-4" >
                                <input  type="text" name="email" placeholder="Emile" value="<?php echo $rows['email']; ?>" class="form-control" autocomplete="off required="required"">

                            </div>

                        </div>
                        <!--end group Emile

                        <!--start group Password-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Password</label>
                            <div class="col-sm-10 col-md-4" >
                                <input type="hidden" name ="oldpassword" value="<?php echo $rows['password']?>" />
                                <input  type="password" name="newpass"   class="form-control" autocomplete="new-password">

                            </div>

                        </div>
                        <!--end group Password -->

                        <!--start group FullName-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> FullName</label>
                            <div class="col-sm-10 col-md-4" >
                                <input  type="text" name="fulln" value="<?php echo $rows['fullname']; ?>" placeholder="username" class="form-control" required="required" >

                            </div>

                        </div>
                        <!--end group FullName -->

                        <!--start group bottun-->
                        <div class="form-group">

                            <div class="col-sm-offset-2 col-md-4">
                                <input type="submit" value="Save"  class="btn btn-primary " >

                            </div>

                        </div>
                        <!--end group bottun -->

                    </form>


                </div>
       <?php

              }else{

                $theMssg="<div class='alert alert-danger'>Theres No Such ID</div>";
                redirection($theMssg,'back');

              }

            }elseif ($action=="update") {

            //This Saction Update date

            if ($_SERVER['REQUEST_METHOD'] == "POST") {


                echo "<h1 class='text-center'> Update Items</h1>";
                echo "<div class='container'>";

                $id = $_POST['userid'];
                $name = $_POST['user'];
                $email = $_POST['email'];
                $fulln = $_POST['fulln'];

                //check if you want let's the oldpassowrd still work or change to the new password

                $pass = empty($_POST['newpass']) ? $_POST['oldpassword'] : md5($_POST['newpass']);

                $ErrorsArray = array();

                if (strlen($name) < 4) {

                    $ErrorsArray[] = 'Must Be Less Than 4 Charactars';
                }
                if (strlen($name) > 10) {

                    $ErrorsArray[] = 'Must Be Great Than 10 Charactars';

                }


                if (empty($name)) {

                    $ErrorsArray[] = 'Check At Form Again';

                }

                if (empty($email)) {

                    $ErrorsArray[] = 'You Can\'t Be empty';

                }
                if (empty($fulln)) {

                    $ErrorsArray[] = 'Check At Form Again';

                }

                foreach ($ErrorsArray as $error) {

                    $check = "<div class='container'>";
                    $check .= "<div class='row'>";
                    $check .= "<div class='col-lg-4'>";

                    $check .= "<div class='alert alert-danger'>" . $error . "</div>";
                    $check .= "</div>";
                    $check .= "</div>";
                    $check .= "</div>";

                    echo $check;


                }

                //check if not Error In Array Allow To proced The Databaes => Updated

                if (empty($ErrorsArray)) {


                    $stmt = $conn->prepare("UPDATE shop.users SET username=? , email=? , fullname=?,password=? WHERE userid=? ");

                    $stmt->execute(array($name, $email, $fulln, $pass, $id));

                    echo "<div class='container'>";

                    $theMssg= "<div class ='alert alert-success'>" . $stmt->rowCount() . ' ' . 'Recorde Success' . "</div>";

                    echo redirection($theMssg,'back');

                    echo "</div>";

                }


            } else {

                $error= 'You Can\'t Access In This Page Derctliy';
                ECHO "<div class='alert alert-danger'>".redirection($error)."</div> ";
                echo "</div>";
            }

        }elseif($action=="Delete"){

                echo "<h1 class='text-center'> Delete Mamber </h1>";
                echo "<div class='container'>";
                echo "<div class='col-lg-8'>";

                $userid= isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;


                $check=CheckNameExsistInDB('userid','shop.users',$userid);

                if($check >0){

                    $stmt=$conn->prepare("DELETE FROM shop.users WHERE userid= :userid");

                    $stmt->bindParam(':userid',$userid);
                    $stmt->execute();

                    $error= "<div class='alert alert-success'>".$stmt->rowCount()." Record Deleted</div>";
                    redirection($error,'back');

                }else{



                    $error="<div class='alert alert-danger'> No Record Deleted </div>";
                    redirection($error);
                }

                echo "</div>";
                echo "</div>";

            }elseif($action=="Activate"){

                echo "<h1 class='text-center'> Activate Mamber </h1>";
                echo "<div class='container'>";
                echo "<div class='col-lg-8'>";

                $userid= isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;


                $check=CheckNameExsistInDB('userid','shop.users',$userid);

                if($check >0){

                    $stmt=$conn->prepare("UPDATE shop.users SET regstatus=1 WHERE userid=?");

                    $stmt->execute(array($userid));

                    $error= "<div class='alert alert-success'>".$stmt->rowCount()." Record Activate</div>";
                    redirection($error,'back');

                }else{

                    $error="<div class='alert alert-danger'> No Record Activate </div>";
                    redirection($error);
                }


                    echo "</div>";
                    echo "</div>";


            }

                //end section update data
                require $templ."footer.php";
           }else{
              header('Location:index.php');

          }


?>