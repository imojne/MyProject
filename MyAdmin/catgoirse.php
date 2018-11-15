<?php


        //this page catgoirse


        ob_start();

        session_start();

        $printtittle="Service";

        if($_SESSION['username']){

            require 'routes.php';

            $action=isset($_GET['action']) ? $_GET['action'] : "Mange";


            if($action=="Mange"){
                // this section show all info in database

                $sort="ASC";

                $sort_array=array("ASC",'DESC');


                //$sort= isset($_GET['sort']) && in_array($_GET['sort'],$sort_array) ? $_GET['sort'] : 0;


                if(isset($_GET['sort']) && in_array($_GET['sort'],$sort_array)){

                    $sort=$_GET['sort'];

                }


                    $stmt=$conn->prepare("SELECT * FROM shop.catgoirse ORDER BY `ordring` $sort" );

                    $stmt->execute();

                    $rows=$stmt->fetchAll(); ?>


                <h1 class="text-center newlooke">Mange Service</h1>
                <div class="container service">

                    <div class="col-md-12">

                       <div class="panel panel-default">

                           <div class="panel-heading"> <i class="fa fa-server"></i>&nbsp; Service
                               <div class=" pull-right">

                                   Ordering:
                                   <a  class="<?php if($sort=='ASC'){ECHO "active";}?>" href="?sort=ASC">Asc</a> |
                                   <a class="<?php if($sort=='DESC'){ECHO "active";}?>" href="?sort=DESC">Desc</a>
                               </div>

                              </div>
                           <div class="panel-body">

                               <?php

                                    foreach ($rows as $service){


                                        echo "<div class='name-server'>";

                                            echo "<div class='button-hidden'>";

                                                echo "<a href='catgoirse.php?action=Edit&servid=".$service['id']."' class='btn btn-success'> <i class='fa fa-edit'></i>Edit</a>";
                                                echo "<a href='catgoirse.php?action=Delete&servid=".$service['id']."' class='btn btn-danger'> <i class='fa fa-close'></i>Delete</a>";

                                            echo "</div>";

                                        echo "<h3 class='mycolor'>".$service['name']."</h3>";

                                        if($service['desception']==''){
                                            echo "<span> This Service Has No Descrption</span><br>";
                                        }else{

                                            echo "<span >".$service['desception']."</span><br>";
                                        }
                                                        echo "<br>";
                                        if($service['visbilty']==1){

                                            echo "<span class='visbil'><i class='fa fa-eye'></i> Hiddin</span>";

                                        }

                                        if($service['allow_comments']){
                                        echo "<span class='comm'> <i class='fa fa-close'></i>Comments Disabled</span>";

                                        }
                                        if($service['allow_ads']){
                                            echo "<span class='ads'><i class='fa fa-close'></i>Ads Disabled</span>";
                                        }

                                        echo "</div>";
                                        echo "<hr>";
                                    }



                               ?>


                           </div>
                       </div>

                        <a class="btn btn-primary" href="catgoirse.php?action=Add"><i class="fa fa-plus"></i>&nbsp;Add New Service</a>

                    </div>


                </div>
                <br>






            <?php }elseif ($action=="Add"){ ?>




                <!-- start  Form Add Mabmers page with boodtrap -->

                <h1 class="text-center"> Add New Service </h1>

                <div class="container">

                    <form class="form-horizontal" action="?action=insert" method="POST">


                        <!--start name of service-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Name</label>
                            <div class="col-sm-10 col-md-4">
                                <input type="text" name="name" placeholder="name" class="form-control"
                                       autocomplete="off" required="required">

                            </div>

                        </div>
                        <!--end name of service -->

                        <!--start Descrption-->
                        <div class="form-group">
                            <label for="id" class="col-sm-2 control-label "> Descrption:</label>
                            <div class="col-sm-10 col-md-4">

                                <textarea  id="id" class="form-control" rows="5" name="Descrption" placeholder="Descrption" required="required"></textarea>

                            </div>

                        </div>
                        <!--end Descrption-->

                        <!--start Order-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Order</label>
                            <div class="col-sm-10 col-md-4">

                                <input type="text" name="Order" class="form-control" autocomplete="new-password"
                                       placeholder="Choos Order">

                            </div>

                        </div>
                        <!--end Order -->

                        <!--start gVisible -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Visible</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="vis-yes" type="radio" name="visbile" value="0" checked />
                                    <label for="vis-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="vis-No" type="radio" name="visbile" value="1" />
                                    <label for="vis-No">No</label>
                                </div>

                            </div>

                        </div>
                        <!--end Visible -->

                       <!-- start allow comments-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Allow Comment</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="com-yes" type="radio" name="Comment" value="0" checked />
                                    <label for="com-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="com-No" type="radio" name="Comment" value="1" />
                                    <label for="com-No">No</label>
                                </div>

                            </div>

                        </div>

                        <!-- end allow comments-->

                        <!-- start ads-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label "> Allow Ads</label>
                            <div class="col-sm-10 col-md-4">
                                <div>
                                    <input id="Ads-yes" type="radio" name="Ads" value="0" checked />
                                    <label for="Ads-yes">Yes</label>
                                </div>
                                <div>
                                    <input id="Ads-No" type="radio" name="Ads" value="1" />
                                    <label for="Ads-No">No</label>
                                </div>

                            </div>

                        </div>

                        <!--end ads-->
                        <!--start group bottun-->
                        <div class="form-group">

                            <div class="col-sm-offset-2 col-md-4">
                                <input type="submit" value="Add Service" class="btn btn-primary ">

                            </div>

                        </div>
                        <!--end group bottun -->

                    </form>


                </div>

                <!-- End  Form Add Mabmers page with boodtrap -->



     <?php }elseif ($action=="insert"){


                //This Page I will insert Service or categorise in database

                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    echo "<h1 class='text-center'> Add Service </h1>";
                    echo "<div class='container'>";


                    $name     = $_POST['name'];
                    $Des      = $_POST['Descrption'];
                    $Order    = $_POST['Order'];
                    $visbile  = $_POST['visbile'];
                    $comm     =$_POST['Comment'];
                    $ADS      =$_POST['Ads'];





                    //this function check username is exists in database or not

                    $check=CheckNameExsistInDB('name','shop.catgoirse',$name);

                    if($check == 1){

                        echo "<div class='alert alert-danger'> Username Is Service Exists </div>";

                    }else{


                        //olumn not found: 1054 Unknown column 'name' in 'field list'

                        try{
                            $stmt = $conn->prepare("INSERT INTO shop.catgoirse(`name`,`desception`,`ordring`,`visbilty`,`allow_comments`,`allow_ads`)
                                                     VALUES (:Nname,:des,:Norder,:visible ,:comment,:ads)");
                           $stmt->execute(array(
                               "Nname"   =>$name,
                               "des"     =>$Des,
                               "Norder"  =>$Order,
                               "visible" =>$visbile,
                               "comment" =>$comm,
                               "ads"     =>$ADS
                              ));

                        }catch (PDOException $e){

                            echo '<div class="alert alert-danger">'.'Error ->'.$e->getMessage().'</div>';

                        }
                        echo "<div class='container'>";

                        $theMssg= "<div class ='alert alert-success'>" . $stmt->rowCount() . ' ' . 'Recorde Success' . "</div>";
                        echo redirection($theMssg,'back');

                        echo "</div>";

                    }




            }else {

                $error= '<div class="alert alert-danger">You Can\'t Access In This Page Derctliy</div>';

                ECHO "<div class='alert alert-danger'>".redirection($error)."</div> ";
                echo "</div>";
            }




            }elseif ($action=="Edit"){



                $serid=isset($_GET['servid']) && is_numeric($_GET['servid']) ? intval($_GET['servid']) : 0;




                $stmt=$conn->prepare('SELECT * FROM shop.catgoirse WHERE id=? LIMIT 1');
                $stmt->execute(array($serid));
                $rows=$stmt->fetch();
                if($stmt->rowCount() > 0){ ?>



                    <h1 class="text-center"> Edit Service </h1>

                    <div class="container">

                        <form class="form-horizontal" action="?action=update" method="POST">
                            <input type="hidden" name="serid" value="<?php echo $serid ?>">
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Name</label>
                                <div class="col-sm-10 col-md-4">
                                    <input  type="text"  placeholder="Name Of Service" name="name" value="<?php echo $rows['name']; ?>" class="form-control" autocomplete="off" required="required">

                                </div>

                            </div>
                            <!--end group usrenmae -->

                            <!--start group Emile-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Descrption:</label>
                                <div class="col-sm-10 col-md-4" >

                                    <textarea  id="id" type="text" class="form-control" rows="5" name="Descrption"><?php echo $rows['desception'];?></textarea>
                                </div>

                            </div>
                            <!--end group Emile

                               <!--start Order-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Order</label>
                                <div class="col-sm-10 col-md-4">

                                    <input type="text" name="Order" class="form-control"  value="<?php echo $rows['ordring']?>"
                                           placeholder="Choos Order">

                                </div>

                            </div>
                            <!--end Order -->

                            <!--start gVisible -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Visible</label>
                                <div class="col-sm-10 col-md-4">
                                    <div>
                                        <input id="vis-yes" type="radio" name="visbile" value="0" <?php if($rows['visbilty']==0){echo 'checked';}?> />
                                        <label for="vis-yes">Yes</label>
                                    </div>
                                    <div>
                                        <input id="vis-No" type="radio" name="visbile" value="1" <?php if($rows['visbilty']==1){echo 'checked';}?>/>
                                        <label for="vis-No">No</label>
                                    </div>

                                </div>

                            </div>
                            <!--end Visible -->

                            <!-- start allow comments-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Allow Comment</label>
                                <div class="col-sm-10 col-md-4">
                                    <div>
                                        <input id="com-yes" type="radio" name="Comment" value="0" <?php if($rows['allow_comments']==1){echo 'checked';}?>/>
                                        <label for="com-yes">Yes</label>
                                    </div>
                                    <div>
                                        <input id="com-No" type="radio" name="Comment" value="1"  <?php if($rows['allow_comments']==1){echo 'checked';}?> />
                                        <label for="com-No">No</label>
                                    </div>

                                </div>

                            </div>

                            <!-- end allow comments-->

                            <!-- start ads-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label "> Allow Ads</label>
                                <div class="col-sm-10 col-md-4">
                                    <div>
                                        <input id="Ads-yes" type="radio" name="Ads" value="0" <?php if($rows['allow_ads']==1){echo 'checked';}?>  />
                                        <label for="Ads-yes">Yes</label>
                                    </div>
                                    <div>
                                        <input id="Ads-No" type="radio" name="Ads" value="1" <?php if($rows['allow_ads']==1){echo 'checked';}?> />
                                        <label for="Ads-No">No</label>
                                    </div>

                                </div>

                            </div>

                            <!--start group bottun-->
                            <div class="form-group">

                                <div class="col-sm-offset-2 col-md-4">
                                    <input type="submit" value="Add Service" class="btn btn-primary ">

                                </div>

                            </div>
                            <!--end group bottun -->

                        </form>


                    </div>

               <?php }else{

                    $theMssg="<div class='alert alert-danger'>Theres No Such ID</div>";
                    redirection($theMssg,'back');

                }




            }elseif($action=="update"){


                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                    echo "<h1 class='text-center'> Add Service </h1>";
                    echo "<div class='container'>";

                    $serid    =$_POST['serid'];
                    $name     = $_POST['name'];
                    $Des      = $_POST['Descrption'];
                    $Order    = $_POST['Order'];
                    $visbile  = $_POST['visbile'];
                    $comm     =$_POST['Comment'];
                    $ADS      =$_POST['Ads'];


                    try{

                        $stmt=$conn->prepare('UPDATE shop.catgoirse SET name=?, desception=?, ordring=?,	visbilty=? ,allow_comments=?, allow_ads=? WHERE id=?');

                        $stmt->execute(array($name,$Des,$Order,$visbile,$comm,$ADS,$serid));

                        $theMssg= "<div class ='alert alert-success'>" . $stmt->rowCount() . ' ' . 'Update Service' . "</div>";
                        echo redirection($theMssg,'back');
                        //echo $theMssg;



                    }catch(PDOEexeption $e){


                        echo "<div class='alert alert-danger'>Error</div>";

                    }

                    echo "</div>";



                }else {

                    $error= '<div class="alert alert-danger">You Can\'t Access In This Page Derctliy</div>';

                    ECHO "<div class='alert alert-danger'>".redirection($error)."</div> ";
                    echo "</div>";
                }




            }elseif ($action=="Delete"){


                echo "<h1 class='text-center'> Delete Service </h1>";
                echo "<div class='container'>";
                echo "<div class='col-lg-8'>";

                $serid= isset($_GET['servid']) && is_numeric($_GET['servid']) ? intval($_GET['servid']) : 0;




                    try{

                    $stmt=$conn->prepare("DELETE FROM shop.catgoirse WHERE id= :id");

                    $stmt->bindParam(':id',$serid);
                    $stmt->execute();

                    $error= "<div class='alert alert-success'>".$stmt->rowCount()." Record Deleted</div>";
                    redirection($error,'back');

                }catch (PDOException $e){

                    $error="<div class='alert alert-danger'> Error".$e->getMessage()."</div>";
                    echo $error;
                    $error="<div class='alert alert-danger'> No Record Deleted </div>";
                    redirection($error);
                }

                echo "</div>";
                echo "</div>";



            }


                require $templ."footer.php";



        }else{

            header('Location:index.php');
            exit();
        }


        ob_end_flush();


?>