<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="robots" content="noindex,nofollow">
	<meta name="hansin medipia" content="hansin medipia">
	<title>::한신메디피아::건강검진:: 스크립트 페이지</title>
</head>

<body>
	<?if(is_string($msg) && strlen($msg) > 0):?>
	<script type="text/javascript">
		alert('<?=$msg?>');
	</script>

	<?endif;?>

	<?if($sact == 'PR'):?>
	<script type="text/javascript">
		parent.location.reload();
	</script>
	<?endif;?>
	
</body>
	
</html>