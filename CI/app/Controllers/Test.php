<?php
// 컨트롤러는 그냥 매핑하는 역할만 하는거지.

namespace App\Controllers;

use CodeIgniter\Controller;

class Test extends Controller
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
        curl_setopt($oCurl, CURLOPT_HEADER, true);
        curl_setopt($oCurl, CURLOPT_POST, true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aParams);
        $sResponse = curl_exec($oCurl);
        $aToken_info = json_decode($sResponse, true);
        //
        // function file_get_contents_curl($url) {
        //   $ch = curl_init();// curl 리소스를 초기화
        //   curl_setopt($ch, CURLOPT_URL, $url); // url을 설정
        //   // 헤더는 제외하고 content 만 받음
        //   curl_setopt($ch, CURLOPT_HEADER, 0);
        //   // 응답 값을 브라우저에 표시하지 말고 값을 리턴
        //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //   $data = curl_exec($ch);
        //   curl_close($ch);// 리소스 해제를 위해 세션 연결 닫음
        //   return $data;
        // }
        // // helper('http');
        // $url = $sResponse;
        // $data = file_get_contents_curl($url);
        //
        // //echo $data.'<br />';
        //
        // $R = json_decode($data,TRUE);// JSON 데이터를 배열로 변환
        //
        // foreach($R['content'] as $val) {
        //   echo $val['sysdate'] . ' | ' . $val['mcount'] . "<br />";
        // }


        echo "<pre>";
        // $header_arr = get_http_header_as_array($aResponse);
        // print_r($header_arr);
        // print_r(apache_request_headers());

        // $httpinformation = apache_request_headers();
        // print_r($httpinformation);
        // var_dump(http_response_code(404));
        // print_r($data);
        // 문자열로만 처리할 수 없는건가?
        $certain = strpos($sResponse, "200 OK");
        if($certain === false){
        	// $strposTest 변수에 '201' 가 포함되어 있지 않은 경우.
          // 아닌 곳이니까 다시 리다이렉트 이건 방법이 많은데, 매니저님에게 추천 받아야함 . 총 3가지 존재한다.

          // echo "<script>document.location.href='도메인';</script>";
          // echo "<script> window.location.replace('도메인'); </script>";
          echo "<meta http-equiv='refresh' content='0; url=http://1.234.15.177/test/'>";
        }else{
          echo "응답을 잘 받아 왔습니다.";
        }
        print_r($sResponse);
        // print_r($aToken_info);
        // print_r(gettype($aToken_info));
        echo "<pre>";


        // $language = '';
        // $key = array_search($language, array_column($aToken_info, 'code')); // $key = 1
        // echo $list[$key]['name']; // print : ENG


        // // response 판단 후
        // if(!$aToken_info){
        //   return view('test/register');
        // }else{
        //   echo "Successfully";
        // }
        // 로그인 페이지 재호출
        // 메인 페이지 redirect


        // isset 함수가 원래 있는지 없는지 확인하는 내장함수임
        // if(!isset($aToken_info)){
        //   echo '발급된 토큰이 없습니다.';
        // }else{
        //   echo '발급된 토큰이 있기 때문에, 로그인 화면으로 이동합니다.';
        // }


  }



  // register 등록 부분 설계 했음 .
  public function register(){
    return view('test/register');
  }
  // save 부분 설계 했음
  public function save(){

    // helper(['url', 'form']);
    // php에서 변수명 설정하는 방법은 $변수 이렇게 사용한다. 지금 이게 save 부분 레지스터 php에서 그래서 이 부분으로 들어오니까, 여기에
    // 작성해주는게 좋지
    helper('form');


    $validation = $this->validate([
          'name' => [
            'rules'=> 'required',
            'errors' => [
              'required'=>'Your full name is required'
            ]
          ],
          'email' => [
            'rules'=>'required|valid_email|is_unique[user.email]',
            'errors'=>[
              'required'=>"Email is required",
              'valid_email'=>'You must enter a valid email',
              'is_unique' => 'Email already taken'
            ]
          ],
          'password'=>[
            'rules'=>'required|min_lenght[5]|max_length[12]',
            'errors'=>[
              'required'=>'password is required',
              'min_length'=>'Password must have atleast 5 characters in length',
              'max_length'=>'Password must not have characters more than 12 in length'
            ]
          ],
          'cpassword'=>[
            'rules'=>'required|min_lenght[5]|max_length[12]|matches[password]',
            'errors'=>[
              'required'=>"Confirm password is required",
              'min_length' => 'Confirm password must have atleast 5 characters in length',
              'max_length' => 'Confirm password must hvae characters more than 12 in length',
              'matches'=>'Confirm password not matches to password',
            ]
          ]
    ]);

    if(!$validation){
      return view('test/register',['validation'=>$this->validator]);
    }else{
      echo 'Form validated Successfully~!';
  }

}
}
