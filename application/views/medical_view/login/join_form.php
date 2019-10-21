<style>
#page-title{
  padding:0;
  font-size: 25px !important;
  line-height: 0px !important;
  letter-spacing: -2px;
}
.sns_img{
	margin: 0 10px;
}
.join-input{
	padding-top: 30px;
	height: 120px;
	width: 100%;
	border-bottom: 1px black dotted;
}
.join-input:last-child{
	border-bottom: none;
}
.join-input label{
	float: left;
	margin: 15px;
	width: 100px;
	letter-spacing: -1px;
}
.join-input input{
	/* float: left; */
	height: 50px !important;
	width: 60%;
}
.join-input .bootstrap-select{
	float: left;
	height: 50px !important;
	width: 160px !important;
	outline: 1px #c8c8c8 solid;
}
.join-input .bootstrap-select button{
	height: 100% !important;
}
.join_button{
    border: none;
    width: 144px;
    height: 47px;
	font-size: 16px;
	margin: 10px;
}
.fin{
	background-color: #1e67c6;
	color: white;
}
.cancel{
	background-color: white;
	color: #535353;
	outline: 1px #c8c8c8 solid;
}
</style>
<section class="hero-image" style="height: 617px !important;">
	<div class="background" style="background:url(/resource/images/medical/login/join_top.png) center;">
	</div>
</section>

<section>
	<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
		<div style="border:1px solid #cdcdcd; background-color: #f3f3f3; width: 1056px; height: 1700px; position: absolute; top: -240px; left: calc(100vw/2 - 528px); padding: 50px 100px;">

			<div class="at-icon-box-text" style="height: 50px;">
					<h1 id="page-title">SNS 간편 회원가입</h1>
			</div>
			<div style="text-align: center; margin-top: 30px;">
				<a href="<?=$naver_auth_url?>" id="naver_login" target="_blank" title="새창">
					<img class="sns_img" src="/resource/images/medical/login/join_sns_naver.png">
				</a>
				<a href="/index.php/medical/contents/login_login/loginBySNS?method=facebook" id="facbook_login">
					<img class="sns_img" src="/resource/images/medical/login/join_sns_face.png">
				</a>
			</div>
			

			<div class="at-icon-box-text" style="height: 50px; margin-top: 50px;">
					<h1 id="page-title">회원가입</h1>
			</div>
			<div style="margin-top: 30px;">
				<textarea name="" id="" style="width: 100%; height: 230px; resize: none" readonly >
OK검진 서비스 이용약관

OK검진 서비스 이용약관 OK검진 및 OK검진 관련 제반 서비스의 이용과 관련하여 필요한 사항을 규정합니다. OK검진의 회원약관은 다음과 같은 내용을 담고 있습니다.

제 1 조 (목적)

이 이용약관(이하 ’약관’이라 합니다.)은 주식회사 인피니티케어(이하 ’회사’라 합니다.)가 이용고객(이하 ’회원’이라 합니다.)간에 회사가 제공하는 “홈페이지(okaymedi.com)” 및 “어플리케이션 OK검진(오케이검진)”(이하에
서는 홈페이지 및 어플리케이션을 이하 ’서비스’라 합니다.)의 가입조건 및 이용에 관한 제반 사항과 기타 필요한 사항을 구체적으로 규정함을 목적으로 합니다.

제 2 조 (정의)

이 약관에서 사용하는 용어의 정의는 다음과 같습니다.

① “서비스”라 함은 구현되는 단말기(PC, TV, 휴대형단말기 등의 각종 유무선 장치를 포함)와 상관없이 “회원”이 이용할 수 있는 OK검진과 관련 제반 서비스를 의미합니다.
② “회원”이라 함은 회원등록 시 설정한 아이디(ID)로 사이트에 자유롭게 접속하여 사이트의 정보를 지속적으로 제공받을 수 있거나 사이트가 제공하는 서비스를 계속적으로 이용할 수 있는 자를 말합니다.
③ “아이디(ID)”라 함은 회원의 식별, 정보 제공 및 서비스 이용을 위하여 회원이 설정하고 회사가 승인하여 사이트에 등록된 전자우편주소를 말합니다.
④“비밀번호”라 함은 “회원”이 부여 받은 “아이디와 일치 되는 ”회원“임을 확인하고 비밀보호를 위해 ”회원“ 자신이 정한 문자 또는 숫자의 조합을 의미합니다.
⑤ “단말기”’라 함은 서비스에 접속하기 위해 회원이 이용하는 개인용 컴퓨터, PDA, 휴대전화, 태블릿PC 등의 전산장치를 말합니다.
⑥ “해지”라 함은 회사 또는 회원이 이용계약을 해약하는 것을 말합니다.
⑦ 게시물“이라 함은 ”회원“이 ”서비스“를 이용함에 있어 ”서비스상”에 게시한 부호ㆍ문자ㆍ음성ㆍ음향ㆍ화상ㆍ동영상 등의 정보 형태의 글, 사진, 동영상 및 각종 파일과 링크 등을 의미합니다.

제 3 조 (약관의 게시와 개정)

