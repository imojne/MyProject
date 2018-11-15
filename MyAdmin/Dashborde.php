<?php

    ob_start(); //output beffring start

  session_start();

  $printtittle="Dashborde";

    if(isset($_SESSION['username'])){

        require "routes.php";


        //this function get all data from databases

        $Latestusers=getlatest('*','shop.users','userid');
        $latestitems=getlatest('*','shop.items','item_id')

        ?>
        	<!--start dashorde page -->

        	<div class="container text-center home-stat">
        		<h1 class="text-center newlooke"> Dashborde</h1>
        		<div class="row">
        			<div class="col-md-3">

        				<div class="stat Mammbers newlooke">
                            <i class="fa fa-users"></i>
                            <div class="info">
        					    Total Mammbers
        					    <span class="bignum"><a href="mambers.php"><?php echo CountUsers('userid','shop.users')?></a></span>
                            </div>
        				</div>
        		   </div>
        			<div class="col-md-3">
        				<div class="stat Pading newlooke">
                            <i class="fa fa-plus"></i>
                                <div class="info">
                                     Total Pading
                                </div>
        					<span class="bignum"><a href="mambers.php?action=Mange&page=Panding"><?php echo CheckNameExsistInDB('regstatus','shop.users',0)?></a> </span>
        				</div>

        			</div>
        			<div class="col-md-3">
        				<div class="stat Items newlooke">
                            <i class="fa fa-tags"></i>
                                <div class="info">
                                    Total Items
                                    <span class="bignum" ><a href="items.php"><?php echo CountUsers('item_id','shop.items')?></a></span>
                                </div>
        				</div>

        			</div>

        			<div class="col-md-3">
        				<div class="stat Comments">
                            <i class="fa fa-comment"></i>
                                <div class="info">
                                   Total Comments
                                </div>
        					<span class="bignum"><a href="comments.php"><?php echo CountUsers('coment_id','shop.comments')?></a></span>
        				</div>

        			</div>

        		</div>

            </div>


        <div class="container MyMaggin">

              <div class="row">

                    <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <i class="fa fa-users " >&nbsp;</i>Latest Register Users </div>
                            <div class="panel-body">
                                <ul class="list-unstyled mylist-use">
                                    <?php

                                        foreach($Latestusers as $users){

                                            echo "<li>";

                                            echo $users['username'];


                                            echo '<a href="mambers.php?action=Edit&userid='.$users['userid'].'">';

                                            echo "<span class='btn btn-success pull-right'><i class='fa fa-edit'></i> Edit";

                                            echo "</span>";
                                            echo "</a>";

                                            if($users["regstatus"]== 0){

                                                echo "<a href='mambers.php?action=Activate&userid=".$users['userid']."' class='btn btn-info pull-right'><i class='fa fa-close'></i> &nbsp; Activate</a>";


                                            echo "</li>";
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-users " >&nbsp;</i>Latest Items
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled mylist-use">
                                    <?php

                                    foreach($latestitems as $items){

                                        echo "<li>";

                                        echo $items['name'];


                                        echo '<a href="items.php?action=Edit&itemid='.$items['item_id'].'">';

                                        echo "<span class='btn btn-success pull-right'><i class='fa fa-edit'></i> Edit";

                                        echo "</span>";
                                        echo "</a>";

                                        if($items["approve"]== 0){

                                            echo "<a href='items.php?action=Approve&itemid=".$items['item_id']."' class='btn btn-info pull-right'><i class='fa fa-check'></i> &nbsp; Approve</a>";


                                            echo "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                        </div>

                    </div>
                    </div>

            <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-comment-o " >&nbsp;</i>comments Items
                    </div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <?php

                            $stmt=$conn->prepare("SELECT comments.* ,users.username as UserName FROM shop.comments
                    
                                                    inner join shop.users on users.userid=comments.user_ID ");

                            $stmt->execute();
                            $comments=$stmt->fetchAll();

                            foreach($comments as $comment){


                                echo "<div class='comment-box'>";

                                echo "<span class='comm-us'>".$comment['UserName']."</span>";
                                echo "<p class='comm-com'>".$comment['comment'].'</p>';

                                echo "</div>";
                            }

                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>






        	<!--end dashborde page-->

        <?php


        require $templ."footer.php";

    }else{

        header('Location:index.php');

    }

        ob_end_flush();


?>