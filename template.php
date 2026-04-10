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
  }

 }
 ?>

</div>

<!-- ================= JS ================= -->
<?php include_once("include/footer_js.php"); ?>

</body>
</html>