<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("./inc/header.inc.php") ;
include("./inc/connection.php");
include("./inc/navsection.php");

$profile_user = "";
if (isset($_POST['prof-name-btn'])) {
	$profile_user = $_POST['prof-name-btn'];
}

function auth($name){
	if ($name = $_SESSION['username']) {
		return true;
	}
		else{
			return false;
		}
	
}

/*if (isset($_POST['prof-name-btn'])) {
	$_SESSION['username'] = $_POST['prof-name-btn'];
}*/

if (isset($_POST['group-member-name-btn'])) {
	$_SESSION['username'] = $_POST['group-member-name-btn'];
}

if (isset($_POST['search-result-btn'])) {
	$_SESSION['username'] = $_POST['search-result-btn'];
}



// profile picture setting in profile 
$image_src = "";

$q = "select name from profile_pic where username = '{$_SESSION['username']}'";
$res = mysql_query($q) or die(mysql_error());
if (mysql_num_rows($res)>0) {
	# code...
$row = mysql_fetch_array($res);
$image = $row['name'];
$image_src = "img/".$image;
}else $image_src = "img/default.png";


//profile picture setting for non-author



//...........
$q = "select * from profile_info where username = '{$_SESSION['username']}'";
$r = mysql_query($q) or die(mysql_error());
if(mysql_num_rows($r)==0){
	$sql = "insert into profile_info (id,username) values(0,'{$_SESSION['username']}')";
	$res = mysql_query($sql)or die(mysql_error());
}


