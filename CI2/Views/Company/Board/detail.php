<script src="/js/June/Ajax.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
//loal localStorage 에 넣는 방법1
function saveJWT(){
    localStorage.setItem('jwt_token', '<?= $_SESSION['ksadmin']['sAccessToken'] ?>' );
};
saveJWT();
</script>


<script>
// cookie에 넣는 방법2
function saveJWTinCookie(name, value, days) {
        if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
        } else {
               var expires = "";
        }

        document.cookie = name + "=" + value + expires + "; path=/";
}
saveJWTinCookie('jwt_token', '<?= $_SESSION['ksadmin']['sAccessToken'] ?>', 50);

</script>



<script>



function remove(idx){
	// 이 세션 정보를 어디에다 담을 것인가?
	// var token = '<?= $_SESSION['ksadmin']['sAccessToken'] ?>';
	// var header = [
	// 	'Authorization: Bearer '+ token,
	// 	'Content-Type: application/json'
	// ];

		if (!confirm("삭제하시겠습니까?")){

		}
		$.ajax({
			type: "delete",
			async:false,
			data: {idx:idx,admin_idx:<?= $_SESSION['info']['idx'] ?>},
			contentType: "application/x-www-form-urlencoded",
			url: "http://apigw.ksdev.net/api/v1/ksadmin/admin/board/<?= $idx ?>",
			beforeSend:function(xhr){
				xhr.setRequestHeader(token, header);
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
</script>

<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="mb-3 card">
			<div class="card-header-tab card-header-tab-animation card-header">
				<div class="card-header-title">
					<i class="header-icon lnr-apartment icon-gradient bg-love-kiss"></i>
					게시글 상세
				</div>
			</div>

			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="tabs-eg-77" style="min-height: 400px">
						제목 : <?= $title ?><br>
						작성자 : <?= $name ?> (<?= $admin_id ?>)<br>
						작성일자 : <?= $create_date ?> / 수정일자 : <?= $update_date ?><br>
						내용 : <?= $content ?><br>
						<a href="/company/board/modify?idx=<?= $idx ?>">수정하기</a>
						<input type="button" onclick="remove(<?= $idx ?>);" value="제거하기">
						<input type="button" onclick="location.href='/company/board';" value="목록으로">
						<button type="button" class="btn btn-success" id="call">Data Api 추출</button>
						<br>
						<p id="show"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/js/June/Ajax.js"></script>
