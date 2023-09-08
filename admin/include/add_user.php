<?php
if(isset($_POST['create_user'])){
  //  $user_id=$_POST['user_id'];
   $user_firstname=$_POST['user_firstname'];
   $user_lastname=$_POST['user_lastname'];
   $user_role=$_POST['user_role'];

  //  $post_image=$_FILES['image']['name'];
  //  $post_image_temp=$_FILES['image']['tmp_name'];

   $user_name=$_POST['user_name'];
   $user_email=$_POST['user_email'];
   $user_passwor  =$_POST['user_password'];
  //  $post_date=date('d-m-y');
  //  $post_comment_count=4;
   
  //  move_uploaded_file($post_image_temp,"../images/$post_image");

$query="INSERT INTO users(user_firstname,user_lastname,user_name,user_email,user_role,user_password) ";
// $query.="VALUES ({$post_category},'{$post_title}','{$post_author}'now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}')";
$query.="VALUES ('{$user_firstname}','{$user_lastname}','{$user_name}','{$user_email}','{$user_role}','{$user_passwor}')";
$create_user_query=mysqli_query($connection,$query);
confirmQuery($create_user_query);

echo "User created:" ."". "<a class='alert-danger' href='user.php'>View users</a>";


}
?>
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
  <label for="title">Firstname </label>
  <input type="text" class="form-control" name="user_firstname">  
</div>
<div class="form-group">
  <label for="title">Lastname </label>
  <input type="text" class="form-control" name="user_lastname">  
</div>

<!-- <div class="form-group">
  <label for="title">User Image </label>
  <input type="file" class="form-control" name="">  
</div> -->
<div class="form-group">
  <label for="title">Username </label>
<input type="text" class="form-control" name="user_name">
</div>
<div class="form-group">
  <label for="title">Email</label>
 <input type="email" class="form-control" name="user_email">
</div>
<div class="form-group">
<select name="user_role" id="">
<option value="subscriber">Select Options</option>
<option value="admin">Admin</option>
<option value="subscriber">Subscriber</option>
</select>
</div>
<div class="form-group">
  <label for="title">Password</label>
 <input type="password"class="form-control" name="user_password">
</div>
<!-- <div class="form-group">
  <label for="title">Post date</label>
  <input type="date" class="form-control" name="date">  
</div> -->
<div class="form-group">
  <input type="submit" class="btn btn-primary" value="Add user" name="create_user">
</div>

</form>


 