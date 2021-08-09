//
// var clockContainerT = document.querySelector(".clock-js");
// var clockTitleT = clockContainerT.querySelector("h4");

// 업무 관리 버튼 눌렀을때 실행되는 함수

function startclock(expire){
    console.log("start_clock 여기까지 들어왔나?");
    var dateT = new Date();
    expire_time = expire / 60;
    console.log(expire_time);
    dateT.setMinutes(dateT.getMinutes()+ expire_time);
    console.log(dateT);
    realtime(dateT);
}


// 실시간 출력 함수
function realtime(dateT){
    console.log("realtime 여기까지 들어왔나?");
    var nowdate = new Date();
    interval = dateT-nowdate;
    // document.write(interval);
    // document.write("<br>");
    var hour = Math.floor((interval % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minitue = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
    var second = Math.floor((interval % (1000 * 60)) / 1000);
    //여기서 조건문 사용하여 시간, 분, 초 세밀하게 조정할 수 있다.
    // user 이름 나두는 것도 방법임
    clockTitleT.innerText = `사용 가능한 시간: ${hour}시간 ${minitue}분  ${second}초`;
    if(hour == 0 && minitue == 0 && second == 0){
        alert("사용자 시간이 만료 되었습니다.")
        window.location.href='https://front.ksdev.net/company/board';

        // 쿠키 세션 모두 삭제 시키고,
        // logout 페이지로 가야지
    }
    setInterval(realtime, 1000);
}

//
// function init(){
//     realtime();
//     setInterval(realtime, 1000);
// }
// if(i == 0){
//     init();
// }
