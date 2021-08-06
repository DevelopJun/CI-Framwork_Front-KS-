
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
    var expireTime = time + timeset; // 현재 쿠키 만료 약 30초 설정(테스트 진행)
}else{
    var expireTime = 0; // 새로고침시. cookie 가중 증가 문제. 초기화 세팅.
    var expireTime = time + timeset; // 현재 쿠키 만료 약 30 초 설정(테스트 진행)
}
i++ ;
date.setTime(expireTime);
compare = expireTime;
document.cookie = 'jwt_token=<?= $_SESSION['ksadmin']['sAccessToken'] ?>;expires='+date+';path=/';
</script>


<script>
	function write(){



        var date = new Date();
        var timec = date.getTime();
        if (timec <= compare){
            console.log("쿠키 만료되기 전에 정상적으로 작성 되었습니다.");
            var form = document.writeform;
            if (!$("input[name=title]").val()){
                alert("제목을 입력해주세요.");
                return;
            }
            if (!$("input[name=content]").val()){
                alert("내용을 입력해주세요.");
                return;
            }
            // 여기서 수정을 해야하는데, 어떻게 설계해야할지. 현재 그래서 api_request를 통해서 재 발급 받는 방법은 무엇인가?
            
            <?=
             if (!$aOauthRes = oauth_request(['refresh_token' => $_SESSION['ksadmin']['sRefreshToken'], 'refresh_token' => $_SESSION['ksadmin']['sAccessToken']], 'refresh_token')){
                // oauth token reflash error
                return ['code' => '401', 'message' => 'authorization require'];
            }
            $aRes = api_request_action($sPath, $sMethod, $aParam);
        }
        ?>
            AJAX.post( "https://apigw.ksdev.net/api/v1/ksadmin/admin/board", $(form), getCookie('jwt_token')); // Ajax 공통모듈 분리 완료
        } else {
            console.log("쿠키가 만료되어 글을 작성할 수 없습니다.");
            alert("쿠키가 만료되어 글을 작성할 수 없습니다.");
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
