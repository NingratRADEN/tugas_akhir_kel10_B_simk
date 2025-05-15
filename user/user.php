<?php 
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'user') {
    header("Location: ../login.php");
}
include "header.php";
   

   //Isi atau Content 
    if(isset($_GET['menu'])){
        if($_GET['menu']==1){
            include "notif.php";
        }else if($_GET['menu']==2){
            include "bayar.php";
        }else if($_GET['menu']==3){
            include "pengaduan.php";
        }else if($_GET['menu']==4){
            include "infokos.php";
        }else if($_GET['menu']==5){
            include "profile.php";
        }
        else{
            echo "Pilih Menu";
        }
    }else{
        include "dashboard.php";
    }
    


include "footer.php";

?>