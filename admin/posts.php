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
<small>Author</small>
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
case 'add_post':
include "include/add_post.php";
break;
case 'edit_post':
include "include/edit_post.php";
break;  
default:
include "include/view_allpost.php";
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
