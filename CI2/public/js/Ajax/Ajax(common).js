/*
* ajax 공통 모듈
* --------------------
*author 정준호
*/
// 재 발급 받는 부분
function errorCallback(){
	alert("콜백 하잉~");
	return 0;
}



var AJAX = {
	// get 구현 X
	// urlc=>, form => form 내용, oken => accesstoken 값
	post: function(urlc, form, token){
		$.ajax({
			type: "post",
			data: form.serialize(),
			contentType: "application/x-www-form-urlencoded",
			url: urlc, //url로 하면 이름 같아서 에러 발생
			beforeSend:function(xhr){
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
					errorCallback();
				}else{
					alert("콜백함수로 안갔어. 10초 안에 들어왔어");
				}
			},
			error: function (data){
				if(data.code == 401){
					errorCallback();
				}else{
					alert("콜백함수로 안갔어. 10초 안에 들어왔어");
				}
			}
		});
	},

	// form => form 내용, idx => user idx값, token => accesstoken 값
	put: function(form, idx, token){
		$.ajax({
			type: "put",
			data: form.serialize(),
			contentType: "application/x-www-form-urlencoded",
			url: `https://apigw.ksdev.net/api/v1/ksadmin/admin/board/${idx}`,
			beforeSend:function(xhr){
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
				alert(data.message);
			},
			error: function (data){
				alert(data.message);
			}
		});

	},
	// url => url 로, idx => 게시물 번호, Aidx => 사용자 번호, idxn=> url idx 번호, token => accesstoken 값
	delete: function(url, idx, Aidx, idxn, token){
		$.ajax({
			type: "delete",
			async:false,
			data: {idx:idx,admin_idx:Aidx},
			contentType: "application/x-www-form-urlencoded",
			url: url + idxn,
			beforeSend:function(xhr){
				xhr.setRequestHeader('Authorization', 'Bearer '+ token);
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
				alert(data.message);
			},
			error: function (data){
				alert(data.message);
			}
		});
	}
}
