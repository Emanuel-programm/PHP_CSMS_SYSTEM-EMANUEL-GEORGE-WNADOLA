<?php
if(isset($_GET['p_id'])){
$the_post_id=$_GET['p_id'];


}
$query="SELECT*FROM posts WHERE post_id=$the_post_id";
$select_posts_by_id=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_posts_by_id)){
$post_id=$row['post_id'];
$post_author=$row['post_author'];
$post_title=$row['post_title'];
$post_category_id=$row['post_category_id'];
$post_status=$row['post_status'];
$post_images=$row['post_image'];
$post_tags=$row['post_tags'];
$post_comment=$row['post_comment_count'];
$post_date=$row['post_date'];
$post_content=$row['post_content'];
}

if(isset($_POST['update_post'])){
  $post_title=$_POST['title'];
  $post_author=$_POST['Author'];
  // $post_category=$_POST['post_category_id'];
  $post_status=$_POST['post_status'];

  $post_image=$_FILES['image']['name'];
  $post_image_temp=$_FILES['image']['tmp_name'];
  $post_tags=$_POST['post_tags'];
  $post_content=$_POST['post_content'];

  move_uploaded_file($post_image_temp,"../images/$post_image");

  if(empty($post_image)){
    $query="SELECT * FROM posts WHERE post_id=$the_post_id";
    $select_image=mysqli_query($connection,$query);
    while($row=mysqli_fetch_array($select_image)){
      $post_image=$row['post_image'];
    }
  }
  
  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$post_title}', ";
  // $query .= "post_category_id = '{$post_category}', ";
  $query .= "post_date = NOW(), ";
  $query .= "post_author = '{$post_author}', ";
  $query .= "post_status = '{$post_status}', ";
  $query .= "post_tags = '{$post_tags}', ";
  $query .= "post_content = '{$post_content}', ";
  $query .= "post_image = '{$post_image}' ";
  $query .= "WHERE post_id = {$the_post_id}";
  

  $update_post=mysqli_query($connection,$query);
  confirmQuery($update_post); 



// echo "Hi";


}


?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
  <label for="title">Post Title </label>
  <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">  
</div>
<div class="form-group">
  <label for="title">Post Author </label>
  <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="Author">  
</div>
<div class="form-group">
 
<select name="post_category_id" id="post_category">
<?php
$query="SELECT * FROM categories";
$select_categories=mysqli_query($connection,$query);
// confirmQuery($select_categories);
while($row =mysqli_fetch_assoc($select_categories)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];

echo "

<option value='{$cat_id}'>{$cat_title}</option>
";
}
?>
</select> 
</div>
<div class="form-group">
  <label for="title">Post status </label>
  <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">  
</div>
<div class="form-group">
  <img width="100" src="../images/<?php echo $post_images?>" alt="this is image"> <br> <br>   
  <input type="file" name="image">
</div>
<div class="form-group">
  <label for="title">Post Tags </label>
<input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
</div>
<div class="form-group">
  <label for="title">Post Content </label>
  <textarea name="post_content" id="" cols="30" rows="5" class="form-control">
  <?php echo $post_content; ?>
</textarea>  
</div>
<!-- <div class="form-group">
  <label for="title">Post date</label>
  <input type="date" class="form-control" name="date">  
</div> -->
<div class="form-group">
  <input type="submit" class="btn btn-primary" value="update post" name="update_post">  
</div>

</form>
