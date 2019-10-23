<?
class Faq{
	function onInit(&$ci){
		$ci->load->model('User/Question', 'questionModel');
	}

	function index(&$data, &$ci){
		$ci->load->library('paging');
		$paging = &$ci->paging;

		$paging->setOrder('uq_seq' , 'desc');
		$data['list'] = $ci->questionModel->listPage($paging);

		$data['paging'] = &$paging;		
		return 'faq/list';
	}

	function insertAnswer(&$data, &$ci){
		$seq = $ci->request->param('seq', METHOD_BOTH, false);
		$data['question'] = $ci->questionModel->getRowBySeq($seq);

		$ci->setFrame('window');
		return 'faq/form';
	}

	function insertAnswerOk(&$data, &$ci){
		$args = $ci->request->getAll();
		$args['uq_an_meid'] = $ci->auth->id();
		$args['uq_an_ctime'] = time();

		$ci->questionModel->insertAnswer($args);
		
		$data['msg'] = '답변이 정상적으로 등록되었습니다.';
		$data['sact'] = array('POR', 'PR');
		return 'script';
	}
}
?>