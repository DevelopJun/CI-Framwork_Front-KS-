
var clockContainerT = document.querySelector(".clock-js");
var clockTitleT = clockContainerT.querySelector("h4");


// 실시간 출력 함수
if (localStorage.getItem('time') != null){
    function realtime(){
        var nowdate = new Date();
        var time = localStorage.getItem('time');
        interval = time - nowdate;
        // document.write(interval);
        // document.write("<br>");
        var hour = Math.floor((interval % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minitue = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
        var second = Math.floor((interval % (1000 * 60)) / 1000);
        //여기서 조건문 사용하여 시간, 분, 초 세밀하게 조정할 수 있다.
        clockTitleT.innerText = `사용 가능한 시간 : ${hour}시간 ${minitue}분  ${second}초 남음`;
        if(hour == 0 && minitue == 0 && second == 0){
            localStorage.removeItem('time');
            alert("사용 시간이 만료 되었습니다. 로그아웃 됩니다.")
            window.location.href='https://front.ksdev.net/login/logout';
        }
    }

}
function init(){
    realtime();
    setInterval(realtime, 1000);
}
init();
