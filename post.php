<?php include "./include/db.php" ?>
<?php include "./include/header.php" ?>
    <!-- Navigation -->
    <?php include "./include/navigation.php" ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">


            <?php
            
            
            if(isset($_GET['p_id'])){
              $the_post_id=$_GET['p_id'];  
            

     
        $view_query="UPDATE posts SET post_views_count=post_views_count+1 WHERE post_id=$the_post_id";
        $send_query=mysqli_query($connection,$view_query);
        if(!$send_query){
            die("query failed".mysqli_error($connection));
        }


            
            $select="SELECT * FROM  posts WHERE post_id={$the_post_id}";
            $query=mysqli_query($connection,$select);

        while($row=mysqli_fetch_assoc($query)){
           $post_title=$row['post_title'];
           $post_author=$row['post_author'];
           $post_date=$row['post_date'];
           $post_content=$row['post_content'];
           $post_image=$row['post_image'];
          ?>
            
            
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="post_author.php?author=<?php echo $post_author;?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content; ?>.</p>

                <hr>
<?php }}

else{

header("location:index.php");
}




?>

                <!-- Comments Form -->
<?php

if(isset($_POST['create_comment'])){
$the_post_id=$_GET['p_id'];

$comment_author=$_POST['comment_author'];
$comment_email=$_POST['comment_email'];
$comment_content=$_POST['comment_content'];
if(!empty($comment_author) && !empty($comment_email) && !empty($comment_author)){

$query="INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)";
$query .=" VALUES ($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";
$create_comment_query=mysqli_query($connection,$query);
if(!$create_comment_query){
    die('QUERY FAILED'.mysqli_error($connection));
}

$query.=" WHERE post_id=$the_post_id";

$update_comment_count=mysqli_query($connection,$query);
}
    else{
        echo  "<script>alert('input field cannot be empty') </script>";
    }



}

?>


                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                        <label for="comment">Your comment</label> 
                        <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

<?php


$query="SELECT * FROM  comments WHERE comment_post_id={$the_post_id}";
$query.=" AND  comment_status='approved' ";
$query .= " ORDER BY comment_id DESC"; // Corrected "DECS" to "DESC"
$select_comment_query=mysqli_query($connection,$query);
if(!$select_comment_query){
    die('QUERY FAILED'.mysqli_error($connection));
}
while($row=mysqli_fetch_array($select_comment_query)){
    $comment_date=$row['comment_date'];
    $comment_content=$row['comment_content'];
    $comment_author=$row['comment_author'];
    ?>
<!-- Comment -->
<div class="media">
<a class="pull-left" href="#">
<img class="media-object" src="http://placehold.it/64x64" alt="">
</a>
<div class="media-body">
<h4 class="media-heading"><?php echo $comment_author ?>
    <small><?php echo $comment_date?></small>
</h4>
<?php echo $comment_content ?>
</div>
</div>

<?php }  
?>
            <!-- Comment -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
   <?php  include "./include/sidebar.php" ?>
            
                <!-- Side Widget Well -->
            <?php include "./include/widget.php" ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "./include/footer.php"  ?>