①“회사”는 이 약관의 내용을 “회원”이 쉽게 알 수 있도록 서비스 초기 화면에 게시합니다.
②“회사”는 “약관의 규제에 관한 법률”, “정보통신망 이용촉진 및 정보보호 등에 관한 법률(이하 ”정보통신망법“)” 등 관련 법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.
③“회사”가 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 제1항의 방식에 따라 그 개정약관의 적용일자 30일 전부터 적용일자 전일까지 공지합니다. 다만, 회원에게 불리한 약관의 개정의 경우에는
공지 외에 일정기간 서비스 내 전자우편, 전자쪽지, 로그인시 동의창 등의 전자적 수단을 통해 따로 명확히 통지하도록 합니다.
④회사가 전항에 따라 개정약관을 공지 또는 통지하면서 회원에게 30일 기간 내에 의사표시를 하지 않으면 의사표시가 표명된 것으로 본다는 뜻을 명확하게 공지 또는 통지하였음에도 회원이 명시적으로 거부의 의사표시를 하지 아
니한 경우 회원이 개정약관에 동의한 것으로 봅니다.
⑤회원이 개정약관의 적용에 동의하지 않는 경우 회사는 개정 약관의 내용을 적용할 수 없으며, 이 경우 회원은 이용계약을 해지할 수 있습니다. 다만, 기존 약관을 적용할 수 없는 특별한 사정이 있는 경우에는 회사는 이용계약
을 해지할 수 있습니다.

제 4 조 (약관의 해석)

① “회사”는 필요한 경우, 개별 서비스에 대해서는 별도의 이용약관 및 정책(이하 “서비스 별 안내 등”라 합니다)을 둘 수 있으며, 해당 내용이 이 약관과 상충할 경우에는 ”서비스 별 안내 등”이 우선하여 적용됩니다.

제 5 조 (이용계약 체결)

①이용계약은 “회원”이 되고자 하는 자(이하 “가입신청자”)가 약관의 내용에 대하여 동의를 한 다음 회원가입신청을 하고 “회사”가 이러한 신청에 대하여 승낙함으로써 체결됩니다.
②“회사”는 “가입신청자”의 신청에 대하여 “서비스” 이용을 승낙함을 원칙으로 합니다. 다만, “회사”는 다음 각 호에 해당하는 신청에 대하여는 승낙을 하지 않거나 사후에 이용계약을 해지할 수 있습니다.
1. 가입신청자가 이 약관에 의하여 이전에 회원자격을 상실한 적이 있는 경우, 단 “회사”의 회원 재가입 승낙을 얻은 경우에는 예외로 함.
2. 실명이 아니거나 타인의 명의를 이용한 경우
3. 허위의 정보를 기재하거나, “회사”가 제시하는 내용을 기재하지 않은 경우
4. 14세 미만 아동이 법정대리인(부모 등)의 동의를 얻지 아니한 경우
5. 이용자의 귀책사유로 인하여 승인이 불가능하거나 기타 규정한 제반 사항을 위반하며 신청하는 경우
③제1항에 따른 신청에 있어 “회사”는 “회원”의 종류에 따라 전문기관을 통한 실명확인 및 본인인증을 요청할 수 있습니다.
④“회사”는 서비스관련설비의 여유가 없거나, 기술상 또는 업무상 문제가 있는 경우에는 승낙을 유보할 수 있습니다.
⑤제2항과 제4항에 따라 회원가입신청의 승낙을 하지 아니하거나 유보한 경우, “회사”는 원칙적으로 이를 가입신청자에게 알리도록 합니다.
⑥이용계약의 성립 시기는 “회사”가 가입완료를 신청절차 상에서 표시한 시점으로 합니다.
⑦“회사”는 “회원”에 대해 회사정책에 따라 등급별로 구분하여 이용시간, 이용횟수, 서비스 메뉴 등을 세분하여 이용에 차등을 둘 수 있습니다.
⑧“회사”는 “회원”에 대하여 “영화 및 비디오물의 진흥에 관한 법률” 및 “청소년보호법”등에 따른 등급 및 연령 준수를 위해 이용제한이나 등급별 제한을 할 수 있습니다.

제 6 조 (회원정보의 변경)

①“회원”은 개인정보관리화면을 통하여 언제든지 본인의 개인정보를 열람하고 수정할 수 있습니다. 다만, 서비스 관리를 위해 필요한 실명, 아이디 등은 수정이 불가능합니다.
②“회원”은 회원가입신청 시 기재한 사항이 변경되었을 경우 온라인으로 수정을 하거나 전자우편 기타 방법으로 “회사”에 대하여 그 변경사항을 알려야 합니다.
③제2항의 변경사항을 “회사”에 알리지 않아 발생한 불이익에 대하여 “회사”는 책임지지 않습니다.

제 7 조 (개인정보보호 의무)

“회사”는 “정보통신망법” 등 관계 법령이 정하는 바에 따라 “회원”의 개인정보를 보호하기 위해 노력합니다. 개인정보의 보호 및 사용에 대해서는 관련법 및 “회사”의 개인정보취급방침이 적용됩니다. 다만, “회사”의 공식 사이
트 이외의 링크된 사이트에서는 “회사”의 개인정보취급방침이 적용되지 않습니다.

제 8 조 (“회원”의 “아이디” 및 “비밀번호”의 관리에 대한 의무)

