<?php
// 컨트롤러는 그냥 매핑하는 역할만 하는거지.

namespace App\Controllers;

use CodeIgniter\Controller;

class Test extends Controller
{
  // 이제 저 아래에 그 레지스터 인증 부분 Form_helper부분 사용하려면 클래스 메서드 중 가장 뛰어난 기능이라고 불리는 CI에서
  public function __construct(){
    helper(['url', 'form']);
  }


  // 첫번째 나오는 구간 매핑 다음으로
  public function index()
  {
      return view('test/test'); //$this->load->view('test')가 이렇게 바뀌었음. view 가는 방법임. 이러면 test 찾는다 view파일 가서
        // echo 'test page';
  }

  public function check(){
        $aParams = $this->request->getPost();
        $aParams['client_id'] = 'ksadmin';
        $aParams['client_secret'] = 'ksadmin';
        $aParams['grant_type'] = 'password';
        $sUrl = "http://1.234.15.178/oauth/token";
        $oCurl = curl_init();
        curl_setopt($oCurl, CURLOPT_URL, $sUrl);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aParams);
        $sResponse = curl_exec($oCurl);
        $aToken_info = json_decode($sResponse, true);
        echo "<pre>";
        print_r($aToken_info);
        echo "<pre>";

        // response 판단 후
        // if(!$oCurl){
        //   return view('test/register',['oCurl'=>$this->oCurl]);
        // }else{
        //   echo "Successfully";
        // }
        // 로그인 페이지 재호출
        // 메인 페이지 redirect
  }

  // register 등록 부분 설계 했음 .
  public function register(){
    return view('test/register');
  }
  // save 부분 설계 했음
  public function save(){

    // php에서 변수명 설정하는 방법은 $변수 이렇게 사용한다. 지금 이게 save 부분 레지스터 php에서 그래서 이 부분으로 들어오니까, 여기에
    // 작성해주는게 좋지

    $validation = $this->validate([
          // 'name' => [
          //   'rules'=> 'required',
          //   'errors' => [
          //     'required'=>'Your full name is required'
          //   ]
          // ],
          // 'email'
          //
          'name' => 'required',
          'email' => 'required|valid_email|is_unique[users.email]',
          'password' => 'required|min_lenght[5]|max_length[12]',
          'cpassword'=> 'required|min_lenght[5]|max_length[12]|matches[password]'
    ]);

    if(!$validation){
      return view('test/register',['validation'=>$this->validator]);
    }else{
      echo 'Form validated Successfully~!';
  }

}
}
