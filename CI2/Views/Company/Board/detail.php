<!-- 토큰 쿠키 저장 연결 js 파일-->
<script src="/js/Ajax/setcookie.js"></script>
<!-- Ajax 공통 모듈 연결 js 파일-->
<script src="/js/Ajax/Ajax(common).js"></script>

<script>
// jwt 토큰 보안 - loal localStorage 에 넣는 방법1 (불필요시 삭제)
function saveJWT(){
    localStorage.setItem('jwt_token', '<?= $_SESSION['admin']['sAccessToken'] ?>' );
};
saveJWT();
</script>

<script>
// jwt 토큰 보안 - cookie에 넣는 방법2
var i = 0;
var date = new Date();
var time = date.getTime();
if( i == 0){
    var expireTime = time + timeset; // 현재 쿠키 만료 약 30초 설정(테스트 진행)
}else{
    var expireTime = 0; // 새로고침시. cookie 가중 증가 문제. 초기화 세팅.
    var expireTime = time + timeset; // 현재 쿠키 만료 약 30 초 설정(테스트 진행)
}
i++ ;
date.setTime(expireTime);
compare = expireTime;
document.cookie = 'jwt_token=<?= $_SESSION['admin']['sAccessToken'] ?>;expires='+date+';path=/';
</script>


<script>
	function remove(idx){
        var date = new Date();
        var timec = date.getTime();
        if(timec <= compare){
            console.log("쿠키 만료되기 전에 정상적으로 작성 되었습니다.");
            if (confirm("삭제하시겠습니까?")){
                AJAX.delete('https://admin-api.ksdev.net/api/v1/ksadmin/admin/board/', idx, <?= $_SESSION['info']['idx'] ?>, <?= $idx ?>, getCookie('jwt_token')); // Ajax 공통모듈 분리 완료.
    		}
        }else{
            console.log("쿠키가 만료되어 글을 삭제할 수 없습니다.");
            alert("쿠키가 만료되어 글을 삭제할 수 없습니다.");
            location.reload(true); // 현재 페이지로 다시 새로고침하여 쿠키 다시발급 방법
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
