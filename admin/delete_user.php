<?php include("includes/header.php"); ?>

<?php if(!$session->is_signed_in()){redirect("login.php");}
// sents the user to a location that you assign ?>

<?php 


if(empty($_GET['id'])){

    redirect("users.php");

}


$user = User::find_by_id($_GET['id']);

if($user){

    $user->delete();

    redirect("users.php");

} else {

    redirect("users.php");

}


?>