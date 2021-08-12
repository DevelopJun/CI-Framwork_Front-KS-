function clicklogout(){
    localStorage.removeItem('time');
    alert("로그아웃");
    location.href='/login/logout';
}


/*
* accesstoken cookie 저장
* -----------------
* author 정준호
*/
function notify(data) {
    if (Notification.permission !== "denied") {
      Notification.requestPermission(permission => {
        if (permission === "granted" && data == 1) {
          new Notification("시간이 얼마 남지 않았습니다. 페이지를 유지해주세요.");
        }
        else if (permission === "granted") {
            new Notification("만료 시간 알람 설정이 시작 되었습니다.");
        }
        else
        {
          alert('Notification denied');
        }
      });
    }
};


// 쿠키 만료 시간 설정 부분.
// const timeset = 8000 * 10;

// 쿠키에서 토큰 받아 오는 구간
function getCookie(key){
    // 알고리즘 다시 설계
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
function madetime(extend){
    const timeset = 1000 * 60 * 30; // 30분 => 1000*60 이 30분
    var dateo = new Date();
    var time = dateo.getTime();
    var expireTime = time + timeset; // timeset 시간 설정 조율 부분
    dateo.setTime(expireTime);
    var final = dateo.setTime(expireTime);
    if (localStorage.getItem('time') == null){
        localStorage.setItem('time', final);
    }else if(extend == 1){
        localStorage.removeItem('time');
        localStorage.setItem('time', final);
    }
};

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
    if(hour == 0 && minitue == 0 && second == 0){
        localStorage.removeItem('time');
        alert("사용 시간이 만료 되었습니다. 자동 로그아웃 됩니다.");
        location.href='/login/logout';
    }
    else if(hour < 0 && minitue < 0 && second < 0){
        localStorage.removeItem('time');
        location.href='/login/logout';
    }
    else if(hour == 00 && minitue == 29 && second <= 59){
        if(hour == 00 && minitue == 29 && second == 40){
            data = 1;
            notify(data);
        }
        if(hour == 00 && minitue == 25 && second < 59){
            AJAX.extendRefreshtoken();
            var extend = 1;
            madetime(extend);
            return
        }
        $("#mouse").hover(function(){
            var extend = 1;
            madetime(extend);
            console.log("사용자 서비스 감지 on.");
        }, function(){
            console.log("사용자 서비스 감지 off.");
        }
    )}

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
        AJAX.extendRefreshtoken();
        alert("사용시간을 연장하셨습니다.");
        console.log("accesstoken 재발급이 진행되고 있습니다. 잠시만 기다려주세요");
    })


});



/*
* ajax 공통 모듈
* --------------------
*author 정준호
*/

function ajaxfail(data){
    if(data.code == 401){
        console.log("권한문제");
        errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
    }else{
        console.log("fail 오류", data.message);
    }
}

ajaxerror = function (data){
    if(data.code == 401){
        console.log("권한문제");
        errorCallback(); // 토큰 권한 문제라면 콜백함수 호출
    }else{
        console.log("Error 오류", data.message);
    }
}

function errorCallback(){
	alert("Acccesstoken이 만료 되었습니다. 로그인을 다시 해주시기 바랍니다.");
	location.href = "https://front.ksdev.net/login";
}


var AJAX = {
	// urld => 경로 url , token => accesstoken 값
	get: function(urld){
		$.ajax({
			type: "GET",
			url: urld, //url로 하면 이름 같아서 에러 발생
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.setRequestHeader('Authorization', 'Bearer '+ getCookie('KS_AUT'));
			},
			success: function (data){
                    console.log("게시판을 성공적으로 불러 왔습니다.", data.message);
			},
            fail: function (data){
                ajaxfail(data)
            },
			error: function(data){
                ajaxerror(data)
            }
		});
	},

	// urlc=> 경로 url, form => form 내용
	post: function(urlc, form){
		$.ajax({
			type: "post",
			data: form.serialize(),
			url: urlc, //url로 하면 이름 같아서 에러 발생
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.setRequestHeader('Authorization', 'Bearer '+ getCookie('KS_AUT'));
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
                ajaxfail(data)
            },
			error: function(data){
                ajaxerror(data)
            }
        });
	},

	// form => form 내용, idx => user idx값
	put: function(form, idx){
		$.ajax({
			type: "put",
			data: form.serialize(),
			url: `https://admin-api.ksdev.net/api/v1/ksadmin/admin/board/${idx}`,
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				request.setRequestHeader('Authorization', 'Bearer '+ getCookie('KS_AUT'));
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
                ajaxfail(data)
            },
			error: function(data){
                ajaxerror(data)
            }
		});
	},
	// url => url 로, idx => 게시물 번호, Aidx => 사용자 번호, idxn=> url idx 번호
	delete: function(url, idx, Aidx, idxn){
		$.ajax({
			type: "delete",
			async:false,
			data: JSON.stringify({idx:idx,admin_idx:Aidx}),
			url: url + idxn,
			beforeSend:function(request){
				request.setRequestHeader('Content-type','application/json');
				request.setRequestHeader('Authorization', 'Bearer '+ getCookie('KS_dUT'));
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
                ajaxfail(data)
            },
			error: ajaxerror
		});
	},
    extendRefreshtoken : function(){
            console.log("start get access token by refresh token");
            $.ajax({
                type: "POST",
                url: "https://front.ksdev.net/Oauth/Authorize/refresh",
                success: function (data){
                location.href='/login/logout';
                        console.log(data);
                        console.log("refresh_token 받아오기 성공,");
                        console.log("success");
                        return
                },
                fail: function (data){
                    console.log("fail");
                    location.href='/login/logout';
                    console.log(data);
                },
                error: function (data){
                    console.log("ExtendRefreshtoken accept error");
                    location.href='/login/logout';
                    console.log(data);
                }
            });
        },
}