① 회사는 회원에 대하여 약관에 정하는 바에 따라 이용자 ID를 이용자가 입력한 이메일로 부여합니다.
② 이용자ID는 원칙적으로 변경이 불가하며 부득이한 사유로 인하여 변경 하고자 하는 경우에는 해당 ID를 해지하고 재가입해야 합니다. “회원”의 “아이디”와 “비밀번호”에 관한 관리책임은 “회원”에게 있으며, 이를 제3자가 이
용하도록 하여서는 안 됩니다.
③“회사”는 “회원”의 “아이디”가 개인정보 유출 우려가 있거나, 반사회적 또는 미풍양속에 어긋나거나 “회사” 및 “회사”의 운영자로 오인할 우려가 있는 경우, 해당 “아이디”의 이용을 제한할 수 있습니다.
③“회원”은 “아이디” 및 “비밀번호”가 도용되거나 제3자가 사용하고 있음을 인지한 경우에는 이를 즉시 “회사”에 통지하고 “회사”의 안내에 따라야 합니다.
④제3항의 경우에 해당 “회원”이 “회사”에 그 사실을 통지하지 않거나, 통지한 경우에도 “회사”의 안내에 따르지 않아 발생한 불이익에 대하여 “회사”는 책임지지 않습니다.

제 9 조 (“회원”에 대한 통지)

①“회사”가 “회원”에 대한 통지를 하는 경우 이 약관에 별도 규정이 없는 한 서비스 내 전자우편주소, SMS 등으로 할 수 있습니다.
②“회사”는 “회원” 전체에 대한 통지의 경우 7일 이상 “회사”의 게시판에 게시함으로써 제1항의 통지에 갈음할 수 있습니다.

제 10 조 (“회사”의 의무)

①“회사”는 관련법과 이 약관이 금지하거나 미풍양속에 반하는 행위를 하지 않으며, 계속적이고 안정적으로 “서비스”를 제공하기 위하여 최선을 다하여 노력합니다.
②“회사”는 “회원”이 안전하게 “서비스”를 이용할 수 있도록 개인정보(신용정보 포함)보호를 위해 보안시스템을 갖추어야 하며 개인정보취급방침을 공시하고 준수합니다.
③“회사”는 서비스이용과 관련하여 발생하는 이용자의 불만 또는 피해구제요청을 적절하게 처리할 수 있도록 필요한 인력 및 시스템을 구비합니다.
④“회사”는 서비스이용과 관련하여 “회원”으로부터 제기된 의견이나 불만이 정당하다고 인정할 경우에는 이를 처리하여야 합니다. “회원”이 제기한 의견이나 불만사항에 대해서는 게시판을 활용하거나 전자우편 등을 통하여 “회원
”에게 처리과정 및 결과를 전달합니다.

제 11 조 (“회원”의 의무)

①“회원”은 다음 행위를 하여서는 안 됩니다.
1.신청 또는 변경 시 허위내용의 등록
2.타인의 정보도용
3.“회사”가 게시한 정보의 변경
4.“회사”가 정한 정보 이외의 정보(컴퓨터 프로그램 등) 등의 송신 또는 게시
5.“회사”와 기타 제3자의 저작권 등 지적재산권에 대한 침해
6.“회사” 및 기타 제3자의 명예를 손상시키거나 업무를 방해하는 행위
7.외설 또는 폭력적인 메시지, 화상, 음성, 기타 공서양속에 반하는 정보를 “서비스”에 공개 또는 게시하는 행위
8.회사의 동의 없이 영리를 목적으로 “서비스”를 사용하는 행위
9.기타 불법적이거나 부당한 행위
②“회원”은 관계법, 이 약관의 규정, 이용안내 및 “서비스”와 관련하여 공지한 주의사항, “회사”가 통지하는 사항 등을 준수하여야 하며, 기타 “회사”의 업무에 방해되는 행위를 하여서는 안 됩니다.
또한, 회원은 연락처, 전자우편 주소 등 이용계약사항이 변경된 경우에 해당 절차를 거쳐 이를 회사에 즉시 알려야 합니다.

제 12 조 (“서비스”의 제공 등)

①회사는 회원에게 아래와 같은 서비스를 제공합니다.
1. 검색 서비스 (제휴 병원 및 검진 이벤트)
2. 혜택받기 서비스
3. 상담하기 서비스
4. 게시판형 서비스
5. 건강검진 관련 컨텐츠 제공
6. 위치 관련 서비스
7. 찜하기 서비스
8. 기타 “회사”가 추가 개발하거나 다른 회사와의 제휴계약 등을 통해 “회원”에게 제공하는 일체의 서비스
②회사는 “서비스”를 일정범위로 분할하여 각 범위 별로 이용가능시간을 별도로 지정할 수 있습니다. 다만, 이러한 경우에는 그 내용을 사전에 공지합니다.
③“서비스”는 연중무휴, 1일 24시간 제공함을 원칙으로 합니다.
④“회사”는 컴퓨터 등 정보통신설비의 보수점검, 교체 및 고장, 통신두절 또는 운영상 상당한 이유가 있는 경우 “서비스”의 제공을 일시적으로 중단할 수 있습니다. 이 경우 “회사”는 제9조 “회원”에 대한 통지에 정한 방법으로
“회원”에게 통지합니다. 다만, “회사”가 사전에 통지할 수 없는 부득이한 사유가 있는 경우 사후에 통지할 수 있습니다.
⑤“회사”는 서비스의 제공에 필요한 경우 정기점검을 실시할 수 있으며, 정기점검시간은 서비스제공화면에 공지한 바에 따릅니다.

제 13 조 (“서비스”의 변경)

