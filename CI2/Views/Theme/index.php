<script>
	function call(){
		$.ajax({
			type: "GET",
			//url: "http://1.234.15.180/ksadmin/admin/board",
			url: "http://1.234.15.179/api/v1/ksadmin/admin/board",
			success: function (data){
				console.log(data);
			},
			fail: function (data){
				console.log(data);
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
					AJAX 호출 테스트
				</div>
			</div>
			<div class="card-body">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="tabs-eg-77" style="min-height: 400px">
						<button onclick="call();">call API</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>