if (isset($_POST['bio-btn'])) {
	if (isset($_POST['bio'])) {
		$bio = $_POST['bio'];
		$q = "update profile_info set bio = '$bio' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}


if (isset($_POST['add_work-btn'])) {
	if (isset($_POST['add_work'])) {
		$work = $_POST['add_work'];
		$q = "update profile_info set work_history = '$work' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}


if (isset($_POST['add_university-btn'])) {
	if (isset($_POST['add_university'])) {
		$add_v = $_POST['add_university'];
		$q = "update profile_info set university = '$add_v' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}


if (isset($_POST['post_uni-btn'])) {
	if (isset($_POST['post_uni'])) {
		$p= $_POST['post_uni'];
		$q = "update profile_info set university_post = '$p' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}

if (isset($_POST['college-btn'])) {
	if (isset($_POST['college'])) {
		$c = $_POST['college'];
		$q = "update profile_info set college = '$c' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}

if (isset($_POST['high_school-btn'])) {
	if (isset($_POST['high_school'])) {
		$h = $_POST['high_school'];
		$q = "update profile_info set  school= '$h' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}

if (isset($_POST['skill-btn'])) {
	if (isset($_POST['skill']))
{
		$s = $_POST['skill'];
	    $q = "update profile_info set professional_sills = concat(COALESCE('$s',''),'-',COALESCE(professional_sills,'')) where username = '{$_SESSION['username']}'";

		$r = mysql_query($q) or die(mysql_error());
		
	}
}

if (isset($_POST['c_city-btn'])) {
	if (isset($_POST['c_city'])) {
		$city = $_POST['c_city'];
		$q = "update profile_info set  current_city= '$city' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}

if (isset($_POST['hometown-btn'])) {
	if (isset($_POST['hometown'])) {
		$h = $_POST['hometown'];
		$q = "update profile_info set hometown = '$h' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}

if (isset($_POST['mob-btn'])) {
	if (isset($_POST['mob'])) {
		$m = $_POST['mob'];
		$q = "update profile_info set mobile = '$m' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}


if (isset($_POST['web-btn'])) {
	if (isset($_POST['web'])) {
		$w = $_POST['web'];
		$q = "update profile_info set website = '$w' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}
if (isset($_POST['email-btn'])) {
	if (isset($_POST['email'])) {
		$e = $_POST['email'];
		$q = "update profile_info set email = '$e' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}
if (isset($_POST['bd-btn'])) {
	if (isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year'])) {
		$bd = $_POST['day'].$_POST['month'].$_POST['year'];
		$q = "update profile_info set birthday = '$bd' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
	}
}
if (isset($_POST['gen-btn'])) {
	if (isset($_POST['gen'])) {
		$gn = $_POST['gen'];
		$q = "update profile_info set gender = '$gn' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
		if($r)
			header("Location:profile.php#ii");
	}
}
if (isset($_POST['ii-btn'])) {
	if (isset($_POST['ii'])) {
		$ii = $_POST['ii'];
		$q = "update profile_info set interested_in = '$ii' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
		if($r)
			header("Location:profile.php#ii");
	}
}
if (isset($_POST['lang-btn'])) {
	if (isset($_POST['lang'])) {
		$lang = $_POST['lang'];
		$q = "update profile_info set languages = '$lang' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
		if($r)
			header("Location:profile.php#ii");
	}
}
if (isset($_POST['r_v-btn'])) {
	if (isset($_POST['r_v'])) {
		$r_v = $_POST['r_v'];
		$q = "update profile_info set religious_view = '$r_v' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
		if($r)
			header("Location:profile.php#ii");
	}
}
if (isset($_POST['pv-btn'])) {
	if (isset($_POST['pv'])) {
		$pv = $_POST['pv'];
		$q = "update profile_info set political_view = '$pv' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
		if($r)
			header("Location:profile.php#ii");
	}
}
if (isset($_POST['about-btn'])) {
	if (isset($_POST['about'])) {
		$a = $_POST['about'];
		$q = "update profile_info set about_yourself = '$a' where username = '{$_SESSION['username']}'";
		$r = mysql_query($q) or die(mysql_error());
		if ($r) {
			header("Location:profile.php#about_you");
			# code...
		}
	}
}

?>





<!DOCTYPE html>
<html>
<head>
	<title>profile page-main</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<div class="main clear">
<div class="profile_pic">
	<img src="<?php echo $image_src ;?>" width="150px " height="150px" >
	<a href="upload_profile_pic.php">Edit profile picture</a>
</div>

<div class="username_showing">

	<?php 
         $q = "select * from users where username = '{$_SESSION['username']}'";
         $r = mysql_query($q) or die(mysql_error());

         $row = mysql_fetch_array($r);
         $fname = $row['firstname'];
         $lname = $row['lastname'];
	 ?>
	<h2><?php echo $fname." ".$lname."(".$_SESSION['username'].")"; ?></h2>
</div>


<div class="bio_showing">
	<?php 
       $q = "select bio from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $bio = $row['bio'];
       //echo "$bio";


	 ?>
	 <p style="color:#000;"><?php echo $bio; ?></p>
</div>

<div class="bio">
	<a href="profile_bio.php">Edit Bio</a>
</div>


<div class="work">
	<h4>Work</h4>
	<a href="add_work.php">Add work</a>
</div>

<div class="in_block clear">
	<?php 
       $q = "select work_history from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $work = $row['work_history'];

        ?>
	 <p><?php echo $work; ?></p>
</div>

<div class="side_block">
	<a href="add_work.php">Edit</a>
</div>

<div class="education">
	<h4>Education</h4>
	<ul>
	<li></li><a href="add_university.php">Add university</a></li>
	<li><a href="add_university_post.php">Add university(postgraduate)</a></li>
    <li><a href="add_college.php">Add College</a></li>
    <li><a href="add_high_school.php">Add High school</a></li>
</ul>
</div>


<div class="in_block clear">
	<?php 
       $q = "select university from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $versity = $row['university'];
         
         if ($versity !="") {
         	# code...
         
        ?>
	 <p><?php echo $versity."<br> university"; ?></p>
	 <?php } ?>
      
</div>

<div class="side_block">
	<a href="add_university.php">Edit</a>
</div>

<div class="in_block clear">
	<?php 
       $q = "select university_post from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $versity = $row['university_post'];
         
         if ($versity !="") {
         	# code...
         
        ?>
	 <p><?php echo $versity."<br>post graduate university"; ?></p>
	 <?php } ?>
      
</div>

<div class="side_block">
	<a href="add_university_post.php">Edit</a>
</div>


<div class="in_block clear">
	<?php 
       $q = "select college from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $coll = $row['college'];
         
         if ($coll !="") {
         	# code...
         
        ?>
	 <p><?php echo $coll."<br>H.S.C college"; ?></p>
	 <?php } ?>
      
</div>

<div class="side_block">
	<a href="add_college.php">Edit</a>
</div>


<div class="in_block clear">
	<?php 
       $q = "select school from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $versity = $row['school'];
         
         if ($versity !="") {
         	# code...
         
        ?>
	 <p><?php echo $versity."<br>S.S.C HIGH SCHOOL"; ?></p>
	 <?php } ?>
      
</div>

<div class="side_block">
	<a href="add_high_school.php">Edit</a>
</div>


<div class="prof_skill" id="prof_skill">
	<h4>Professional skills</h4>
	<a href="add_user_skill.php">Add your skills</a>
</div>

<div class="in_block clear">
	<?php 
       $q = "select professional_sills from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $ps = $row['professional_sills'];
         
         if ($ps !="") {
         	# code...
         
        ?>
	 <p><?php echo $ps; ?></p>
	 <?php } ?>

      
</div>
<div class="side_block">
	<a href="add_user_skill.php">Edit</a>
</div>


<div class="address">
	<h4>Places you've lived</h4>
	<p>Current city: <a href="add_current_city.php">Edit</a></p>
	<div class="side_block clear">
	<?php 
       $q = "select current_city from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $c = $row['current_city'];
         
         if ($c !="") {
         	# code...
         
        ?>
	 <p><?php echo $c;?></p>
	 <?php } ?>
      
</div>
	<p>Hometown: <a href="add_hometown.php">Edit</a></p>
		<div class="side_block clear">
	<?php 
       $q = "select hometown from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $h = $row['hometown'];
         
         if ($h !="") {
         	# code...
         
        ?>
	 <p><?php echo $h;?></p>
	 <?php } ?>
      
</div>
</div>



<div class="contact_info" id="contact_info">
	<h4>Contact info</h4>
	<p>Mobile: <a href="add_mobile_no.php">Edit</a></p>
		<div class="side_block clear">
	<?php 
       $q = "select mobile from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $m = $row['mobile'];
         
         if ($m !="") {
         	# code...
         
        ?>
	 <p><?php echo $m;?></p>
	 <?php } ?>
      
</div>
	<p>Websites: <a href="add_web_address.php">Edit</a></p>
		<div class="side_block clear">
	<?php 
       $q = "select website from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $w = $row['website'];
         
         if ($w !="") {
         	# code...
         
        ?>
	 <p><?php echo $w;?></p>
	 <?php } ?>
      
</div>
	<p>Email address: <a href="add_email_address.php">Edit</a></p>
		<div class="side_block clear">
	<?php 
       $q = "select email from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $e = $row['email'];
         
         if ($e !="") {
         	# code...
         
        ?>
	 <p><?php echo $e;?></p>
	 <?php } ?>
      
</div>
</div>

<div class="basic_info" id="basic_info">
	<h4>Basic info</h4>
	<p>Birthday: <a href="add_birthday.php">Edit</a></p>

		<div class="side_block clear">
	<?php 
       $q = "select birthday from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $bd = $row['birthday'];
         
         if ($bd !="") {
         	# code...
         
        ?>
	 <p><?php echo $bd;?></p>
	 <?php } ?>
      
</div>
	<p>Gender: <a href="add_gender.php">Edit</a></p>

		<div class="side_block clear">
	<?php 
       $q = "select gender from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $g = $row['gender'];
         
         if ($g !="") {
         	# code...
         
        ?>
	 <p><?php echo $g;?></p>
	 <?php } ?>
      
</div>
	<p id="ii">Interested in: <a href="ii.php">Edit</a></p>

		<div class="side_block clear">
	<?php 
       $q = "select interested_in from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $ii = $row['interested_in'];
         
         if ($ii !="") {
         	# code...
         
        ?>
	 <p><?php echo $ii;?></p>
	 <?php } ?>
      
</div>
	<p>Languages: <a href="add_languages.php">Edit</a></p>

		<div class="side_block clear">
	<?php 
       $q = "select languages from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $l = $row['languages'];
         
         if ($l !="") {
         	# code...
         
        ?>
	 <p><?php echo $l;?></p>
	 <?php } ?>
      
</div>
	<p>Religious view: <a href="add_religious_view">Edit</a></p>

		<div class="side_block clear">
	<?php 
       $q = "select religious_view from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $r = $row['religious_view'];
         
         if ($r !="") {
         	# code...
         
        ?>
	 <p><?php echo $r;?></p>
	 <?php } ?>
      
</div>
	<p>Political views: <a href="add_political_view">Edit</a></p>

		<div class="side_block clear">
	<?php 
       $q = "select political_view from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $pv = $row['political_view'];
         
         if ($pv !="") {
         	# code...
         
        ?>
	 <p><?php echo $pv;?></p>
	 <?php } ?>
      
</div>
	
</div>

<div class = "about_you" id="about_you">
	<h4>About you<a href="add_about_yourself.php">Edit</a></h4>

		<div class="in_block clear">
	<?php 
       $q = "select about_yourself from profile_info where username = '{$_SESSION['username']}'";

       $res = mysql_query($q)or die(mysql_error());
       $row = mysql_fetch_array($res);
       $about = $row['about_yourself'];
         
         if ($about !="") {
         	# code...
         
        ?>
	 <p><?php echo $about;?></p>
	 <?php } ?>
      
</div>
</div>
<div class="footer">
	<h2>PustCON</h2>
</div>
</div>
</body>
</html>