<?if($sact == 'insertOk' && is_numeric($ei_seq)):?>
<script type="text/javascript">
	parent.check_event('<?=$ei_seq?>');
	alert('<?=$ei_name?>이벤트가 찜하기 되었습니다.');
</script>
<?endif;?>


<?if($sact == 'updateOk' && is_numeric($ei_seq)):?>
<script type="text/javascript">
	parent.cancel_event('<?=$ei_seq?>');
	alert('<?=$ei_name?>이벤트 찜하기가 취소 되었습니다.');
</script>
<?endif;?>