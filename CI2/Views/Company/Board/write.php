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
		$.ajax({
			type: "post",
			data: $(form).serialize(),
			contentType: "application/x-www-form-urlencoded",
			url: "http://apigw.develop.n-e.kr/api/v1/ksadmin/admin/board",
			success: function (data){
				if (data.code == 200){
					alert("입력완료");
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