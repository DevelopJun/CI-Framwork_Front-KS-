<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- 토큰 쿠키 저장 연결 js 파일-->
<script src="/js/Ajax/setcookie.js"></script>
<!-- Ajax 공통 모듈 연결 js 파일-->
<script src="/js/Ajax/Ajax(common).js"></script>
<script>
function madetime(){
    var dateo = new Date();
    var time = dateo.getTime();
    var expireTime = time + timeset; // 현재 쿠키 만료 약 30초 설정(테스트 진행)
    dateo.setTime(expireTime);
    var final = dateo.setTime(expireTime);
    console.log(localStorage.getItem('time'));
    if (localStorage.getItem('time') == null){
        localStorage.setItem('time', final);
    }
	document.cookie = 'jwt_token=<?= $_SESSION['admin']['sAccessToken'] ?>;expires='+ dateo +';path=/';
};
madetime();
</script>

<script>
	$(document).ready(function() {
        console.log('<?= $date ?>');
        const Toast = Swal.mixin({
        toast: true,
        position: 'center-center',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: '조금만 기다려주세요, 게시판을 불러오고 있습니다.'
    })
		AJAX.get(getCookie('jwt_token')); // Ajax 공통모듈 분리 완료.
		dTCreate("board", "/api/v1/ksadmin/admin/board", Cols, '20','','search');
	});


	var Cols = function(){
		var Cols = [];

		Cols.push({ "data": null,"title":"No",width:'3%',render:function(data, type, row, meta){
			return '--';
		}});
		Cols.push({ "data": null, "title": "제목", "name":"", render: function (data){
			html = '<a href="/company/board/detail?idx=' + data.idx + '">' + data.title + '</a>';
			return html;
		}});
		Cols.push({ "data": null , "title": "이름(id)", "name":"", render: function (data){
			html = data.name + ' (' + data.admin_id + ')';
			return html;
		}});
		Cols.push({ "data": "create_date" , "title": "생성일", "name":"" });
		Cols.push({ "data": "update_date" , "title": "수정일", "name":"" });
		return Cols;
	}
</script>
<div class="row">
	<div class="col-md-12 col-lg-12">
		<div class="mb-3 card">
			<div class="card-header-tab card-header-tab-animation card-header">
				<div class="card-header-title">
					<i class="header-icon lnr-apartment icon-gradient bg-love-kiss"></i>
					AJAX 호출 테스트
				</div>
			</div>

			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="tabs-eg-77" style="min-height: 400px">
						<a href="/company/board/write">작성하기</a>
						<table id="board" class="table display nowrap" >
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/js/topclock.js"></script>
