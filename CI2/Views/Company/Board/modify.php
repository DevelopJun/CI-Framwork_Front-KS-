<script>
var extend = 0;
function madetime(){
    const timeset = 8000 * 10;
    var dateo = new Date();
    var time = dateo.getTime();
    var expireTime = time + timeset; // timeset 시간 설정 조율 부분
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
	function modify(){
            var form = document.modifyform;
    		if (!$("input[name=title]").val()){
    			alert("제목을 입력해주세요.");
    			return;
    		}
    		if (!$("input[name=content]").val()){
    			alert("내용을 입력해주세요.");
    			return;
    		}
    		AJAX.put($(form),<?= $idx ?>, getCookie('jwt_token')); // Ajax 공통모듈 분리 완료.
        }

</script>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="mb-3 card">
			<div class="card-header-tab card-header-tab-animation card-header">
				<div class="card-header-title">
					<i class="header-icon lnr-apartment icon-gradient bg-love-kiss"></i>
					게시글 수정
				</div>
			</div>

			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="tabs-eg-77" style="min-height: 400px">
						<form name="modifyform" action="javascript:modify()">
							<input type="hidden" name="idx" value="<?= $idx ?>">
							<input type="hidden" name="admin_idx" value="<?= $_SESSION['info']['idx'] ?>">
							제목 : <input type="text" name="title" value="<?= $title ?>"><br>
							내용 : <input type="text" name="content" value="<?= $content ?>"><br>
							<input type="submit" value="수정">
							<input type="button" onclick="location.href='/company/board/detail?idx=<?= $idx ?>';" value="취소">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
