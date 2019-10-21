<?
if( $_SERVER['REMOTE_ADDR'] == '121.152.133.153' ) echo $_SERVER['REMOTE_ADDR'];
?>
<div id="closed-shop-list">
	<h2 class="title">폐쇄몰 관리</h2>

	<h3 class="title">폐쇄몰 목록</h3>

	<div class="btn-area-left">
		<a href="<?=$menu_url?>/insertShop" class="btn btn-primary" onclick="window.open(this.href,'insert_form','width=600, height=450'); return false;">신규폐쇄몰 등록</a>
	</div>
	<table class="table table-list" summary="폐쇄몰 목록">
		<caption>폐쇄몰 목록</caption>
		<thead>
			<tr>
				<th>No</th>
				<th>생성일</th>
				<th>업체명</th>
				<th>URI</th>
				<th>링크확인</th>
				<th>예약신청</th>
				<th>누적차감캐쉬</th>
				<th>옵션</th>
			</tr>
		</thead>
		<tbody class="tcenter-all">
			<?if(isArray_($list)):?>
			<?foreach($list as $k=> $v):?>
			<tr>
				<td><?=$paging->getPageNum($k)?></td>
				<td><?=date('Y.m.d', $v['cs_ctime'])?></td>
				<td>
					<a href="<?=$menu_url?>/updateShop?seq=<?=$v['cs_seq']?>" onclick="window.open(this.href,'insert_form','width=600, height=450'); return false;"><?=$v['cs_name']?></a>
				</td>
				<td>
					https://okaymedi.com/index.php?closed_seq=<?=$v['cs_seq']?>
				</td>
				<td>
					<a href="/index.php?closed_seq=<?=$v['cs_seq']?>" class="btn btn-default" target="_blank">바로가기</a>
				</td>
				<td>
					준비중
				</td>
				<td>
					준비중
				</td>
				<td>
					<a href="<?=$menu_url?>/deleteShop?seq=<?=$v['cs_seq']?>" target="formReceiver" onclick="return confirm('삭제된 폐쇄몰은 복구하실 수 없습니다. 정말로 삭제하시겠습니까?');" class="btn btn-danger">삭제</a>
				</td>
			</tr>
			<?endforeach;?>
			<?else:?>
			<tr>
				<td colspan="7">※ 등록된 폐쇄몰이 없습니다.</td>
			</tr>
			<?endif;?>
		</tbody>
	</table>
</div>