①“회사”는 상당한 이유가 있는 경우에 운영상, 기술상의 필요에 따라 제공하고 있는 전부 또는 일부 “서비스”를 변경할 수 있습니다.
②“서비스”의 내용, 이용방법, 이용시간에 대하여 변경이 있는 경우에는 변경사유, 변경될 서비스의 내용 및 제공일자 등은 그 변경 전에 해당 서비스 초기화면에 게시하여야 합니다.
③“회사”는 무료로 제공되는 서비스의 일부 또는 전부를 회사의 정책 및 운영의 필요상 수정, 중단, 변경할 수 있으며, 이에 대하여 관련법에 특별한 규정이 없는 한 “회원”에게 별도의 보상을 하지 않습니다.

제 14 조 (정보의 제공 및 광고의 게재)

①“회사”는 “회원”이 “서비스” 이용 중 필요하다고 인정되는 다양한 정보를 공지사항이나 전자우편 등의 방법으로 “회원”에게 제공할 수 있습니다. 다만, “회원”은 관련법에 따른 거래관련 정보 및 고객문의 등에 대한 답변 등을
제외하고는 언제든지 전자우편에 대해서 수신 거절을 할 수 있습니다.
②제1항의 정보를 전화 및 모사전송기기에 의하여 전송하려고 하는 경우에는 “회원”의 사전 동의를 받아서 전송합니다. 다만, “회원”의 거래관련 정보, 상담하기, 혜택받기 서비스로 인한 이메일 발송 및 문자, 통화와 관련된 내
용은 제외됩니다.
③“회사”는 “서비스”의 운영과 관련하여 서비스 화면, 홈페이지, 어플리케이션, 전자우편 등에 광고를 게재할 수 있습니다. 광고가 게재된 전자우편을 수신한 “회원”은 수신거절을 “회사”에게 할 수 있습니다.
④“이용자(회원, 비회원 포함)”는 회사가 제공하는 서비스와 관련하여 게시물 또는 기타 정보를 변경, 수정, 제한하는 등의 조치를 취하지 않습니다.

제 15 조 (“게시물”의 저작권)

①“회원”이 “서비스” 내에 게시한 “게시물”의 저작권은 해당 게시물의 저작자에게 귀속됩니다.
②“회원”이 “서비스” 내에 게시하는 “게시물”은 검색결과 내지 “서비스” 및 관련 프로모션 등에 노출될 수 있으며, 해당 노출을 위해 필요한 범위 내에서는 일부 수정, 복제, 편집되어 게시될 수 있습니다. 이 경우, 회사는 저
작권법 규정을 준수하며, “회원”은 언제든지 고객센터 또는 “서비스” 내 관리기능을 통해 해당 게시물에 대해 삭제, 검색결과 제외, 비공개 등의 조치를 취할 수 있습니다.
③“회사”는 제2항 이외의 방법으로 “회원”의 “게시물”을 이용하고자 하는 경우에는 전화, 팩스, 전자우편 등을 통해 사전에 “회원”의 동의를 얻어야 합니다.

제 16 조 (“게시물”의 관리)

①“회원”의 “게시물”이 “정보통신망법” 및 “저작권법”등 관련법에 위반되는 내용을 포함하는 경우, 권리자는 관련법이 정한 절차에 따라 해당 “게시물”의 게시중단 및 삭제 등을 요청할 수 있으며, “회사”는 관련법에 따라 조치
를 취하여야 합니다.
②“회사”는 전항에 따른 권리자의 요청이 없는 경우라도 아래 규정에서와 같이 권리침해가 인정될 만한 사유가 있거나 기타 회사 정책 및 관련법에 위반되는 경우에는 관련법에 따라 해당 “게시물”에 대해 임시조치 등을 취할 수
있습니다.
– 다른 회원 또는 제 3자에게 심한 모욕을 주거나 명예를 손상시키는 내용인 경우
– 공공질서 및 미풍양속에 위반되는 내용을 유포하거나 링크시키는 경우
– 불법복제 또는 해킹을 조장하는 내용인 경우
– 영리를 목적으로 하는 광고일 경우
– 범죄와 결부된다고 객관적으로 인정되는 내용일 경우
– 다른 이용자 또는 제 3자의 저작권 등 기타 권리를 침해하는 내용인 경우
– 사적인 정치적 판단이나 종교적 견해의 내용으로 회사가 서비스 성격에 부합하지 않는다고 판단하는 경우
– 타인의 건강을 위해 하는 검증되지 않은 허위정보로 판단될 경우
– 교육인 및 국내 교육기관 간의 비교 광고 성격으로 판단될 경우
– 의료인 및 국내 의료기관 간의 비교 광고 성격으로 판단될 경우
– 허가 받지 않은 의료행위 또는 의료행위를 위한 선전으로 게시물을 게재할 경우
– 회사에서 규정한 게시물 원칙에 어긋나거나, 게시판 성격에 부합하지 않는 경우
– 기타 관계법령에 위배된다고 판단되는 경우

③본 조에 따른 세부절차는 “정보통신망법” 및 “저작권법”이 규정한 범위 내에서 “회사”가 정한 “게시중단요청서비스”에 따릅니다.

제 17 조 (권리의 귀속)

①“서비스”에 대한 저작권 및 지적재산권은 “회사”에 귀속됩니다. 단, “회원”의 “게시물” 및 제휴계약에 따라 제공된 저작물 등은 제외합니다.
②“회사”는 서비스와 관련하여 “회원”에게 “회사”가 정한 이용조건에 따라 계정, “아이디”, 콘텐츠 등을 이용할 수 있는 이용권만을 부여하며, “회원”은 이를 양도, 판매, 담보제공 등의 처분행위를 할 수 없습니다.

