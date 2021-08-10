/*
* ajax 공통 모듈
* --------------------
*author 정준호
*/


// sAccessToken 소멸시, 로그인 화면으로 다시 들어감.
// 현재 refresh_token을 errorCallback에서 재 발급 받아야 하는데,
// 그렇게 되었을떄,  util -> oauth_request인증, api_request 메소드 부분을 여기까지 들고 와야 한다.
// 가능한가?


function errorCallback(){
	alert("Acccesstoken이 만료 되었습니다. 로그인을 다시 해주시기 바랍니다.");
	location.href = "https://front.ksdev.net/login";

}

var AJAX = {
	// get 구현 O
	get: function(token){
		$.ajax({
			type: "GET",
			url: 'https://admin-api.ksdev.net/api/v1/ksadmin/admin/board', //url로 하면 이름 같아서 에러 발생
			beforeSend:function(xhr){
				xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				xhr.setRequestHeader('Authorization', 'Bearer '+ token);
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

	// urlc=>, form => form 내용, token => accesstoken 값
	post: function(urlc, form, token){
		$.ajax({
			type: "post",
			data: form.serialize(),
			url: urlc, //url로 하면 이름 같아서 에러 발생
			beforeSend:function(xhr){
				xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				xhr.setRequestHeader('Authorization', 'Bearer '+ token);
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
			beforeSend:function(xhr){
				xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
				xhr.setRequestHeader('Authorization', 'Bearer '+ token);
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
}
