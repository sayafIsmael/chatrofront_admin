<?php
include 'db.php';
if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  $query = "DELETE FROM users WHERE id = '".$id."'";
  mysqli_query($con, $query);
 }
}
?>