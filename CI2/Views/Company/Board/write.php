<link rel="stylesheet" href="/css/June.css">

<script>
var extend = 0;
function madetime(){
    const timeset = 8000 * 10;
    var dateo = new Date();
    var time = dateo.getTime();
    var expireTime = time + timeset; // timeset 시간 설정 조율 부분
    dateo.setTime(expireTime);
    var final = dateo.setTime(expireTime);
    console.log(final);
    if (localStorage.getItem('time') == null || extend == 1 ){
        localStorage.setItem('time', final);
    }
	document.cookie = 'jwt_token=<?= $_SESSION['admin']['sAccessToken'] ?>;expires='+ dateo +';path=/';
};
madetime();
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
            AJAX.post( "https://admin-api.ksdev.net/api/v1/ksadmin/admin/board", $(form), getCookie('jwt_token')); // Ajax 공통모듈 분리 완료
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
            <div class="clock">
            </div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="tabs-eg-77" style="min-height: 400px">
						<form class="block" name="writeform" action="javascript:write()">
							<input type="hidden" name="admin_idx" value="<?= $_SESSION['info']['idx'] ?>">
                            <label for="title">	제목 : </label>
				            <input type="text" name="title" value="" placeholder="제목"><br>
                            <label for="content"> 내용 : </label>
							<input type="text" name="content" value="" placeholder="내용"><br>
							<input type="submit" value="작성">
							<input type="button" onclick="location.href='/company/board';" value="목록으로">
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
