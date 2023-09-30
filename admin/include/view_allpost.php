 <?php
if(isset($_POST['checkBoxArray'])){
    // for each loop
    foreach($_POST['checkBoxArray'] as $post_value_id ){
    // echo $checkBoxValue;

  $bulk_options=$_POST['bulk_options'];
switch($bulk_options){
    case 'published':

        $query="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id=$post_value_id";
        $update_to_publish_status=mysqli_query($connection,$query);
        break;
    case 'drafted':
            $query="UPDATE posts SET post_status='{$bulk_options}' WHERE post_id=$post_value_id";
            $update_to_publish_status=mysqli_query($connection,$query);
            break;
            case  'delete':
            $query="DELETE  FROM posts WHERE post_id=$post_value_id";
            $delete_query_sending=mysqli_query($connection,$query);
            // if(!$delete_query_sending){
            //     die("QUERY FAILED".mysqli_error($connection))
            // }
            confirmQuery($delete_query_sending);
            break;


            case 'clone':

    $query="SELECT*FROM posts WHERE post_id={$post_value_id}";
    $select_posts=mysqli_query($connection,$query);
    while($row=mysqli_fetch_assoc($select_posts)){
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
    $query="INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status )";
$query.="VALUES ({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_images}','{$post_content}','{ $post_tags}','{$post_status}')";
$copy_post_query=mysqli_query($connection,$query);
confirmQuery($copy_post_query);
break;
  }
}
}

?>

 <form  method="post">
 <table class="table table-bordered table-hover">
<div class="col-xs-4" id="bulkOptionsContainer">
<select class="form-control" name="bulk_options" id="">
<option value="">Select Options</option>
<option value="published">Publish</option>
<option value="drafted">Draft</option>   
<option value="delete">Delete</option>
<option value="clone">Clone</option>
</select>
</div>

<div class="col-xs-4">
    <input type="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
</div>

    <thead>
        <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Images</th>
        <th>Tags</th>
        <th>Content</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View</th>
        <th>EDIT</th>
        <th>DELETE</th>
        <th>Viewed</th>
        </tr>
</thead>
<tbody>
<?php
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page=1;
}
if($page=="" || $page==1){
    $page_1=0;
}
else{
    $page_1=($page*6)-6;
}



$page_query="SELECT * FROM posts";
$sending_query=mysqli_query($connection,$page_query);
$count=mysqli_num_rows($sending_query);
$count= ceil($count/6);



$query="SELECT*FROM posts ORDER BY post_id DESC LIMIT $page_1,6 ";
$select_posts=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($select_posts)){
$post_id=$row['post_id'];
$post_author=$row['post_author'];
$post_title=$row['post_title'];
$post_category_id=$row['post_category_id'];
$post_status=$row['post_status'];
$post_images=$row['post_image'];
$post_tags=$row['post_tags'];


$quuery="SELECT* FROM comments WHERE comment_post_id=$post_id";
$send_comment_count=mysqli_query($connection,$query);
$count_comment=mysqli_num_rows($send_comment_count);


$post_comment=$row['post_comment_count'];



$post_date=$row['post_date'];
$post_content=$row['post_content'];
$post_views_count=$row['post_views_count'];


echo"<tr>";

?>
<td><input class="selectAllBoxes" type="checkbox" name="checkBoxArray[]" value="<?php echo $post_id; ?>" ></td>
<?php
echo "<td>{$post_id}</td>";
echo "<td>{$post_author}</td>";
echo "<td>{$post_title}</td>";
$query="SELECT * FROM categories WHERE cat_id={$post_category_id}";
$select_categories_id=mysqli_query($connection,$query);
while($row =mysqli_fetch_assoc($select_categories_id)){
$cat_title=$row['cat_title'];
$cat_id=$row['cat_id'];

// $select_categories_id=mysqli_query($connection,$query);
// $row=mysqli_fetch_assoc($select_categories_id);
echo"<td>{$cat_title}</td>";
// echo $cat_title;
}

// while($row=mysqli_fetch_assoc($select_categories_id)){
//     $cat_id=$row['cat_id'];
//     $cat_title=$row['cat_title'];
//     echo"<td>$cat_title</td>";
// }
//php code for selecting the categories
echo "<td>{$post_status}</td>";
echo " <td><img width='100' src='../images/{$post_images}'></img></td>";
echo "<td>{$post_tags}</td>";
echo "<td>{$post_content}</td>";

$query="SELECT * FROM comments WHERE comment_post_id=$post_id";
$send_comment_query=mysqli_query($connection,$query);
$row=mysqli_fetch_array($send_comment_query);
// echo print_r($send_comment_query);
if (mysqli_num_rows($send_comment_query) > 0) {
$comment_id=$row['comment_id'];

$count_comments=mysqli_num_rows($send_comment_query);
// echo "<td><a href='{$count_comments}'</a></td>";
echo "<td><a href=''>{$count_comments}</a></td>";
}
else{
    echo "<td>0</td>";  
}

echo "<td>{$post_date}</td>";
echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
echo "
<td><a  href='posts.php?source=edit_post&p_id={$post_id}'>EDIT</a></td>";
echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'>DELETE</a></td>";
echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</a></td>";
echo "</tr>";

}
?>  

</tbody>
</table>
</form>
<?php
if(isset($_GET['delete'])){
$the_post_id=$_GET['delete'];
$query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
$delete_query=mysqli_query($connection,$query);
header("location:posts.php");
}

if(isset($_GET['reset'])){
    $the_reset_id=$_GET['reset'];
    $reset_query ="UPDATE posts SET post_views_count=0 WHERE post_id=".mysqli_real_escape_string($connection,$_GET['reset'])."";
    $reset_query=mysqli_query($connection,$reset_query);

    if(!$reset_query){
    die("QUERY FAILED".mysqli_error($connection));
    }
    header("location:posts.php");
    }
?>

<ul class="pager">
<?php
for($i=1;$i<=$count;$i++){
if($page==$i){
    echo "<li><a class='active' href='posts.php?page={$i}'>{$i}</a></li>" ;   
}
else{
    echo "<li><a href='posts.php?page={$i}'>{$i}</a></li>" ;  
}


   
}

?>

</ul>
