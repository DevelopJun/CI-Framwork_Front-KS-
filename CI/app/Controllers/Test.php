<?php
// 컨트롤러는 매핑 역할.

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\util\Util;
use App\Controllers\Session;

class Test extends  BaseController
{

  // public function __construct(){
  //   parent::__construct();

    public function index(){
         if($this->session->getFlashdata('message')){
            echo "<script> alert(\"다시 로그인 하세요!\"); </script>";
          }
            return view('test/test'); //$this->load->view('test') CI4에서 이렇게 변경
            // echo 'test page';
     }

    public function check(){
        $aParams = $this->request->getPost();
    	$sGrantType = 'password';
    	$aTest = Util::oauth_request($aParams, $sGrantType);
        // $aTest 받아오는 부분.
        $parser = \Config\Services::parser();
        $view = \Config\Services::renderer();
        // $session = \Config\Services::session($config);
        // 파서, 랜더링 사용하기 위해서 불러옴. 세션 함수는 BaseController 밑에 삽입함.

        $valuesArray1 = array_values($aParams);
        $valueskey1 = array_keys($aParams);
        // 받아온 아이디와 비밀번호를 잡기 위해서 $test key와 value 뽑아줌.
        $data =[
          "username" => $valuesArray1[0],
          "password" => $valuesArray1[1],
          "logged_in" => TRUE
        ];
        // data에서 session에 추가로 담고 싶으면 넣으면 된다.
        //여기서 입력받은 아이디와 비밀번호의 값을 다시 data로 넣고 parsing하였음.
        // 하지만 설계할때는 쿠키에 이와 같은 중요 정보를 노출 시켜선 안되기 때문에, 이후 session으로 분리할 계획임
        $valuesArray = array_values($aTest);
        $valueskey = array_keys($aTest);
        // 200을 잡기 위해서 앞에서는 넘어온 파라메터 값이 string 이였기 떄문에
        // $certain = strpos($aTest, "200 OK");
        // if($certain === false){
        //  이런식으로 문자열을 잡기 위해서 strpos를 사용했는데, 이후 util에서 oauth_request 로 넘어온 부분은 array였기 때문에 이를 수정했음

        if($valuesArray[1] == 200){

            $this->session->set('logged_in', true);
            // 데이터를 세션에 등록했음.
            // $this->session->set('array', $data);
            // 세션에 여러 정보 담을려고 할때 위 주석 풀어서 넣으면 된다.

            // 이제 사용자 정보를 세션에 넣고, 이후 cookie_Test페이지로 넘겼음.
            echo $parser->setData($data)->render('cookie/cookie_test');

            // display를 사용하지 않고, setData 내장 함수를 사용.
        }else{
            $this->session->setFlashdata('message', '로그인에 실패 하였습니다.');
            echo "<meta http-equiv='refresh' content='0; url=http://1.234.15.177/test/'>";
        };

        }

    // 세션 삭제 후 로그인 페이지 가는 곳
    public function session_destroy(){
        $this->session->remove('logged_in');
        // $this->session->remove('d');
        // print_r($_SESSION);
        return view('test/test');
    }

    //세션 로그인 확인하는 곳
    public function session_check(){
        if($this->session->get('logged_in')){
            echo view('test/session_check');
        }else{
            return view('test/test');
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
