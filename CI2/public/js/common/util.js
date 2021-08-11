/*
* 연장하기 버튼 작동시 refresh_token으로 token 재발급 받는 부분
* -----------------
* author 정준호
*/




/*
* accesstoken cookie 저장
* -----------------
* author 정준호
*/

// 쿠키 만료 시간 설정 부분.
// const timeset = 8000 * 10;

// 쿠키에서 토큰 받아 오는 구간
function getCookie(key){
    var result = document.cookie.split("=");
    if(key === result[0]){
        return result[1];
    }else{
        return "key 틀렸습니다. 값 다시 입력하세요.";
    }
}


/*
* 사용자 시간 제어 모듈
* -----------------
* author 정준호
*/

// 사용자 시간 제어 모듈 알고리즘
var clockContainerT = '';
var clockTitleT = '';
// 실시간 출력 함수
function realtime(){
    if (localStorage.getItem('time') != null){
        $(document).ready(function(){
        clockTitleT = document.getElementById("clock");
        });
    }
    if(clockContainerT == '' && clockTitleT == ''){
        return
    }
    var nowdate = new Date();
    var time = localStorage.getItem('time');
    interval = time - nowdate;
    var hour = Math.floor((interval % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minitue = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
    var second = Math.floor((interval % (1000 * 60)) / 1000);
    clockTitleT.innerText = `사용 가능한 시간 : ${hour}시간 ${minitue}분  ${second}초 남음`;
    //여기서 조건문 사용하여 시간, 분, 초 세밀하게 조정할 수 있다.
    // 만료 시간 후 로그아웃 되는 부분.
    // 토큰 내려고, 추가 설정 default
    if(hour == 0 && minitue == 0 && second == 0){
        localStorage.removeItem('time');
        alert("사용 시간이 만료 되었습니다. 자동 로그아웃 됩니다.");
        location.href='/login/logout';
    }
    if(hour < 0 && minitue < 0 && second < 0){
        localStorage.removeItem('time');
        location.href='/login/logout';
    }
}
function init(){
    realtime();
    setInterval(realtime, 1000);
}
init();

// 만료시간 연장 알고리즘
$(document).ready(function(){
    $("#btn_group #test_btn2").click(function(){
        var extend = 1;
        madetime(extend);

        // refresh_token 으로 accesstoken 재발급 받는 부분 설계  ajax 타고 가도 된다.

        alert("사용시간을 연장하셨습니다.");
        console.log("accesstoken 재발급 가보자~");
    })
});



/*
* ajax 공통 모듈
* --------------------
*author 정준호
*/


function errorCallback(){
	alert("Acccesstoken이 만료 되었습니다. 로그인을 다시 해주시기 바랍니다.");
	location.href = "https://front.ksdev.net/login";

}

var AJAX = {
	// urld => 경로 url , token => accesstoken 값
	get: function(urld, token){
		$.ajax({
			type: "GET",
			url: urld, //url로 하면 이름 같아서 에러 발생
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.setRequestHeader('Authorization', 'Bearer '+ token);
			},
			success: function (data){
				if (data.code == 200){
					console.log(data.message);
				} else {
					alert(data.message);
				}
			},
			fail: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			},
			error: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			}
		});
	},

	// urlc=> 경로 url, form => form 내용, token => accesstoken 값
	post: function(urlc, form, token){
		$.ajax({
			type: "post",
			data: form.serialize(),
			url: urlc, //url로 하면 이름 같아서 에러 발생
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.setRequestHeader('Authorization', 'Bearer '+ token);
			},
			success: function (data){
				if (data.code == 200){
					alert("입력완료");
					location.href = "/company/board/detail?idx="+data.data.idx;
					console.log(data.message);
				} else {
					alert(data.message);
				}
			},
			fail: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			},
			error: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			}
		});
	},

	// form => form 내용, idx => user idx값, token => accesstoken 값
	put: function(form, idx, token){
		$.ajax({
			type: "put",
			data: form.serialize(),
			url: `https://admin-api.ksdev.net/api/v1/ksadmin/admin/board/${idx}`,
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.setRequestHeader('Authorization', 'Bearer '+ token);
			},
			success: function (data){
				if (data.code == 200){
					alert("수정완료");
					location.href=`/company/board/detail?idx=${idx}`;
				} else {
					alert(data.message);
				}
			},
			fail: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			},
			error: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			}
		});

	},
	// url => url 로, idx => 게시물 번호, Aidx => 사용자 번호, idxn=> url idx 번호, token => accesstoken 값
	delete: function(url, idx, Aidx, idxn, token){
		console.log(getCookie('jwt_token'));
		$.ajax({
			type: "delete",
			async:false,
			data: JSON.stringify({idx:idx,admin_idx:Aidx}),
			url: url + idxn,
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/json');
				request.setRequestHeader('Authorization', 'Bearer '+ token);
			},
			success: function (data){
				if (data.code == 200){
					alert("삭제완료");
					location.href='/company/board';
				} else {
					alert(data.message);
				}
			},
			fail: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			},
			error: function (data){
				if(data.code == 401){
					errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
				}else{
					alert(date.message);
				}
			}
		});
	},

    extendRefreshtoken : function(){
            $.ajax({
                type: "post",
                data: , //json 형태로 설계,
                url: "Oauth/Authorize/refresh",
                contenttype: "application/json",
                success: function (data){
                    if (data.code == 200){
                        alert("재 발급 완료.")
                        console.log(data.message);
                    } else {
                        alert(data.message);
                    }
                },
                fail: function (data){
                    if(data.code == 401){
                        errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
                    }else{
                        alert(date.message);
                    }
                },
                error: function (data){
                    if(data.code == 401){
                        errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
                    }else{
                        alert(date.message);
                    }
                }
            });
        },
}
