
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
WELCOME TO Comments PAGE
<small>
<?php
if(isset($_SESSION['username'])){
    echo $_SESSION['username'];
}
?>
</small>
</h1>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
        <th>id</th>
        <th>Author</th>
        <th>comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
        </tr>
</thead>
<tbody>
<?php
$query = "SELECT * FROM comments WHERE comment_post_id=" . mysqli_real_escape_string($connection, $_GET['id']);
$select_comments=mysqli_query($connection,$query);
if(!$select_comments){
    die("QUERY FAILED".mysqli_error($connection));
}
while($row=mysqli_fetch_assoc($select_comments)){
$comment_id=$row['comment_id'];
$comment_post_id=$row['comment_post_id'];
$comment_author=$row['comment_author'];
$comment_content=$row['comment_content'];
$comment_email=$row['comment_email'];
$comment_status=$row['comment_status'];
$comment_date=$row['comment_date'];

echo"<tr>";
echo "<td>$comment_id</td>";
echo "<td>$comment_author</td>";
echo "<td>$comment_content</td>";
// $query="SELECT * FROM categories WHERE cat_id={$post_category_id}";
// $select_categories_id=mysqli_query($connection,$query);
// while($row =mysqli_fetch_assoc($select_categories_id)){
// $cat_title=$row['cat_title'];
// $cat_id=$row['cat_id'];

// echo"<td>{$cat_title}</td>";


//php code for selecting the categories
echo "<td>$comment_email</td>";
echo "<td>$comment_status</td>";


$quey_post="SELECT * FROM posts WHERE post_id=$comment_post_id ";
$select_post_id_query=mysqli_query($connection,$quey_post);
if(!$select_post_id_query){
    die("QUERY FAILED".mysqli_error($connection));
}

while($row=mysqli_fetch_assoc($select_post_id_query)){
$post_id=$row['post_id'];
$post_title=$row['post_title'];

echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";


}


echo "<td>$comment_date</td>";
echo "
<td><a  href='comments.php?approve=$comment_id'>Approve</a></td>";
echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
echo "<td><a href='comments.php?delete=$comment_id&id=".$_GET['id']."'>DELETE</a></td>";
echo "</tr>";
}
?>  
</tbody>
</table>
<?php

// lets approve the comments
if(isset($_GET['approve'])){
    $the_comment_id=$_GET['approve'];
    $query = "UPDATE comments SET comment_status='approved' WHERE comment_id=$the_comment_id";
    $approve_comment_query=mysqli_query($connection,$query);
    header("location:comments.php");
    }


// lets unapprove the comments
if(isset($_GET['unapprove'])){
    $the_comment_id=$_GET['unapprove'];
    $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id=$the_comment_id";
    $unapprove_comment_query=mysqli_query($connection,$query);
    header("location:comments.php");
    }

// lets delete the comments

if(isset($_GET['delete'])){
$the_comment_id=$_GET['delete'];
$query = "DELETE FROM comments WHERE comment_id={$the_comment_id}";
$delete_query=mysqli_query($connection,$query);
header("location:post_comment.php?id=".$_GET['id']."");
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


