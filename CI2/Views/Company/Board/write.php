<!-- 토큰 쿠키 저장 연결 js 파일-->
<script src="/js/Ajax/setcookie.js"></script>
<!-- Ajax 공통 모듈 연결 js 파일-->
<script src="/js/Ajax/Ajax(common).js"></script>


<script>
// jwt 토큰 보안 - loal localStorage 에 넣는 방법1 (불필요시 삭제)
function saveJWT(){
    localStorage.setItem('jwt_token', '<?= $_SESSION['ksadmin']['sAccessToken'] ?>' );
};
saveJWT();
</script>

<script>
// jwt 토큰 보안 - cookie에 넣는 방법2
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
	function write(){
		var form = document.writeform;
		if (!$("input[name=title]").val()){
			alert("제목을 입력해주세요.");
			return;
		}
		if (!$("input[name=content]").val()){
			alert("내용을 입력해주세요.");
			return;
		}
        AJAX.post($(form), getCookie('jwt_token')); // Ajax 공통모듈 분리 완료
	}
</script>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="mb-3 card">
			<div class="card-header-tab card-header-tab-animation card-header">
				<div class="card-header-title">
					<i class="header-icon lnr-apartment icon-gradient bg-love-kiss"></i>
					게시글 수정
					<?php  print_r($_SESSION);?>
				</div>
			</div>

			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="tabs-eg-77" style="min-height: 400px">
						<form name="writeform" action="javascript:write()">
							<input type="hidden" name="admin_idx" value="<?= $_SESSION['info']['idx'] ?>">
							제목 : <input type="text" name="title" value="" placeholder="제목"><br>
							내용 : <input type="text" name="content" value="" placeholder="내용"><br>
							<input type="submit" value="작성">
							<input type="button" onclick="location.href='/company/board';" value="목록으로">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
