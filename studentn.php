<?php
require_once('cn.php');
$name = "";
$email = "";
$address = "";
$course = "";
$cv = "";
$image = "";

$ecv = "";
$eimage = "";

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$course = $_POST['course'];
	$cv = $_FILES['flcv'];
	$image = $_FILES['flimage'];


	$err = 0;
	
	$cvex = explode(".", $cv["name"]);
	$imageex = explode(".", $image["name"]);
	
	$cvex = $cvex[count($cvex)-1];
	$imageex = $imageex[count($imageex)-1];
	
	if($cv['size'] == 0)
	{
		$err++;
		print "No CV Selected";
	}
	else if(!($cvex == "doc" or $cvex == "docx" or $cvex == "pdf"))
	{
		$err++;
		print "Invalid CV Formate";
	}
	if($image['size'] == 0)
	{
		$err++;
		print "No Image Selected";
	}
	else if(!($imageex == "jpg" or $imageex == "gif" or $imageex == "png"))
	{
		$err++;
		print "Invalid Image Formate";
	}
	
	
	if($err == 0)
	{
		$sql = "insert into student(name, email, address, course, cv, image)
				values('".$name."', '".$email."', '".$address."', ".$course.",'".$cvex."', '".$imageex."')";

		
		if(mysql_query($sql))
		{
			move_uploaded_file($image['tmp_name'], "Images/".mysql_insert_id().".".$imageex);
			move_uploaded_file($cv['tmp_name'], "CVS/".mysql_insert_id().".".$cvex);
			print "Saved";
			$name = "";
			$email = "";
			$address = "";
			$course = "";
			$cv = "";
			$image = "";
		}	
		else
		{
			print mysql_error();
		}
	}
	
}
?>

<form action="" method="post" enctype="multipart/form-data" name="form1">
  <label>Name <br>
  <input name="name" type="text" id="name">
  </label>
  <label><br>
  <br>
  Email <br>
  <input name="email" type="text" id="email">
  </label>  <label><br>
  <br>
  Address <br>
  <textarea name="address" id="address"></textarea>
  </label>  <label><br>
  <br>
  Course <br>
  <select name="course" id="course">
    <option value="0">Select</option>
    <?php
	$sql = "select * from course";
	$r = mysql_query($sql);
	while($s = mysql_fetch_row($r))
	{
		print '<option value="'.$s[0].'">'.$s[1].'</option>';
	}
	?>
  </select>
  </label>  <label><br>
  <br>
  Select CV <br>
  <input name="flcv" type="file" id="flcv">
  </label>  <label><br>
  <br>
  Select Image <br>
  <input name="flimage" type="file" id="flimage">
  </label>  <br>
  <br>
  <br>
  <label>
  <input name="submit" type="submit" id="submit" value="Submit">
  </label>
</form>
