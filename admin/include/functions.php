<?php

function user_online(){
    //catching every user session
    
    if(isset($_GET['onlineusers'])){

    global $connection;
    
    if(!$connection){
        session_start();
        include ("../include/db.php");
    
        $session=session_id();
    
        $time=time();
        
        $time_out_in_second=60;
        
        $time_out=$time-$time_out_in_second;
        
        $query="SELECT * FROM user_online WHERE session='$session'";
        $send_query=mysqli_query($connection,$query);
        
        $count=mysqli_num_rows($send_query);
        
        if($count==null){
        mysqli_query($connection,"INSERT INTO user_online(session,time) VALUES('$session','$time')");
        }
        else{
          mysqli_query($connection,"UPDATE user_online SET time ='$time' WHERE session='$session'");
          
        }
        
        $user_online=mysqli_query($connection,"SELECT * FROM user_online WHERE time> '$time_out'");
         echo $count_user=mysqli_num_rows($user_online);
    
    }
        
    }// get request isset()
    }
    
    user_online();
    


function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED".mysqli_error($connection));
      }
}

function insert_category(){
// $query="SELECT * FROM categories";
// $select_categories=mysqli_query($connection,$query);
global $connection;
if(isset($_POST['submit'])){
    $cat_title=$_POST['cat_title'];
    if($cat_title==""|| empty($cat_title)){
        echo "This field should not be empty";
    }
    else{
        $query="INSERT INTO categories(cat_title)";
        $query.="VALUES ('{$cat_title}')";
        $create_category_query=mysqli_query($connection,$query);
        if(!$create_category_query){
            die('QUERY FAILED'.mysqli_error($connection));
        }
    }
    }

}

function  selecting_all_category(){
 global $connection;

 if(isset($_GET['pages'])){
    $pages=$_GET['pages'];   
  }
  else{
      $pages=1;
  }
  if($pages=="" || $pages==1){
      $page_1=0;
  }
  else{
  $page_1=($pages*3)-3;
  }
 $query="SELECT * FROM categories ORDER BY cat_id DESC LIMIT $page_1,3";
 $select_categories=mysqli_query($connection,$query);
 
 while($row =mysqli_fetch_assoc($select_categories)){
     $cat_title=$row['cat_title'];
     $cat_id=$row['cat_id'];
     echo "
     <tr>
 <td>{$cat_id}</td>
 <td>{$cat_title}</td>
 <td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'</a>DELETE</td>   
 <td><a class='btn btn-primary' href='categories.php?update={$cat_id}'</a>UPDATE</td>
 </tr> 
 ";
 // categories.php?detete={$cat_id}'
 }

}


function delete_category(){
global $connection; 
if(isset($_GET['delete'])){
$the_cat_id=$_GET['delete'];
$query="DELETE FROM categories WHERE cat_id='{$the_cat_id}'";
$delete_query=mysqli_query($connection,$query);
header("location:categories.php");
}

}

?>