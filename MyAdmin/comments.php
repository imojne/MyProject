<?php
/**
 * =============================================.
 *
 * this page comments you can Edit & Delete From here
 *
 * =============================================
 */

        session_start();
        $printtittle="Comments";

        if(isset($_SESSION['username'])) {

            require "routes.php";

            $action = isset($_GET['action']) ? $_GET['action'] : "Mange";

            if ($action == "Mange") {

                $query='';

                if(isset($_GET['page']) && $_GET['page']=='Panding'){

                    $query='AND regstatus = 0';

                }

                // show All Info Except Admin
                $stmt=$conn->prepare("SELECT comments.* ,items.name as itmName ,users.username as userUsername FROM shop.comments

                                            inner join shop.items on items.item_id=comments.item_ID
                                            
                                            inner join shop.users on users.userid=comments.user_ID
                                            
                                            ");
                $stmt->execute();
                $record=$stmt->fetchAll();



                ?>

                <h1 class="text-center"> Manger Page</h1>
                <div class="container">
                    <div class="table-responsive">
                        <table class=" main-table  text-center table table-bordered">
                            <tr>
                                <td>#ID</td>
                                <td> comment</td>
                                <td> User Name</td>
                                <td> Item Name</td>
                                <td> Register Date</td>
                                <td> Control</td>
                            </tr>
                            <?php

                            foreach($record as $data){
                                echo "<tr>";
                                echo "<td>"  .$data['coment_id'].   "</td>";
                                echo "<td>"  .$data['comment']. "</td>";
                                echo "<td>"  .$data['userUsername']. "</td>";
                                echo "<td>"  .$data['itmName'].    "</td>";
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

                    </div>
                </div>




            <?php }elseif($action=="Edit"){

                //get userid and check is numeric or not

                $commid=isset($_GET['commid']) && is_numeric($_GET['commid']) ? intval($_GET['commid']):0;


                $stmt=$conn->prepare('SELECT * FROM shop.comments WHERE coment_id=? ');
                $stmt->execute(array($commid));
                $rows=$stmt->fetch();
                if($stmt->rowCount() > 0){ ?>

                    <!-- start Edit comment with boodtrap -->

                    <h1 class="text-center"> Edit Comments </h1>

                    <div class="container">

                        <form class="form-horizontal" action="?action=update" method="POST">

                            <input type="hidden" name="commid" value="<?php echo $commid;?>">
                            <!--start group username-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Comments</label>
                                <div class="col-sm-10 col-md-4">
                                    <textarea type="text" class="form-control" rows="4" name="comment" role="textbox" ><?php echo $rows['comment']?></textarea>
                                </div>

                            </div>
                            <!--end comment  -->


                            <!--start group bottun-->
                            <div class="form-group">

                                <div class="col-sm-offset-2 col-md-4">
                                    <input type="submit" value="Save Comment"  class="btn btn-primary " >

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

                    $commid = $_POST['commid'];
                    $comment = $_POST['comment'];



                    $stmt = $conn->prepare("UPDATE shop.comments SET comment=? WHERE coment_id=? ");

                    $stmt->execute(array($comment, $commid));

                    echo "<div class='container'>";

                    $theMssg= "<div class ='alert alert-success'>" . $stmt->rowCount() . ' ' . 'Recorde Success' . "</div>";

                    echo redirection($theMssg,'back');

                    echo "</div>";




                } else {

                    $error= 'You Can\'t Access In This Page Derctliy';
                    ECHO "<div class='alert alert-danger'>".redirection($error)."</div> ";
                    echo "</div>";
                }

            }elseif($action=="Delete"){

                echo "<h1 class='text-center'> Delete Comments </h1>";
                echo "<div class='container'>";
                echo "<div class='col-lg-8'>";

                $commid= isset($_GET['commid']) && is_numeric($_GET['commid']) ? intval($_GET['commid']) : 0;


                $check=CheckNameExsistInDB('comment','shop.comments',$commid);


                if($check >0){

                    $stmt=$conn->prepare("DELETE FROM shop.comments WHERE coment_id=?");

                    $stmt->execute(array($commid));

                    $error= "<div class='alert alert-success'>".$stmt->rowCount()." Record Deleted</div>";
                    redirection($error,'back');

                }else{



                    $error="<div class='alert alert-danger'> No Record Deleted </div>";
                    redirection($error,'back');
                }

                echo "</div>";
                echo "</div>";

            }elseif($action=="Approve"){

                echo "<h1 class='text-center'> Activate Mamber </h1>";
                echo "<div class='container'>";
                echo "<div class='col-lg-8'>";

                $commid= isset($_GET['commid']) && is_numeric($_GET['commid']) ? intval($_GET['commid']) : 0;


                $check=CheckNameExsistInDB('coment_id','shop.comments',$commid);

                if($check >0){

                    $stmt=$conn->prepare("UPDATE shop.comments SET status=1 WHERE coment_id=?");

                    $stmt->execute(array($commid));

                    $error= "<div class='alert alert-success'>".$stmt->rowCount()." Record Approved</div>";
                    redirection($error,'back');

                }else{

                    $error="<div class='alert alert-danger'> No Record Approved </div>";
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