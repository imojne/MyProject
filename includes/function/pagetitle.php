<?php





function GetService(){


    global $conn;

    $stmt=$conn->prepare('SELECT * FROM shop.catgoirse ORDER BY id DESC');

    $stmt->execute();

    $serv=$stmt->fetchAll();

   return $serv;




}




function GetItems($where,$catid){


    global $conn;

    $stms=$conn->prepare('SELECT *FROM shop.items WHERE $where=? ORDER BY item_id DESC');

    $stms->execute(array($catid));

     $cat=$stms->fetchAll();

    return $cat;



}


function Chckusersatvicate($user){

    global $conn;


    $stms=$conn->prepare("SELECT username,regstatus FROM shop.users WHERE username=? AND regstatus=0");
    $stms->execute(array($user));
    $stms->fetchAll();

    $status=$stms->rowCount();

    return $status;




}








    function gettittle(){

        global $printtittle;

        if(isset($printtittle)){

            echo $printtittle;
        }else{

            echo "Default";
        }



    }


    /*

      ==This Fucntion redirection

     */

    function redirection($theMssg, $url=null ,$second=3){

        echo "<div class='container'>";
        echo "<div class='col-lg-8'>";

        echo $theMssg;

        if($url===null){

            $url= 'index.php';

        }else{

            //this function to back

           $url= isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';



        }

        echo "<div class='alert alert-info'> You Will Be Redericted To Home Page After .$second.</div>";
        echo "</div>";
        echo "</div>";


        header("refresh:$second;url=$url");
        exit();


    }



    /*
     * This FUnction Check In Database If Items Exists Or not
     *
     */


    function CheckNameExsistInDB($select , $from,$value){

        global $conn;

        $stms1=$conn->prepare("SELECT $select FROM $from WHERE $select = :username");

        $stms1->bindParam(':username',$value);
        $stms1->execute();
        $count=$stms1->rowCount();

        return $count;


    }



    //this function count mammbers in databases

    function CountUsers($mamber,$from){

        global $conn;

        $stms=$conn->prepare("SELECT COUNT($mamber) FROM $from" );

        $stms->execute();

        return $stms->fetchColumn();



    }


    // this function get latest users rgister in databases


/**
 * @param $select
 * @param $from
 * @param $order
 * @param int $limit
 * @return array
 */
function getlatest($select, $from, $order, $limit=5){

        global $conn;

        $getstms=$conn->prepare("SELECT $select FROM $from ORDER BY $order DESC LIMIT $limit ");

        $getstms->execute();

        //selction show all data in database

        $rows=$getstms->fetchAll();

        return $rows;





    }




