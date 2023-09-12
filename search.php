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

if(isset($_POST['submit'])){
 $search=$_POST['search'];

 $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%'";  // looks weird but you can look it online
 $search_query=mysqli_query($connection,$query);

 if(!$search_query){
    die("query failed".mysqli_error($connection));  // die function kill everything 
 }
$count=mysqli_num_rows($search_query);

if($count==0){
    echo "<h1> NO RESULT</h1>";
}
else{
    while($row=mysqli_fetch_assoc($search_query)){
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
            by <a href="index.php"><?php echo $post_author; ?></a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
        <hr>
        <a href="post.php?p_id=<?php echo $post_id?>">
        <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
    </a>
        <hr>
        <p><?php echo $post_content; ?>.</p>
        <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
<?php }

}
}
?>
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