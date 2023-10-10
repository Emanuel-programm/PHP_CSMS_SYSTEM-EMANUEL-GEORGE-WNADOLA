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
              $the_post_author=$_GET['author'];
              
            }

            
            $select="SELECT * FROM  posts WHERE post_user='{$the_post_author}'";
            $query=mysqli_query($connection,$select);

        while($row=mysqli_fetch_assoc($query)){
           $post_title=$row['post_title'];
           $post_author=$row['post_user'];
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
                 All post by <?php echo $post_author; ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image?>" alt="">
                <hr>
                <p><?php echo $post_content; ?>.</p>

                <hr>
<?php }?>


            <!-- Comment -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
   <?php  include "./include/sidebar.php" ?>
            
                <!-- Side Widget Well -->
            <?php include "./include/widget.php" ?>

            </div>

        </div>
        <!-- /.row -->

      

        <!-- Footer -->
        <?php include "./include/footer.php"  ?>