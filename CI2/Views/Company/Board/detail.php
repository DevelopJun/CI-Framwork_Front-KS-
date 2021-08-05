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
var i = 0;
var date = new Date();
var time = date.getTime();
if( i == 0){
    var expireTime = time + 8000; // 현재 쿠키 만료 약 14분 설정
}else{
    var expireTime = 0; // 초기화를 해줘야 한다. 새로고침을 계속 눌렀더니.. cookie 계속 쌓여서 많이 증가함.
    var expireTime = time + 8000; // 현재 쿠키 만료 약 14분 설정
}
i++ ;
date.setTime(expireTime);
document.cookie = 'jwt_token=<?= $_SESSION['ksadmin']['sAccessToken'] ?>;expires='+date+';path=/';
</script>


<script>
	function remove(idx){
        if (confirm("삭제하시겠습니까?")){
            AJAX.delete('https://apigw.ksdev.net/api/v1/ksadmin/admin/board/', idx, <?= $_SESSION['info']['idx'] ?>, <?= $idx ?>, getCookie('jwt_token')); // Ajax 공통모듈 분리 완료.
		}
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
