
<?php
require_once('cn.php');
$sql = "select *from student";
$r = mysql_query($sql);

print '<table border="1">';
print '<tr><th>ID</th><th>Name</th><th>Email</th><th>Address</th><th>Course</th><th>CV</th><th>Image</th></tr>';

while($s = mysql_fetch_row($r))
{
	print '<tr>';
	print '<td>'.$s[0].'</td>';
	print '<td>'.$s[1].'</td>';
	print '<td>'.$s[2].'</td>';
	print '<td>'.$s[3].'</td>';
	print '<td>'.$s[4].'</td>';
	print '<td><a href="CVS/'.$s[0].".".$s[5].'">Download CV</a></td>';
	print '<td><a href="Images/'.$s[0].'.'.$s[6].'" target="_blank"><img src="Images/'.$s[0].'.'.$s[6].'" width="40px" height="40px"></a></td>';
	print '</tr>';
}

print '</table>';

?>