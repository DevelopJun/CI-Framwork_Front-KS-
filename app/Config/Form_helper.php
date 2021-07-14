<?php
  function display_error($validation, $field){
    if($validation->hasError($field)){
      return $validation->getError($field);
    }else{
      return false;
    }
  }

  
 ?>
<!-- 깔끔하게 만들려고 Helpers에 Form_helper부분 수정해준거임. 이 부분이 이제 register form에서
각 필드에 제대로 된 값이 안들어가면 error 출력하도록 파일 옆으로 뺴놓음 -->
