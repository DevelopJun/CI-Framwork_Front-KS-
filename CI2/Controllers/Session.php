<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Test;

class Session extends BaseController {


  public function session_exist(){
    $session = session(); //  현재 이 부분은 세션이 있는지 확인하는 엔드포인트 메소드이다.
    $is_session_exist = $session->member_id != null; //
    return $is_session_exist ? "세션 값이 존재합니다." : "세션 값이 없습니다."; // 배열과 다르게 오류 안 뱉고, 그냥 null 리턴
  }

  public function session_set(){ // 여기서 세션 설정하는 부분
    $session = session();
    $session->username = "3";
    $session-> //$session->키 = 값 형태로 사용함.
  }

  public function session_get(){
    $session = session();
    $session_value = $session->member_id;
    return $session_value === null ? "세션 값이 없습니다." : "세션 값은 $session_value 입니다."
  }


  public function session_remove(){
    $session = session();
    $session->remove('member_id');
    return "세션값이 삭제되었습니다."

  }

}
