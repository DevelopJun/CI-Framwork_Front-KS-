/*
* ajax 공통 모듈
* --------------------
*author 정준호
*/

var AJAX = {
	// form => form 내용, oken => accesstoken 값
	post: function(form, token){
		$.ajax({
			type: "post",
			data: form.serialize(),
			contentType: "application/x-www-form-urlencoded",
			url: "https://apigw.ksdev.net/api/v1/ksadmin/admin/board",
			beforeSend:function(xhr){
				xhr.setRequestHeader('Authorization', 'Bearer '+ token);
			},
			success: function (data){
				if (data.code == 200){
					alert("입력완료");
					location.href = "/company/board/detail?idx="+data.data.idx;
					console.log(data);
				} else {
					alert(data.message);
				}
			},
			fail: function (data){
				alert(data);
			},
			error: function (data){
				alert(data);
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
	// idx => 게시물 번호, Aidx => 사용자 번호, idxn=> url idx 번호, token => accesstoken 값
	delete: function(idx, Aidx, idxn, token){
		$.ajax({
			type: "delete",
			async:false,
			data: {idx:idx,admin_idx:Aidx},
			contentType: "application/x-www-form-urlencoded",
			url: `https://apigw.ksdev.net/api/v1/ksadmin/admin/board/${idxn}`,
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
