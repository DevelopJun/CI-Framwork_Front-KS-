/*
*accesstoken cookie 저장 구간 (보안 우회)
*--------------------
*author 정준호
*/

// 쿠키 만료 시간 설정 부분.
const timeset = 8000;

// 쿠키에서 토큰 받아 오는 구간
function getCookie(key){
    var result = document.cookie.split("=");
// 다시한번

    // 그럼 여기서 accesstoken을 재발급 받야 하는가?
    if(key === result[0]){
        return result[1];
    }else{
        return "key 틀렸습니다. 값 다시 입력하세요."
    };
}


// token header 맞추는 구간
function header(token){
    var headerfile = [
    'Authorization: Bearer '+ token,
    'Content-Type: application/json'
    ];
    headerfileC = JSON.stringify(headerfile); // object -> json 변환
    return headerfileC;
}
