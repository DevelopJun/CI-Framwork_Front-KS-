// 
// const clockContainer = document.querySelector(".js-clock");
// const clockTitle = clockContainer.querySelector("h1");
//
//
// // 실시간 출력 함수
// function realtime(){
//     var nowdate = new Date();
//     interval = date-nowdate;
//     // document.write(interval);
//     // document.write("<br>");
//     var hour = Math.floor((interval % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minitue = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
//     var second = Math.floor((interval % (1000 * 60)) / 1000);
//     //여기서 조건문 사용하여 시간, 분, 초 세밀하게 조정할 수 있다.
//     clockTitle.innerText = `글 작성 시간이 ${hour}시간 ${minitue}분  ${second}초 남았습니다`;
//     if(hour == 0 && minitue == 0 && second == 0){
//         alert("글 작성 시간이 만료 되었습니다.")
//         window.location.href='https://front.ksdev.net/company/board';
//     }
// }
//
// function init(){
//     realtime();
//     setInterval(realtime, 1000);
// }
// init();
