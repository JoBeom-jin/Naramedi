<?
if($sact && is_string($sact)){
	$sact = array($sact);
}

if(!is_array($sact)) $sact = array();
?>
<script type="text/javascript">
<?if(is_string($msg)):?>

	alert('<?=$msg?>');

<?endif;?>

<?if(in_array('PR', $sact)):?>
parent.document.location.reload();
<?endif;?>

<?if(in_array('POR', $sact)):?>
parent.opener.document.location.reload();
<?endif;?>

<?if(in_array('SCLZ', $sact)):?>
self.close();
<?endif;?>

<?if(in_array('PCLZ', $sact)):?>
parent.close();
<?endif;?>

<?if(in_array('GOTO', $sact)):?>
document.location.href='<?=$back_url?>';
<?endif;?>

<?if(in_array('PGOTO', $sact)):?>
parent.location.href='<?=$back_url?>';
<?endif;?>

<?if(in_array('BACK', $sact)):?>
history.back();
<?endif;?>

<?if(in_array('COMPLETE', $sact)):?>
fbq('track', 'CompleteRegistration');
<?endif;?>
</script>