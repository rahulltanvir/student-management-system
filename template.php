<?php include_once("include/head.php") ?>

<body class="dashbody">

  <?php include_once("include/sidebar.php") ?>

  <div class="main-content">
    <?php include_once("include/topbar.php") ?>
    <?php
    if (isset($view)) {
      if($view=="dashboard"){
        include("view/dash_view.php");
      }elseif($view =="add_class") {
        include("view/class_view.php");
      } elseif ($view == "add_section") {
        include("view/section_view.php");
      }elseif($view=="add_session"){
        include("view/session_view.php");
      }elseif($view=="add_student"){
        include("view/add_student_view.php");
      }elseif($view=="all_student_summary"){
        include("view/all_stud_view.php");
      }
    }

    ?>



    <script>
      function toggleMenu(event) {
        event.preventDefault();

        let submenu = event.currentTarget.nextElementSibling;
        submenu.classList.toggle("show");
      }
    </script>
</body>

</html>