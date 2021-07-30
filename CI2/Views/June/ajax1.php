
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- <script src="script.js"></script> -->
<script>

$(function(){
	$('#call').click(function(){
		$('#show').html('.....loading...'); // .html은 선택한 요소의 내용을 가져오거나, 다른 내용으로 바꿈.

		var token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpbmZvIjp7ImlkeCI6IjI3NTMiLCJpZCI6IndqZHduc2doMzIxIiwibmFtZSI6Ilx1YzgxNVx1YzkwMCoqKioqKioifSwiYm91bmRhcnkiOiJrc19hZG1pbiIsImlkIjoiYzU0ZjFjNDlmMGQ5MjhiOTcxYWRiODk1OGQ1Nzc5N2Y3Njc4MzY4NyIsImp0aSI6ImM1NGYxYzQ5ZjBkOTI4Yjk3MWFkYjg5NThkNTc3OTdmNzY3ODM2ODciLCJpc3MiOiJsb2NhbGhvc3Q6ODA4MiIsImF1ZCI6ImtzYWRtaW4iLCJzdWIiOiJ3amR3bnNnaDMyMSIsImV4cCI6MTYyNzYyMTkzMywiaWF0IjoxNjI3NjIwMTMzLCJ0b2tlbl90eXBlIjoiYmVhcmVyIiwic2NvcGUiOm51bGx9.lEUUz0Sj0zbj7DWofYFtQny0NpncKxLodiIqDWzjoTjac5SGH4dc2Kqtwat_k6lSUwDmtCxNew6FTOKcl5Ubn8X2ELq97rIcBOZ8mZEe2OlUpkOObLCKkjJoD6uPcXmvBy_mqucAehJoaxI84La5lwow8jDGkM5V4090hOsZQd3RcAMsPc9PdOP42osVE7jOxxekuEl7k0l7UtVFtS-12RKNQKcI4aa_YWMMgIq5Qwbuk63Xn-zuSfc8H5H6VfZ-WY2muBGbKk9gFaT3-bLo9pE24ByFpvWXtWGq6q9xcIRvKSB25HEURjJaS4HIluo6OYibOgsJduKAENJp97pySA';
		var header = [
			'Authorization: Bearer '+ token,
			'Content-Type: application/json'
		];

		$.ajax({
			type: "GET", // POST, GET
			url : "http://1.234.15.179/api/v1/ksadmin/admin/board", // 180 호출
			// async: false,
			// datatype : "json", //json
			// beforeSend : function(xhr){
			//     xhr.setRequestHeader(token, header)
			// },
			success:function(data){
				$('#show').html(JSON.stringify(data['data'][0]));
				console.log(data['data'][0]);
			 }
			})
	})
})

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
						<button type="button" class="btn btn-success" id="call">Data Api 추출</button>
						<br>
  						<p id="show"></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
