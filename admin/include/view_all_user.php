
<table class="table table-bordered table-hover">
    <thead>
        <tr>
        <th>id</th>
        <th>username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Role</th>
        </tr>
</thead>
<tbody>
<?php
if(isset($_GET['pages'])){
$page=$_GET['pages'];

}
else{
    $page=1;
}
if($page=="" || $page==1){
    $page_1=0;
}
else{
    $page_1=($page*3)-3;
}



$select_user_count="SELECT*FROM users";
$sending_query=mysqli_query($connection,$select_user_count);
$count=mysqli_num_rows($sending_query);
$count=ceil($count/3);



$query="SELECT*FROM users ORDER BY user_id DESC LIMIT $page_1,3";
$select_users=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_users)){
$user_id=$row['user_id'];
$username=$row['user_name'];
$user_password=$row['user_password'];
$user_firstname=$row['user_firstname'];
$user_lastname=$row['user_lastname'];
$user_email=$row['user_email'];
$user_image=$row['user_image'];
$user_role=$row['user_role'];

echo"<tr>";
echo "<td>$user_id</td>";
echo "<td>$username</td>";
echo "<td>$user_firstname</td>";
echo "<td>$user_lastname</td>";
// $query="SELECT * FROM categories WHERE cat_id={$post_category_id}";
// $select_categories_id=mysqli_query($connection,$query);
// while($row =mysqli_fetch_assoc($select_categories_id)){
// $cat_title=$row['cat_title'];
// $cat_id=$row['cat_id'];

// echo"<td>{$cat_title}</td>";


//php code for selecting the categories
echo "<td>$user_email</td>";
echo "<td>$user_role</td>";


// $quey_post="SELECT * FROM posts WHERE post_id=$comment_post_id ";
// $select_post_id_query=mysqli_query($connection,$quey_post);

// while($row=mysqli_fetch_assoc($select_post_id_query)){
// $post_id=$row['post_id'];
// $post_title=$row['post_title'];

// echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
// }


echo "
<td><a  href='user.php?change_to_admin=$user_id'>Admin</a></td>";
echo "<td><a href='user.php?change_to_sub=$user_id'>Subscriber</a></td>";
echo "<td><a href='user.php?source=edit_user&update_user=$user_id'>Edit</a></td>";
echo "<td><a href='user.php?delete=$user_id'>DELETE</a></td>";
echo "</tr>";
}
?> 

</tbody>
</table>
<?php

// lets approve the comments
if(isset($_GET['change_to_admin'])){
    $the_user_id=$_GET['change_to_admin'];
    $query = "UPDATE users SET user_role='admin' WHERE user_id=$the_user_id";
    $change_admin_query=mysqli_query($connection,$query);
    header("location:user.php");
    }


// lets unapprove the comments
if(isset($_GET['change_to_sub'])){
    $the_user_id=$_GET['change_to_sub'];
    $query = "UPDATE users SET user_role='subscriber' WHERE user_id=$the_user_id";
    $change_user_query=mysqli_query($connection,$query);
    header("location:user.php");
    }

// lets delete the comments

if(isset($_GET['delete'])){
$the_user_id=$_GET['delete'];
$query = "DELETE FROM users WHERE user_id={$the_user_id}";
$delete_query=mysqli_query($connection,$query);
header("location:user.php");
}
?>

<ul class="pager">
<?php
for($i=1;$i<=$count;$i++){

    if($page==$i){
    echo "
    <li> <a class='active' href='user.php?pages={$i}'>{$i}</a>
    </li> ";
    }
    else{
        echo  "<li> <a ' href='user.php?pages={$i}'>{$i}</a>
        </li> ";  
    }

}
?>

</ul>