제 18 조 (계약해제, 해지 등) ①“회원”은 언제든지 서비스초기화면의 고객센터 또는 내 정보 관리 메뉴 등을 통하여 이용계약 해지 신청을 할 수 있으며, “회사”는 관련법 등이 정하는 바에 따라 이를 즉시 처리하여야 합니다.
②“회원”이 계약을 해지할 경우, 관련법 및 개인정보취급방침에 따라 “회사”가 회원정보를 보유하는 경우를 제외하고는 해지 즉시 “회원”의 모든 데이터는 소멸됩니다.

제 19 조 (손해배상)

①회사와 이용자는 서비스 이용과 관련하여 고의 또는 과실로 상대방에게 손해를 끼친 경우에는 이를 배상하여야 합니다.
②단, 회사는 무료로 제공하는 서비스의 이용과 관련하여 개인정보보호정책에서 정하는 내용에 위반하지 않는 한 어떠한 손해도 책임을 지지 않습니다.

제 20 조 (이용제한 등)

①“회사”는 “회원”이 이 약관의 의무를 위반하거나 “서비스”의 정상적인 운영을 방해한 경우, 경고, 일시정지, 영구이용정지 등으로 “서비스” 이용을 단계적으로 제한할 수 있습니다.
②“회사”는 전항에도 불구하고, “주민등록법”을 위반한 명의도용 및 결제도용, “저작권법” 및 “컴퓨터프로그램보호법”을 위반한 불법프로그램의 제공 및 운영방해, “정보통신망법”을 위반한 불법통신 및 해킹, 악성프로그램의 배
포, 접속권한 초과행위 등과 같이 관련법을 위반한 경우에는 즉시 영구이용정지를 할 수 있습니다. 본 항에 따른 영구이용정지 시 “서비스” 이용을 통해 획득한 혜택 등도 모두 소멸되며, “회사”는 이에 대해 별도로 보상하지 않
습니다.
④“회사”는 본 조의 이용제한 범위 내에서 제한의 조건 및 세부내용은 이용제한정책 및 개별 서비스상의 운영정책에서 정하는 바에 의합니다.
⑤본 조에 따라 “서비스” 이용을 제한하거나 계약을 해지하는 경우에는 “회사”는 제9조 “회원”에 대한 통지에 따라 통지합니다.
⑥“회원”은 본 조에 따른 이용제한 등에 대해 “회사”가 정한 절차에 따라 이의신청을 할 수 있습니다. 이 때 이의가 정당하다고 “회사”가 인정하는 경우 “회사”는 즉시 “서비스”의 이용을 재개합니다.

제 21 조 (책임제한)

①“회사”는 컴퓨터등 정보통신설비의 보수점검,교체 및 고장, 통신의 두절  의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다.
②“회사”는 천재지변 또는 이에 준하는 불가항력으로 인하여 “서비스”를 제공할 수 없는 경우에는 “서비스” 제공에 관한 책임이 면제됩니다.
③“회사”는 “회원”의 귀책사유로 인한 “서비스” 이용의 장애에 대하여는 책임을 지지 않습니다.
④“회사”는 “회원”이 “서비스”와 관련하여 게재한 정보, 자료, 사실의 신뢰도, 정확성 등의 내용에 관하여는 책임을 지지 않습니다.
⑤“회사”는 “회원” 간 또는 “회원”과 제3자 상호간에 “서비스”를 매개로 하여 거래 등을 한 경우에는 책임이 면제됩니다.
⑥“회사”는 무료로 제공되는 서비스 이용과 관련하여 관련법에 특별한 규정이 없는 한 책임을 지지 않습니다.

제 22 조 (준거법 및 재판관할)

①“회사”와 “회원” 간 제기된 소송은 대한민국법을 준거법으로 합니다.
②“회사”와 “회원”간 발생한 분쟁에 관한 소송은 제소 당시의 “회원”의 주소에 의하고, 주소가 없는 경우 거소를 관할하는 지방법원의 전속관할로 합니다. 단, 제소 당시 “회원”의 주소 또는 거소가 명확하지 아니한 경우의 관할
법원은 민사소송법에 따라 정합니다.

부칙

1.이 약관은 2017년 9월 15일부터 적용됩니다.
2.회사는 약관을 변경하는 경우에 회원이 그 변경 여부, 변경된 사항의 시행시기와 변경된 내용을 언제든지 쉽게 알 수 있도록 지속적으로 ‘서비스’ 를 통하여 공개합니다. 이 경우에 변경된 내용은 변경 전과 후를 비교하여 공
개합니다.
				</textarea>
				<input type="checkbox" id="term_check" name="features1" value="1" required style="float: left;"><p>위 서비스 이용약관에 동의합니다.</p>
			</div>
			<div>
				<textarea name="" id="" style="width: 100%; height: 230px; resize: none" readonly >
개인정보 취급방침

(주)인피니티케어('http://www.okaymedi.com/'이하 'OK검진')은(는) 개인정보보호법에 따라 이용자의 개인정보 보호 및 권익을 보호하고 개인정보와 관련한 이용자의 고충을 원활하게 처리할 수 있도록 다음과 같은 처리방침을 두고 있습니다. 인피니티케어는 개인정보처리방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.

