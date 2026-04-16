<?php
session_start();
include("function/function.php");
include("function/auth.php");
$smsObj= new studnet_management();


if(isset($_GET['adminLogout'])){
  if($_GET['adminLogout']='logout'){
    $smsObj->logOut();
  }
}
?>


<?php include_once("include/head.php")?>
<body>

<!-- ================= TOPBAR ================= -->
<?php include_once("include/topbar.php")?>

<!-- ================= SIDEBAR ================= -->
<?php include_once("include/sidebar.php") ?>

<!-- ================= CONTENT ================= -->
<div class="content">

  <!-- CARDS -->
 <?php 
 if(isset($view)){
  if($view=="dashboard"){
    include("view/dash_view.php");
  }elseif($view=="add_class"){
    include("view/class_view.php");
  }elseif($view=="add_section"){
    include("view/section_view.php");
  }elseif($view=="add_session"){
    include("view/session_view.php");
  }elseif($view=="add_student"){
    include("view/add_student_view.php");
  }elseif($view=="all_student_summary"){
    include("view/all_stud_view.php");
  }elseif($view=="up_class"){
    include("view/up_class_view.php");
  }elseif($view=="up_section"){
    include("view/up_section_view.php");
  }

 }
 ?>

</div>

<!-- ================= JS ================= -->
<?php include_once("include/footer_js.php"); ?>

</body>
</html>