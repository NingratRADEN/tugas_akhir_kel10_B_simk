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