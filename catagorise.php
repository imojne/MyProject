<?php require "routes.php"?>


    <div class="container">

        <h1 class="text-center"> <?php echo str_replace('-','',$_GET['pagename'])?></h1>

            <div class="row">
                <?php

            $pageid=$_GET['pageid'];


            foreach (GetItems('cat_id',$pageid) as $items) {

             echo "<div class='col-sm-6 col-md-3'>";

                 echo "<div class='thumbnail items-box' >";
                 echo "<span class='price-tag'>".$items['cost']."</span>";
                 echo "<div class='caption'>";

                 echo "<img  class='img-responsive' src='pc.jpeg' alt=''>";

                 echo "<h3>". $items['name']."</h3>";

                 echo "<p>".$items['descrption']."</p>";

                 echo "</div>";
                 echo "</div>";

             echo "</div>";


            }


        ?>

            </div>
    </div>



<?php  require $templ."footer.php"; ?>