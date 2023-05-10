<?php 
get_header();
/*************User Denied******************/
if(isset($_POST['Deny'])) {
 global $current_user;
     $user_email = $current_user->user_email;
     $user_subject = 'Sorry you are not eligible for the player membership';
$user_message = 'Sorry you are not eligible for the player membership';
$user_headers = array('Content-Type: text/html; charset=UTF-8');
     $email = 'support@dualnationals.com';
     $to = 'mail.exoticaitsolutions@gmail.com';
     
                   wp_mail($user_email, $user_subject, $user_message, $user_headers);


  
}
/*************User Approved******************/
if(isset($_POST['update'])) {
 
   global $current_user;
     $user_email = $current_user->user_email;
     $user_subject = 'congratulations you eligible for the player membership ';
      $user_message = 'Sorry you are not eligible for the player membership';
      $user_headers = array('Content-Type: text/html; charset=UTF-8');
     $email = 'support@dualnationals.com';
     $to = 'mail.exoticaitsolutions@gmail.com';
     
                   wp_mail($user_email, $user_subject, $user_message, $user_headers);
}
?>

<section class="approval_deny_sec">
	<div class="container">
		<div class="approval_denyform">
<?php /* Template Name: Approve Player */


if ( current_user_can( 'administrator' ) ) {

$emails = $_GET['email'];
$id = $_GET['id'];
echo base64_decode($emails);
global $wpdb;
if(isset($_POST['update'])) {
$player_details_table = $wpdb->prefix . 'player_details';
$query = "UPDATE $player_details_table SET status = 'approve' WHERE id = $id";
$wpdb->query($query);
}
if(isset($_POST['Deny'])) {
$player_details_table = $wpdb->prefix . 'player_details';
$query = "UPDATE $player_details_table SET status = 'Deny' WHERE id = $id";
$wpdb->query($query);
}
?>

			<form method="post">
				<input type="submit" class="approval" name="update" value="Approve">
				<input type="submit" class="deny" name="Deny" value="Deny">
			</form>


<?php 
}else{
	echo "you dont have access this page";
}
?>
		</div>
	</div>
</section>
<?php
get_footer();
 ?>
