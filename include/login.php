<?php include "db.php";  ?> 
<?php session_start()  ?> 


<?php

if(isset($_POST['login'])){
   $username= $_POST['username'];
   $password= $_POST['password'];

   // cleaning the information preventing the sql injection
   $username=mysqli_real_escape_string($connection,$username);
   $password=mysqli_real_escape_string($connection,$password);

   // checking the column in the table user
   $query="SELECT * FROM users WHERE user_name='{$username}'";
   $select_user_query=mysqli_query($connection,$query);
   if(!$select_user_query){
    die("QUERY FAILED".mysqli_error($connection));
   }
   while($row=mysqli_fetch_array($select_user_query)){
     $db_user_d=$row["user_id"];
     $db_user_username=$row["user_name"];
     $db_user_password=$row["user_password"];
     $db_user_firstname=$row["user_firstname"];
     $db_user_lastname=$row["user_lastname"];
     $db_user_role=$row["user_role"];
    
   }                                                                                                                
   // check some validation
   if($username == $db_user_username && $password  == $db_user_password ){
    $_SESSION['username']=$db_user_username;
    $_SESSION['firstname']=$db_user_firstname;
    $_SESSION['lastname']=$db_user_lastname;
    $_SESSION['user_role']=$db_user_role;
    header("Location:../admin");
   }
   else{
    header("location:../index.php");
   }  
}



?>