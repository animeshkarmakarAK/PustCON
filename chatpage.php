<?php 
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");
?>
<link rel="stylesheet" type="text/css" href="./css/chatpage.css">


</script>

<div class="chat">
	
	<div class="friends">
		<h2>Friends</h2>

		<div class="friendsList">
		<?php 
       $friends = "select * from users";
       $sql = mysql_query($friends);
       if (mysql_num_rows($sql) > 0) {
       	while ( $arr = mysql_fetch_array($sql)) {
       		$friend = $arr['username'];
       		$activation = $arr['activated'];
       		?>

       				<button type="button" name="friend=btn"  
onclick="document.getElementById('demo').innerHTML = this.innerHTML">
<?php echo $friend; ?></button>
<?php if ($activation == 1) {
	echo "active now";
}
	else{
		echo "not active now";
	}
?>
<br>
       		<?php 
       	}
       }

		 ?>
		</div>
	</div>
	<div class="messaging" clear>
		<h2><i class="fa fa-message"></i>messaging "      "  In chat : <p id="demo"></p></h2>
		<div class="chat">
			<div class="sender">HI how are you?</div>
			<div class="receiver">Yes fine !
			</div>
		<div class="writting-box">
			<form action="" enctype="multidata/from-data" method="post">
				<input type="text" name="chat-message" required >
				<input type="submit"  name="submit-chat" value="send">
			</form>
		</div>
		</div>
	
	</div>
	<div class="setting " clear>
		<h2>settings</h2>
		<div class="settings_comp">
			<h3>set a nickname</h3>
			<h2>change color</h2>
			
		</div>
	</div>
</div>