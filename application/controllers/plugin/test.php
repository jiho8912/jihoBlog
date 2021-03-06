<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

    /**
     * 생성자
     *사용할 모델을 로드해온다
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('member_m'); //member controller model
        $this->load->model('board_m');
        $this->load->model('admin/admin_excel_m');
        $this->load->model('admin/admin_menu_m');
        $this->load->library('common');
        $this->seg_exp = $this->common->segment_explode($this->uri->uri_string());
    }
    public function index()
    {
        $urlArray = @$this->seg_exp['query_string'];
        $board_data['limit'] = 5; //메인 노출 게시판 표시할 리스트개수
        $data['select_main_new_data'] = $this->board_m->select_new_content($board_data);//최근 게시물 가져오기

        $data['select_new_reply'] = $this->board_m->select_new_reply($board_data);//최근 댓글물 가져오기

        $data['category_list'] = $this->admin_menu_m->select_category_tree();

        $this->load->view('head',$data);
        $this->load->view('plugin/test/test',$data);
        $this->load->view('footer',$data);

    }

    public function curlTest(){
        $url = 'https://www.royalcaribbean.com/cruise-ships/symphony-of-the-seas/deck-plans/1820/03';
        $url = 'https://optimus-qa.deemgroundapp.com/CarSVCAuthorization/Token/';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'user-agent: Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1',
            )
        );
        $ParsHtml = curl_exec($ch);
        $info = curl_getinfo($ch);

        print $ParsHtml;
        debug($info);
        debug($ParsHtml);
    }
}