1. 개인정보의 처리 목적 

OK검진은 개인정보를 다음의 목적을 위해 처리합니다. 처리한 개인정보는 다음의 목적 이외의 용도로는 사용되지 않으며 이용 목적이 변경될 시에는 사전동의를 구할 예정입니다.

	

	가. 민원사무 처리

	민원인의 신원 확인, 민원사항 확인, 사실조사를 위한 연락·통지, 처리결과 통보 등을 목적으로 개인정보를 처리합니다.

	나. 재화 또는 서비스 제공
	서비스 제공 등을 목적으로 개인정보를 처리합니다.

	다. 마케팅 및 광고에의 활용
	이벤트 및 광고성 정보 제공 및 참여기회 제공 등을 목적으로 개인정보를 처리합니다.

2. 개인정보의 처리 및 보유 기간

OK검진은 법령에 따른 개인정보 보유·이용기간 또는 정보주체로부터 개인정보를 수집시에 동의받은 개인정보 보유·이용기간 내에서 개인정보를 처리·보유합니다.

	

① OK검진은 수집한 개인정보를 다음의 목적을 위해 활용합니다.

	- 건강검진 예약 서비스 이용에 따른 본인 확인, 예약 의사 확인, 연락처 확인, 고지사항 전달

	

② OK검진은 다음의 개인정보 항목을 처리하고 있습니다.
	- 필수항목 : 이름, 휴대전화 번호
	- 선택항목 : 성별, 이메일

	- 수집방법 : 홈페이지

	

③ 각각의 개인정보 처리 및 보유 기간은 다음과 같습니다.

	가. 계약 또는 청약철회 등에 관한 기록

		-보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률

		-보존 기간 : 5년

	나. 대금결제 및 재화 등의 공급에 관한 기록

		-보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률

		-보존 기간 : 5년

	다. 소비자의 불만 또는 분쟁처리에 관한 기록

		-보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률

		-보존 기간 : 3년


3. 정보주체의 권리, 의무 및 그 행사방법

① 정보주체는 OK검진에 대해 언제든지 다음 각 호의 개인정보 보호 관련 권리를 행사할 수 있습니다.
	- 개인정보 열람요구
	- 오류 등이 있을 경우 정정 요구
	- 삭제요구
	- 처리정지 요구

	

② 제1항에 따른 권리 행사는 OK검진에 대해 개인정보 보호법 시행규칙 별지 제8호 서식에 따라 서면, 전자우편, 모사전송(FAX) 등을 통하여 하실 수 있으며 인피니티케어는 이에 대해 지체 없이 조치하겠습니다.

	

③ 정보주체가 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 OK검진은 정정 또는 삭제를 완료할 때까지 당해 개인정보를 이용하거나 제공하지 않습니다.

	

④ 제1항에 따른 권리 행사는 정보주체의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 별지 제11호 서식에 따른 위임장을 제출하셔야 합니다.

4. 개인정보의 파기

OK검진은 원칙적으로 개인정보 처리목적이 달성된 경우에는 지체없이 해당 개인정보를 파기합니다. 파기의 절차, 기한 및 방법은 다음과 같습니다.

	

① 파기절차
이용자가 입력한 정보는 목적 달성 후 별도의 DB에 옮겨져(종이의 경우 별도의 서류) 내부 방침 및 기타 관련 법령에 따라 일정기간 저장된 후 혹은 즉시 파기됩니다. 이 때, DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 다른 목적으로 이용되지 않습니다.

	

② 파기기한
이용자의 개인정보는 개인정보의 보유기간이 경과된 경우에는 보유기간의 종료일로부터 5일 이내에, 개인정보의 처리 목적 달성, 해당 서비스의 폐지, 사업의 종료 등 그 개인정보가 불필요하게 되었을 때에는 개인정보의 처리가 불필요한 것으로 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.

	

5. 수집한 개인정보의 위탁

OK검진은 정보주체의 동의 없이 개인정보를 외부 업체에 위탁하지 않습니다. 향후 그러한 필요가 생길 경우 위탁 대상자와 위탁업무 내용에 대해 정보주체에 통지하고 필요한 경우 사전 동의를 받도록 하겠습니다.

	

6. 개인정보관련 의견수렴 및 침해, 불만처리에 관한 사항

① 회사는 개인정보보호와 관련하여 이용자들의 의견을 수렴하고 있으며 불만을 처리하기 위하여 모든 절차와 방법을 마련하고 있습니다. 이용자들은 하단에 명시한 개인정보 보호책임자 및 담당자” 항을 참고하여 전화나 메일을 통하여 불만사항을 신고할 수 있고, 회사는 이용자들의 신고사항에 대하여 신속하게 처리하여 답변해 드립니다.
② 또는 정부에서 설치하여 운영 중인 아래의 기관에 불만처리를 신청할 수 있습니다.
– 개인정보침해신고센터 (www.1336.or.kr / 1336)
– 정보보호마크인증위원회 (www.eprivacy.or.kr / 02–580–0533)
– 대검찰청 첨단범죄수사과 (www.spo.go.kr / 02–3480–2000)
– 경찰청 사이버테러대응센터 (www.ctrc.go.kr / 02–393–9112)

7. 정보 보호책임자 및 담당자
① OK검진은 개인정보 처리에 관한 업무를 총괄해서 책임지고, 개인정보 처리와 관련한 정보주체의 불만처리 및 피해구제 등을 위하여 아래와 같이 개인정보 보호책임자 및 실무담당자를 지정하고 있습니다.

