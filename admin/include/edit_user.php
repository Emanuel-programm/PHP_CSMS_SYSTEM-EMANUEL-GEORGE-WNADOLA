<?php

if(isset($_GET['update_user'])){
   $the_user_id=$_GET['update_user'];

   $query="SELECT*FROM users WHERE user_id=$the_user_id ";
   $select_users_query=mysqli_query($connection,$query);
   while($row=mysqli_fetch_assoc($select_users_query)){
   $user_id=$row['user_id'];
   $username=$row['user_name'];
   $user_password=$row['user_password'];
   $user_firstname=$row['user_firstname'];
   $user_lastname=$row['user_lastname'];
   $user_email=$row['user_email'];
   $user_image=$row['user_image'];
   $user_role=$row['user_role'];


   }


}
if(isset($_POST['Edit_user'])){
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
  // $query="UPDATE users SET user_firstname='$user_firstname',user_lastname='$user_lastname',user_role='$user_role',user_name='$user_name',user_email='$user_email',user_password='$user_password' WHERE user_id=$the_user_id";
  // $update_user_query=mysqli_query($connection,$query);


  $query = "UPDATE users SET "; 
  $query .= "user_firstname = '{$user_firstname}', ";
  $query .= "user_lastname = '{$user_lastname}', ";
  $query .= "user_role = '{$user_role}', ";
  $query .= "user_name = '{$user_name}', ";
  $query .= "user_email = '{$user_email}', ";
  $query .= "user_password = '{$user_password }' ";
  $query .= " WHERE user_id=$the_user_id";

  $update_user_query=mysqli_query($connection,$query);
  confirmQuery( $update_user_query);
  header("location:./user.php");


}
?>
<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
  <label for="title">Firstname </label>
  <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">  
</div>
<div class="form-group">
  <label for="title">Lastname </label>
  <input type="text" value="<?php echo $user_lastname?>"  class="form-control" name="user_lastname">  
</div>

<!-- <div class="form-group">
  <label for="title">User Image </label>
  <input type="file" class="form-control" name="">  
</div> -->
<div class="form-group">
  <label for="title">Username </label>
<input type="text" value="<?php echo $username ?>" class="form-control" name="user_name">
</div>
<div class="form-group">
  <label for="title">Email</label>
 <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
</div>
<div class="form-group">
<select name="user_role" id="">
<option value="subscriber"><?php echo $user_role?></option>
<?php
if($user_role=='admin'){
  echo "<option value='subscriber'>subscriber</option>";
}
else{
  echo "<option value='admin'>admin</option>";
}

?>

</select>
</div>
<div class="form-group">
  <label for="title">Password</label>
 <input type="password" value="<?php echo $user_password ?>"class="form-control" name="user_password">
</div>
<!-- <div class="form-group">
  <label for="title">Post date</label>
  <input type="date" class="form-control" name="date">  
</div> -->
<div class="form-group">
  <input type="submit" class="btn btn-primary" value="Update user" name="Edit_user">
</div>

</form>


 