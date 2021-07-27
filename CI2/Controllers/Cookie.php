<?php
// 컨트롤러는 그냥 매핑하는 역할만 하는거지.

namespace App\Controllers;

use CodeIgniter\Controller;

class Cookie extends Controller
{
  // 이제 저 아래에 그 레지스터 인증 부분 Form_helper부분 사용하려면 클래스 메서드 중 가장 뛰어난 기능이라고 불리는 CI에서
// 컨트롤러 전체에 사용되는 라이브러리이면 생성자에서 선언을, 컨트롤 내에 일부 메소드에서만 사용되는 라이브러리면 모든 메소드에서 로딩할
// 필요가 없기 때문에 사용하는 메소드에서만 로딩함.
  // public function __construct(){
  //   parent::__construct();
  //   $this->load->helper(array('form'));
  // }


  // 첫번째 나오는 구간 매핑 다음으로
  public function index()
  {
      return view('cookie/cookie_test'); //$this->load->view('test')가 이렇게 바뀌었음. view 가는 방법임. 이러면 test 찾는다 view파일 가서
        // echo 'test page';
  }
  public function cookie_del(){
    return view('cookie/cookie_del');
  }
}
