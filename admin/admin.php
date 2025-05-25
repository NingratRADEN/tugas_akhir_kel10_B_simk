<?php 

session_start();
if (!isset($_SESSION['user'])) {
  // jika user belum login
  header('Location: ./login.php');
  exit();
}
include "header.php";
   

   //Isi atau Content 
    if(isset($_GET['menu'])){
        if($_GET['menu']==1){
            include "notifadmin.php";
        }else if($_GET['menu']==2){
            include "bayaradmin.php";
        }else if($_GET['menu']==3){
            include "pengaduanadmin.php";
        }else if($_GET['menu']==4){
            include "infokosadmin.php";
        }else if($_GET['menu']==5){
            include "profileadmin.php";
        }else if($_GET['menu']==6){
            include "detailuseradmin.php";
        }else if($_GET['menu']==7){
            include "updateuser.php";
        }else{
            echo "Pilih Menu";
        }
    }else{
        include "dashboardadmin.php";
    }
    


include "footer.php";

?>