<?php



        ob_start();

        session_start();
        $printtittle="Items";

        if($_SESSION['username']) {

            require "routes.php";

            $action = isset($_GET['action']) ? $_GET['action'] : "Mange";

            if ($action == "Mange") {

                $stmt = $conn->prepare("SELECT items.*,catgoirse.name  
                                                            As 
                                                                cat_name , users.username 
                                                            as 
                                                                user_username 
                                                            FROM 
                                                                shop.items 
                                                            INNER JOIN 
                                                                shop.catgoirse 
                                                            ON 
                                                                catgoirse.id=items.cat_id

                                                           INNER JOIN 
                                                                shop.users 
                                                           ON 
                                                                users.userid=items.user_id");
                $stmt->execute();
                $items = $stmt->fetchAll();
                ?>

                <h1 class="text-center"> Manger Items</h1>
                <div class="container">
                    <div class="table-responsive">
                        <table class=" main-table  text-center table table-bordered">
                            <tr>
                                <td>#ID</td>
                                <td> Username</td>
                                <td> FullName</td>
                                <td> Email</td>
                                <td> Service</td>
                                <td> Register Date</td>

                                <td> Control</td>
                            </tr>
                            <?php

                            foreach ($items as $item) {
                                echo "<tr>";
                                echo "<td>" . $item['item_id'] . "</td>";
                                echo "<td>" . $item['name'] . "</td>";
                                echo "<td>" . $item['descrption'] . "</td>";
                                echo "<td>" . $item['cost'] . "</td>";
                                echo "<td>" . $item['cat_name'] . "</td>";

                                echo "<td>" . $item['add_date'] . "     </td>";

                                echo "<td>";
                                echo "<a href='items.php?action=Edit&itemid=" . $item['item_id'] . "' class='btn btn-success'><i class='fa fa fa-edit'></i>&nbsp; Edite</a> &nbsp;";

                                echo "<a href='items.php?action=Delete&itemid=" . $item['item_id'] . "' class='btn btn-danger'><i class='fa fa-close'></i> &nbsp; Delete</a>&nbsp;";

                                if($item["approve"]== 0){

                                    echo "<a href='items.php?action=Approve&itemid=".$item['item_id']."' class='btn btn-info'><i class='fa fa-check'></i> &nbsp; Approve</a>";
                                }


                                echo "</td>";
                                echo "</tr>";

                            }
                            ?>

                        </table>

                    </div>
                    <a href='items.php?action=Add' class="btn btn-primary"><i class="fa fa-plus-circle"></i> &nbsp; Add
                        New Items </a>
                </div>


                <?php

            } elseif ($action == "Add") {
                ?>


                <h1 class="text-center"> Add New Items </h1>

                <div class="container">

                    <form class="form-horizontal" action="?action=insert" method="POST">


                        <!--start group username-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="name" placeholder="Name Of Items" class="form-control"
                                       autocomplete="off" required="required">

                            </div>

                        </div>
                        <!--end group usrenmae -->

                        <!--start group Emile-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Descrption:</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="Descrption" placeholder="Put The Descrption about items"
                                       class="form-control"
                                       autocomplete="off required=" required="">

                            </div>

                        </div>
                        <!--end group Emile

                        <!--start group Password-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Price</label>
                            <div class="col-sm-10 col-md-4">

                                <input type="text" name="cost" class="form-control"
                                       required="required" placeholder="Price of items">

                            </div>

                        </div>
                        <!--end group Password -->

                        <!--start group FullName-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Country</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="country" placeholder="Country Of Items" class="form-control"
                                       required="required">

                            </div>

                        </div>
                        <!--end group FullName -->

                        <!-- start Stauts field-->

                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Status</label>
                            <div class="col-sm-10 col-md-4">
                                <select class="form-control" name="status">
                                    <option value="0">....</option>
                                    <option value="1">New</option>
                                    <option value="2"> Like New</option>
                                    <option value="3"> used</option>
                                    <option value="4"> Old</option>

                                </select>

                            </div>

                        </div>
                        <!-- start status end-->


                        <!-- start Mamber field-->

                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Mamber</label>
                            <div class="col-sm-10 col-md-4">
                                <select class="form-control" name="mamber">
                                    <option value="0">....</option>
                                    <?php
                                    $stmt = $conn->prepare('SELECT * FROM shop.users');

                                    $stmt->execute();
                                    $mamber = $stmt->fetchAll();
                                    foreach ($mamber as $users) {

                                        echo "<option value='" . $users['userid'] . "'>" . $users['username'] . "</option>";

                                    }
                                    ?>

                                </select>

                            </div>

                        </div>
                        <!-- start Mamber end-->


                        <!-- start service field-->

                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Service</label>
                            <div class="col-sm-10 col-md-4">
                                <select class="form-control" name="service">
                                    <option value="0">....</option>
                                    <?php
                                    $stmt = $conn->prepare('SELECT * FROM shop.catgoirse');

                                    $stmt->execute();
                                    $service = $stmt->fetchAll();
                                    foreach ($service as $services) {

                                        echo "<option value='" . $services['id'] . "'>" . $services['name'] . "</option>";

                                    }
                                    ?>

                                </select>

                            </div>

                        </div>
                        <!-- start service end-->
                        <!--start group bottun-->
                        <div class="form-group">

                            <div class="col-sm-offset-2 col-md-4">
                                <input type="submit" value="Add Mambers" class="btn btn-primary">


                            </div>

                        </div>
                        <!--end group bottun -->

                    </form>


                </div>

                <!-- End  Form Add Mabmers page with boodtrap -->


                <?php

            } elseif ($action == "insert") {


                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    echo "<h1 class='text-center'> Add New Items</h1>";
                    echo "<div class='container'>";


                    $name = $_POST['name'];
                    $desc = $_POST['Descrption'];
                    $price = $_POST['cost'];
                    $country = $_POST['country'];
                    $status = $_POST['status'];
                    $mamber = $_POST['mamber'];
                    $service = $_POST['service'];


                    $ErrorsArray = array();

                    if (empty($name)) {

                        $ErrorsArray[] = ' Name You Can\'t Be empty';
                    }
                    if (empty($desc)) {

                        $ErrorsArray[] = ' Descrption You Can\'t Be empty';

                    }


                    if (empty($price)) {

                        $ErrorsArray[] = ' Price You Can\'t Be empty';

                    }

                    if (empty($country)) {

                        $ErrorsArray[] = 'Country You Can\'t Be empty';

                    }

                    if ($status == 0) {

                        $ErrorsArray[] = 'You Must be Choose Baby :)';

                    }
                    if ($mamber == 0) {

                        $ErrorsArray[] = 'You Must be Choose Baby :)';

                    }

                    if ($service == 0) {

                        $ErrorsArray[] = 'You Must be Choose Baby :)';

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


                        try {
                            $stmt = $conn->prepare("INSERT INTO shop.items(`name`,`descrption`,cost,`country_made`,`add_date`,`stauts`,`cat_id`,`user_id`)
                                                         VALUES (:zname,:zdesc,:zprice,:zcounr,now(),:zstatus,:zcat,:zuser)");

                            $stmt->bindParam(':zname', $name);
                            $stmt->bindParam(':zdesc', $desc);
                            $stmt->bindParam(':zprice', $price);
                            $stmt->bindParam(':zcounr', $country);
                            $stmt->bindParam(':zstatus', $status);
                            $stmt->bindParam(':zcat', $service);
                            $stmt->bindParam(':zuser', $mamber);

                            $stmt->execute();

                        } catch (PDOException $e) {

                            echo '<div class="alert alert-danger">' . 'Error ->' . $e->getMessage() . '</div>';

                        }
                        echo "<div class='container'>";

                        $theMssg = "<div class ='alert alert-success'>" . $stmt->rowCount() . ' ' . 'Recorde Success' . "</div>";
                        echo redirection($theMssg);

                        echo "</div>";


                    }
                }


                //Error ->SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ') VALUES ('pc ','this i' at line 1
                // Error ->SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '() ,'dz','2')' at line 2

            } elseif ($action == "Edit") {

                //get userid and check is numeric or not

                $item_id = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;


                $stmt = $conn->prepare('SELECT * FROM shop.items WHERE item_id=?');
                $stmt->execute(array($item_id));
                $rows = $stmt->fetch();
                if ($stmt->rowCount() > 0) { ?>


                    <h1 class="text-center"> Edit New Items </h1>

                    <div class="container">

                        <form class="form-horizontal" action="?action=update" method="POST">
                            <input type="hidden" name="itemid" value="<?php $item_id ?>">

                            <!--start group username-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Name</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" name="name" placeholder="Name Of Items" class="form-control"
                                           autocomplete="off" value='<?php echo $rows['name']; ?>' required="required">

                                </div>

                            </div>
                            <!--end group usrenmae -->

                            <!--start group Emile-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Descrption:</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" name="Descrption" placeholder="Put The Descrption about items"
                                           class="form-control"
                                           autocomplete="off" value="<?php echo $rows['descrption']; ?> " required="">

                                </div>

                            </div>
                            <!--end group Emile

                            <!--start group Password-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Price</label>
                                <div class="col-sm-10 col-md-4">

                                    <input type="text" name="cost" class="form-control"
                                           value="<?php echo $rows['cost']; ?> " required="required"
                                           placeholder="Price of items">

                                </div>

                            </div>
                            <!--end group Password -->

                            <!--start group FullName-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Country</label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" name="country" placeholder="Country Of Items"
                                           class="form-control"
                                           value="<?php echo $rows['country_made']; ?> " required="required">

                                </div>

                            </div>
                            <!--end group FullName -->

                            <!-- start Stauts field-->

                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Status</label>
                                <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="status">
                                        <option value="0">....</option>
                                        <option value="1" <?php if ($rows['stauts'] == 1) {
                                            echo "selected";
                                        } ?> >New
                                        </option>
                                        <option value="2" <?php if ($rows['stauts'] == 2) {
                                            echo "selected";
                                        } ?>> Like New
                                        </option>
                                        <option value="3" <?php if ($rows['stauts'] == 3) {
                                            echo "selected";
                                        } ?>> used
                                        </option>
                                        <option value="4" <?php if ($rows['stauts'] == 4) {
                                            echo "selected";
                                        } ?>> Old
                                        </option>

                                    </select>

                                </div>

                            </div>
                            <!-- start status end-->


                            <!-- start service field-->

                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Mamber</label>
                                <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="mamber">
                                        <option value="0">....</option>
                                        <?php
                                        $stmt = $conn->prepare('SELECT * FROM shop.users');

                                        $stmt->execute();
                                        $mamber = $stmt->fetchAll();
                                        foreach ($mamber as $mambers) {

                                            global $items;

                                            echo "<option value='" . $mambers['userid'] . "'";
                                            if ($rows['user_id'] == $mambers['userid']) {
                                                echo "selected";
                                            }
                                            echo ">" . $mambers['username'] . "</option>";

                                        }
                                        ?>

                                    </select>

                                </div>

                            </div>


                            <!-- start service field-->

                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Service</label>
                                <div class="col-sm-10 col-md-4">
                                    <select class="form-control" name="service">
                                        <option value="0">....</option>
                                        <?php
                                        $stmt = $conn->prepare('SELECT * FROM shop.catgoirse');

                                        $stmt->execute();
                                        $service = $stmt->fetchAll();
                                        foreach ($service as $services) {

                                            echo "<option value='" . $services['id'] . "'";
                                            if ($rows['cat_id'] == $services['id']) {
                                                echo "selected";
                                            }
                                            echo ">" . $services['name'] . "</option>";
                                        }
                                        ?>

                                    </select>

                                </div>

                            </div>
                            <div class="form-group">

                                <div class="col-sm-offset-2 col-md-4">
                                    <input type="submit" value="Save Items" class="btn btn-primary">


                                </div>

                            </div>

                        </form>

                        <?php

                        // show All Info Except Admin
                        $stmt=$conn->prepare("SELECT comments.* ,users.username as UserName FROM shop.comments

                                inner join shop.users on users.userid=comments.user_ID
                                
                                 WHERE comments.item_ID=? ");

                        $stmt->execute(array($item_id));
                        $record=$stmt->fetchAll();

                            if(!empty($record)){

                        ?>

                        <h1 class="text-center"> Manger [<?php echo $rows['name'];?>] Page</h1>
                            <div class="table-responsive">
                                <table class=" main-table  text-center table table-bordered">
                                    <tr>
                                        <td> comment</td>
                                        <td> UserName</td>
                                        <td> Register Date</td>
                                        <td> Control</td>
                                    </tr>
                                    <?php

                                    foreach($record as $data){
                                        echo "<tr>";
                                        echo "<td>"  .$data['comment']. "</td>";
                                        echo "<td>"  .$data['UserName'].    "</td>";
                                        echo "<td>"  .$data['date_com']."     </td>";
                                        echo "<td>";
                                        echo "<a href='comments.php?action=Edit&commid=".$data['coment_id']."' class='btn btn-success'><i class='fa fa fa-edit'></i>&nbsp; Edite</a> &nbsp;";

                                        echo "<a href='comments.php?action=Delete&commid=".$data['coment_id']."' class='btn btn-danger'><i class='fa fa-close'></i> &nbsp; Delete</a>&nbsp;";

                                        if($data["status"]== 0){

                                            echo "<a href='comments.php?action=Approve&commid=".$data['coment_id']."' class='btn btn-info'><i class='fa fa-close'></i> &nbsp; Activate</a>";
                                        }

                                        echo "</td>";
                                        echo "</tr>";

                                    }
                                    ?>

                                </table>


                                <?php } ?>
                        </div>


                    </div>

                    <?php

                } else {

                    $theMssg = "<div class='alert alert-danger'>Theres No Such ID</div>";
                    redirection($theMssg, 'back');

                }

                //Error ->SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'stauts='2' cat_id='1' at line 8


            } elseif ($action == "update") {


                if($_SERVER['REQUEST_METHOD']=='POST'){

                    echo "<h1 class='text-center'> Update New Items</h1>";
                    echo "<div class='container'>";

                    $item_id    = $_POST['itemid'];
                    $name       = $_POST['name'];
                    $desc       = $_POST['Descrption'];
                    $price      = $_POST['cost'];
                    $country    = $_POST['country'];
                    $status     = $_POST['status'];
                    $mamber     = $_POST['mamber'];
                    $service    = $_POST['service'];


                    $ErrorsArray = array();

                    if (empty($name)) {

                        $ErrorsArray[] = ' Name You Can\'t Be empty';
                    }
                    if (empty($desc)) {

                        $ErrorsArray[] = ' Descrption You Can\'t Be empty';

                    }


                    if (empty($price)) {

                        $ErrorsArray[] = ' Price You Can\'t Be empty';

                    }

                    if (empty($country)) {

                        $ErrorsArray[] = 'Country You Can\'t Be empty';

                    }

                    if ($status == 0) {

                        $ErrorsArray[] = 'You Must be Choose Baby :)';

                    }
                    if ($mamber == 0) {

                        $ErrorsArray[] = 'You Must be Choose Baby :)';

                    }

                    if ($service == 0) {

                        $ErrorsArray[] = 'You Must be Choose Baby :)';

                    }

                if (empty($ErrorsArray)) {

                    //this function check username is exists in database or not


                    try {
                        $stmt = $conn->prepare("UPDATE items SET name = :zname, descrption = :zdesc',cost =:zprice ,country_made=:zcounr ,stauts=:zstatus,cat_id=:zcat,user_id=:zuser WHERE item_id=:iteid ");

                        $stmt->bindParam(':zname', $name);
                        $stmt->bindParam(':zdesc', $desc);
                        $stmt->bindParam(':zprice', $price);
                        $stmt->bindParam(':zcounr', $country);
                        $stmt->bindParam(':zstatus', $status);
                        $stmt->bindParam(':zcat', $service);
                        $stmt->bindParam(':zuser', $mamber);
                        $stmt->bindParam(':iteid',$item_id);

                        $stmt->execute();

                    } catch (PDOException $e) {

                        // '<div class="alert alert-danger">' . 'Error ->' . $e->getMessage() . '</div>';

                    }
                    echo "<div class='container'>";

                    $theMssg = "<div class ='alert alert-success'>" . $stmt->rowCount() . ' ' . 'Update Success' . "</div>";
                    echo redirection($theMssg, 'back');

                    echo "</div>";
                }

                }else {

                    $error= 'You Can\'t Access In This Page Derctliy';
                    ECHO "<div class='alert alert-danger'>".redirection($error)."</div> ";
                    echo "</div>";
                }



         }elseif ($action=="Delete"){



                echo "<h1 class='text-center'> Delete Items </h1>";
                echo "<div class='container'>";
                echo "<div class='col-lg-8'>";

                $itemid= isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;


                $check=CheckNameExsistInDB('item_id','shop.items',$itemid);

                if($check >0){

                    $stmt=$conn->prepare("DELETE FROM shop.items WHERE item_id= :itmid");

                    $stmt->bindParam(':itmid',$itemid);
                    $stmt->execute();

                    $error= "<div class='alert alert-success'>".$stmt->rowCount()." Record Deleted</div>";
                    redirection($error,'back');

                }else{



                    $error="<div class='alert alert-danger'> No Record Deleted </div>";
                    //redirection($error,'back');
                }

                echo "</div>";
                echo "</div>";


         }elseif ($action=="Approve"){


                echo "<h1 class='text-center'> Approve Mamber </h1>";
                echo "<div class='container'>";
                echo "<div class='col-lg-8'>";

                $itemid= isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;


                $check=CheckNameExsistInDB('item_id','shop.items',$itemid);

                if($check >0){

                    $stmt=$conn->prepare("UPDATE shop.items SET approve=1 WHERE item_id=?");

                    $stmt->execute(array($itemid));

                    $error= "<div class='alert alert-success'>".$stmt->rowCount()." Record Approved</div>";
                    redirection($error,'back');

                }else{

                    $error="<div class='alert alert-danger'> No Record Approved </div>";
                    redirection($error,'back');
                }


                echo "</div>";
                echo "</div>";


            }


            require $templ."footer.php";


        }else{


            header('Location:index.php');
            exit();


        }