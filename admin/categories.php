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
<div class="col-xs-6">
<?php  insert_category();?>
<form action="" method="post">
<div class="form-group">
<label for="cat_title">Category Title</label>
<input type="text" class="form-control" name="cat_title">
</div>
<div class="form-group">
<input type="submit" class="btn btn-primary" name="submit" value="Add Category">
</div>
</form>

<?php 
if(isset($_GET['update'])){
    $cat_id=$_GET['update'];
    include "include/update.php";
}
?>
</div>
<div class="col-xs-6">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>id</th>
<th>category Title</th>
</tr>
</thead>
<tbody>
<?php // selecting query read from the database
 selecting_all_category();
?>
<?php  // delete query
delete_category();
?>
</tbody>
</table>
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
