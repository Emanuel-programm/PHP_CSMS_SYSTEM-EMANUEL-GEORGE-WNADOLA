<?php include_once "include/admin_header.php"; ?>
<div id="wrapper">
<!-- Navigation -->
<?php include "include/admin_navigation.php" ?>
<div id="page-wrapper">
<div class="container-fluid">
<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
WELCOME TO ADMIN PAGE
<small>

<?php
if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
}
?>


</small>
</h1>
<div class="col-xs-10">

<?php  
if(isset($_GET['source'])){
    $source=$_GET['source'];
}
else{
    $source=''; 
}
switch($source){
case 'add_user':
include "include/add_user.php";
break;
case 'edit_user':
include "include/edit_user.php";
break;  
default:
include "include/view_all_user.php";
}

?>
</div>
</div>

</div>
</div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php include "include/admin_footer.php"?>