개인정보 보호 담당자 과장 이장욱 1588-9419, one@infinitycare.co.kr

② 정보주체께서는 OK검진의 서비스를 이용하시면서 발생한 모든 개인정보 보호 관련 문의, 불만처리, 피해구제 등에 관한 사항을 개인정보 보호책임자 및 담당부서로 문의하실 수 있습니다. OK검진은 정보주체의 문의에 대해 지체 없이 답변 및 처리해드릴 것입니다.
	

8. 개인정보 처리방침 변경

① 이 개인정보처리방침은 시행일로부터 적용되며, 법령 및 방침에 따른 변경내용의 추가, 삭제 및 정정이 있는 경우에는 변경사항의 시행 7일 전부터 공지사항을 통하여 고지할 것입니다.

	

	

	본 방침은부터 2017년 4월 1일부터 시행됩니다.

	

	

	개인정보 제3자 제공동의

당사는 회원님께서 이용하신 이벤트 신청서비스를 원활하게 제공하기 위해

다음과 같이 제3자에게 개인정보를 제공 합니다.

개인정보를 제공받는 자 : 이벤트 제공 기관

개인정보 이용 목적 : 이벤트 예약, 접수, 상담, 해피콜 등

제공되는 개인정보 : 성명, 휴대폰번호, 상담가능한시간

개인정보 보유 및 이용기간 : 이벤트 제공 및 목적 달성 시 까지

	

개인정보 제공에 동의하지 않으실 수 있으며, 동의하지 않으시면 이벤트이용에 제한이 생길 수 있습니다.

제공되는 개인정보는 이벤트 서비스 이외의 용도로 사용되지 않습니다.
				
				</textarea>
				<input type="checkbox" id="privacy_check" name="features2" value="2" required style="float: left;"><p>위 개인정보 취급방침에 동의합니다.</p>
			</div>

			<div style="width: 100%; background-color: white; height: 800px; margin-top: 50px; padding: 15px 50px;">
					<div class="join-input">
						<label for="form-sign-in-email"><i><img src="/resource/images/medical/login/arrow_icon.png" alt="">&nbsp;</i>아이디</label>
						<input type="email" class="form-control" id="form-sign-in-email" name="id_email" placeholder="이메일 주소를 입력해주세요.">
					</div>
					<div class="join-input">
						<div style="width: 45%; float: left;">
							<label for="form-sign-in-password"><i><img src="/resource/images/medical/login/arrow_icon.png" alt="">&nbsp;</i>패스워드</label>
							<input type="password" class="form-control" id="form-sign-in-password" name="password" placeholder="비밀번호를 입력해주세요.">
						</div>
						<div style="width: 55%; float: right;">
							<label for="form-sign-in-password_chk"><i><img src="/resource/images/medical/login/arrow_icon.png" alt="">&nbsp;</i>패스워드 확인</label>
							<input type="password" class="form-control" id="form-sign-in-password_chk" name="password_chk" placeholder="비밀번호를 재입력해주세요.">
						</div>
					</div>
					<div class="join-input">
						<label for="form-sign-in-name"><i><img src="/resource/images/medical/login/arrow_icon.png" alt="">&nbsp;</i>이름</label>
						<input type="name" class="form-control" id="form-sign-in-name" name="name" placeholder="성함을 입력해주세요.">
					</div>
					<div class="join-input">
						<label for="form-sign-in-phone"><i><img src="/resource/images/medical/login/arrow_icon.png" alt="">&nbsp;</i>연락처</label>
						<input type="phone" class="form-control" id="form-sign-in-phone" name="phone" placeholder="핸드폰번호를 입력해주세요.( - 없이 입력)">
					</div>
					<div class="join-input">
						<label for="form-sign-in-date"><i><img src="/resource/images/medical/login/arrow_icon.png" alt="">&nbsp;</i>생년월일</label>
						<select name="year" class="form-control" id="form-sign-in-date" title="년도" data-size="10">
							<option value="">연도</option>
							<?$years = range(date('Y'), 1900)?>
							<?foreach($years as $v):?>
							<option value="<?=$v?>">
								<?=$v?>년</option>
							<?endforeach;?>
						</select>
						<select name="month" id="" title="월" data-size="10">
							<option value="">월</option>
							<?$months = range(1, 12);?>
							<?foreach($months as $v):?>
							<option value="<?=$v?>">
								<?=$v?>월</option>
							<?endforeach;?>						
						</select>
						<select name="day" id="" title="일" data-size="10">
							<option value="">일</option>
							<?$days = range(1, 31);?>
							<?foreach($days as $v):?>
							<option value="<?=$v?>">
								<?=$v?>일</option>
							<?endforeach;?>						
						</select>
					</div>
					<div class="join-input">
						<label for="form-sign-in-gender"><i><img src="/resource/images/medical/login/arrow_icon.png" alt="">&nbsp;</i>성별선택</label>
						<select name="md_gender" id="form-sign-in-gender">
							<option value="">성별선택</option>
							<option value="MAN">남성</option>
							<option value="WOMAN">여성</option>
						</select>

					</div>
			</div>

		</div>
		<div style="position: absolute; top: 1500px; left: calc(100vw/2 - 154px);">
			<button type="submit" class="join_button fin">확인</button>
			<button type="submit" class="join_button cancel">취소</button>
		</div>
	</form>

