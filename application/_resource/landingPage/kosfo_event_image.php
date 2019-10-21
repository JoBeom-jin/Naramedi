<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
<?php 
	$hos = $_REQUEST['hos'];
	$price = $_REQUEST['price'];
 ?>
	<title><?php echo $price."만원 패키지"; ?></title>
</head>
<body>
	<?php 
	echo "<img src='kosfo/detail/".$hos."_".$price.".png' alt='' style='width:100%'>";
	 ?>

</body>
</html>