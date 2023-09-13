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
            confirmQuery( $delete_query_sending);
            break;

  }
}
}

?>

 <form action="" method="post">
 <table class="table table-bordered table-hover">
<div class="col-xs-4" id="bulkOptionsContainer">
<select class="form-control" name="bulk_options" id="">
<option value="">Select Options</option>
<option value="published">Publish</option>
<option value="drafted">Draft</option>   
<option value="delete">Delete</option>
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
        </tr>
</thead>
<tbody>
<?php
$query="SELECT*FROM posts";
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
echo "<td>{$post_comment}</td>";
echo "<td>{$post_date}</td>";
echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
echo "
<td><a  href='posts.php?source=edit_post&p_id={$post_id}'>EDIT</a></td>";
echo "<td><a href='posts.php?delete={$post_id}'>DELETE</a></td>";
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
?>