</section>

<div style="height: 1800px;">
	&nbsp;
</div>





<div id="user-join-form" style="display:none">
	<section class="container">
		<div class="block2 bg-white" style="border:1px solid #cdcdcd;">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3 join-form-area">
					<header>
						<h1 class="page-title">회원 가입</h1>
					</header>
					<hr>
					<div class="row">
						<form role="form" id="form-sign-in-account" method="post" action="<?=$menu_url?>/<?=$act?>Ok" target="formReceiver">
							<div class="form-group col-xs-12">
								<input type="email" class="form-control" id="form-sign-in-email" name="id_email" placeholder="아이디로 사용할 이메일 주소를 입력하세요."
								 required>
							</div><!-- /.form-group -->

							<div class="form-group col-xs-12">
								<input type="password" class="form-control" id="form-sign-in-password" name="password" placeholder="비밀번호를 입력하세요."
								 required>
							</div><!-- /.form-group -->
							<div class="form-group col-xs-12">
								<input type="password" class="form-control" id="form-sign-in-email" name="password_chk" placeholder="비밀번호 재입력."
								 required>
							</div><!-- /.form-group -->
							<div class="form-group col-xs-12">
								<input type="text" class="form-control" id="form-sign-in-password" name="name" placeholder="이름을 입력하세요."
								 required>
							</div><!-- /.form-group -->
							<div class="form-group col-xs-12">
								<input type="text" class="form-control" id="form-sign-in-email" name="phone" placeholder="휴대폰번호를 입력하세요.(-없이 입력)"
								 required>
							</div><!-- /.form-group -->
							<div class="form-group col-xs-12">
								<div class="row">
									<div class="col-xs-4">
										<select class="framed" name="year" title="생년" data-size="10">
											<option value="">생년</option>
											<?$years = range(date('Y'), 1900)?>
											<?foreach($years as $v):?>
											<option value="<?=$v?>">
												<?=$v?>년</option>
											<?endforeach;?>
										</select>

									</div>

									<div class="col-xs-4">
										<select class="framed" name="month" title="월" data-size="10">
											<option value="">월</option>
											<?$months = range(1, 12);?>
											<?foreach($months as $v):?>
											<option value="<?=$v?>">
												<?=$v?>월</option>
											<?endforeach;?>
										</select>
									</div>

									<div class="col-xs-4">
										<select class="framed" name="day" title="일" data-size="10">
											<option value="">일</option>
											<?$days = range(1, 31);?>
											<?foreach($days as $v):?>
											<option value="<?=$v?>">
												<?=$v?>일</option>
											<?endforeach;?>
										</select>
									</div>
									<span style="clear:both; display:block;"></span>
								</div>
							</div><!-- /.form-group -->


							<div class="form-group col-xs-12">
								<select class="framed" name="md_gender" title="성별선택">
									<option value="">성별선택</option>
									<option value="MAN">남성</option>
									<option value="WOMAN">여성</option>
								</select>
							</div>

							<div class="col-xs-12">
								<hr>
								<h4>약관 동의</h4>
								<ul class="list-unstyled checkboxes">
									<li>
										<div class="framed checkbox"><label><input type="checkbox" name="features1" value="1" style="margin-left:0px;">&nbsp;<a
												 href="/index.php/medical/contents/etc_terms?win=Y" onclick="window.open(this.href,'accept','height=810, width=810, scrollbars=1'); return false;"
												 target="_blank" title="새창">이용약관 동의(필수)</a></label></div>
									</li>
									<li>
										<div class="checkbox"><label><input type="checkbox" name="features2" value="2" style="margin-left:0px;">&nbsp;<a
												 href="/index.php/medical/contents/etc_personal?win=Y" onclick="window.open(this.href,'accept','height=810, width=810, scrollbars=1'); return false;"
												 target="_blank" title="새창">개인정보취급방침 동의(필수)</a></label></div>
									</li>
								</ul>
							</div>
							<hr>

							<div class="form-group col-xs-12">
								<button type="submit" style="width: 100%;" class="btn framed icon">회원가입 하기<i class="fa fa-angle-right" style="color:#e8a5a5"></i></button>
							</div>
						</form>
					</div>

					<header>
						<h1 class="page-title">SNS 가입</h1>
						<font color=gray>SNS계정으로 가입이 가능합니다. </font>
					</header>
					<hr>
					<div align="center">
						<a href="<?=$naver_auth_url?>" id="naver_login" target="_blank" title="새창">
							<img src="/resource/assets/img/snsicon1.gif">
						</a>
						<a href="/index.php/medical/contents/login_login/loginBySNS?method=facebook" id="facbook_login">
							<img src="/resource/assets/img/snsicon3.gif">
						</a>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>


<?if($method == 'facebook'):?>
<script>
	window.fbAsyncInit = function () {
		FB.init({
			appId: '1468754303245547',
			cookie: true,
			xfbml: true,
			version: 'v2.10',
		});
		FB.AppEvents.logPageView();


		FB.getLoginStatus(function (response) {
			if (response.status !== 'connected') {
				FB.login(function (response) {
				}, { scope: 'public_profile,email' });
			} else {
				FB.api('/me', { fields: 'email, name, gender' }, function (response) {
					console.log(response.email);
					console.log(response.name);
					console.log(response.gender);
				});
			}
		});

	};

	(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) { return; }
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

</script>
<?endif;?>