<?php
// 컨트롤러는 그냥 매핑하는 역할만 하는거지.

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\util\Util;
use App\Controllers\Session;

class Test extends  BaseController
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
      if($this->session->getFlashdata('message')){
          echo "<script> alert(\"다시 로그인 하세요!\"); </script>";
      }
      return view('test/test'); //$this->load->view('test')가 이렇게 바뀌었음. view 가는 방법임. 이러면 test 찾는다 view파일 가서
        // echo 'test page';
  }

// isset($_SESSION['username']) === 0
  public function check(){
        // if($this->session->get('username')){
        //     return $this->response->redirect('/test');
        // }
        // 이렇게 세션에 넣으면 안될 것 같음..

        $aParams = $this->request->getPost();
    	$sGrantType = 'password';
    	$aTest = Util::oauth_request($aParams, $sGrantType);
        //여기서 지금 Test 받아오고
        $parser = \Config\Services::parser();
        $view = \Config\Services::renderer();
        // 파서랑 랜더링 세션 함수 사용하기 위해서 넣어준 부분임

        // $session = \Config\Services::session($config);
        // 이 부분은 세션 초기화 하려고 넣은 부분임.

        $valuesArray1 = array_values($aParams);
        $valueskey1 = array_keys($aParams);
        // 이 부분은 받아온 아이디와 비밀번호를 잡기 위해서 $test를 뽑아준 부분.
        $data =[
          "username" => $valuesArray1[0],
          "password" => $valuesArray1[1],
          "logged_in" => TRUE
        ];
        //여기서 입력받은 아이디와 비밀번호의 값을 다시 data로 넣고 parsing하였음.
        // 하지만 설계할때는 쿠키에 이와 같은 중요 정보를 노출 시켜선 안되기 때문에, 이후 session으로 분리할 계획임
        $valuesArray = array_values($aTest);
        $valueskey = array_keys($aTest);
        // 이 부분은 200을 잡기 위해서 앞에서는 넘어온 파라메터 값이 string 이였기 떄문에
        // $certain = strpos($aTest, "200 OK");
        // if($certain === false){
        //  이런식으로 문자열을 잡기 위해서 strpos를 사용했는데, 이후 util에서 oauth_request 로 넘어온
        // 부분은 array였기 때문에 이를 수정했음

        echo '<pre>';
    		// print_r($aTest);
        if($valuesArray[1] == 200){

        echo "<br>";
            // print_r($session);

          print_r($aTest);
          echo "<br>";
          print_r($aParams);
          echo "<br>";
          print_r($valuesArray1[0]);
          echo "<br>";
          print_r($valuesArray1[1]);
          // 위의 코드는 array 에서 key와 value 가 정확히 추출 되었는지 확인하기 위해서 작성하였음.

          $this->session->set($data);
          $session_lol = array_values($_SESSION);
          echo "<br>";
          // 데이터를 세션에 등록했음.
          $a = $valuesArray1[0];
          $b = $valuesArray1[1];
          $c = $session_lol[4];
          $d = $session_lol[5];
          echo $parser->setData($data)->render('cookie/cookie_test');
          # 매니저님께서 display를 사용하라고 하셨는데, setData 내장 함수를 사용해서 코딩하였음 .
        }else{
            $this->session->setFlashdata('message', '로그인에 실패 하였습니다.');

          echo "<meta http-equiv='refresh' content='0; url=http://1.234.15.177/test/'>";
          // $this->load->helper('url');
          // redirect('/test/test');
        };
        return a;

}

public function session_check(){

    $tmp = $this->check();
    echo print_r($tmp);
    //지역변수에서 지역변수로 가는 방법 찾아서 이 부분 코딩하셈.

    if($valuesArray1[0] == $session_lol[4] && $valuesArray1[1] == $session_lol[5]){
        echo view('test/session_check');
    }else{
        return $this->response->redirect('/test');
    }
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
