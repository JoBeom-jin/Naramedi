<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
<?php 
	$title = $_REQUEST['title'];
	$seq = $_REQUEST['seq'];
 ?>
	<title><?php echo $title; ?></title>
</head>
<body>
	<?php 
	echo "<img src='hs_0".$seq.".jpg' alt='' style='width:100%'>";
	 ?>

</body>
</html>