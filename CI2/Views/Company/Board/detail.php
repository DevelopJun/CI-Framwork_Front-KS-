<script>
var extend = 0;
function madetime(){
    const timeset = 8000 * 10;
    var dateo = new Date();
    var time = dateo.getTime();
    var expireTime = time + timeset; // timeset 시간 설정 조율
    dateo.setTime(expireTime);
    var final = dateo.setTime(expireTime);
    console.log(localStorage.getItem('time'));
    if (localStorage.getItem('time') == null || extend == 1){
        localStorage.setItem('time', final);
    }
	document.cookie = 'jwt_token=<?= $_SESSION['admin']['sAccessToken'] ?>;expires='+ dateo +';path=/';
};
madetime();
</script>


<script>
	function remove(idx){
            if (confirm("삭제하시겠습니까?")){
                AJAX.delete('https://admin-api.ksdev.net/api/v1/ksadmin/admin/board/', idx, <?= $_SESSION['info']['idx'] ?>, <?= $idx ?>, getCookie('jwt_token')); // Ajax 공통모듈 분리 완료.
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
