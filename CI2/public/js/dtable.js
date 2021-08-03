/**
* @brief 기본 원형 테이블 
* @details 테이블 생성
* @author 김경승
* @param tablename : 생성 시킬 테이블 명, url: 테이블 목록 불러올 URL,Cols : 테이블 보여줄 열 정보, listsize :초기 page값, callback: 테이블 그리고 실행 시킬 함수, addParam: 기본형태에서 추가되는 파라메터,reload:데이터만 다시 로드 (기본값은 true),showbutton:추가기능 및 버튼 사용 여부 (기본값은 true) 
* @return 생성된 데이터 테이블
*/
var fDefTable = function(tablename,url,Cols,params,listsize,order,callback,addParam ={},reload=true,showbutton=true){
	if ($.fn.DataTable.isDataTable("#"+tablename) && reload) {
		$("#"+tablename).DataTable().ajax.reload();
	}else{
		if($.fn.DataTable.isDataTable("#"+tablename)){
			$("#"+tablename).DataTable().clear().destroy();
			$("#"+tablename).empty(); // 컬럼 변경 위해 해당 옵션 추가
		}
		var Cols = Cols();

		$(Cols).each(function(k){
			
			if(this.searchable == true){
				Cols[k].searchable = true;
			}else{
				Cols[k].searchable = false;
			}
			if(this.orderable == true) {
				Cols[k].orderable = true;
			}else {
				Cols[k].orderable = false;
			}
		});
		var tableParams ={};
		if(showbutton){
			tableParams["dom"] =`<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
				<'row'<'col-sm-12'tr>>
				<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`;
			tableParams["buttons"]= [{extend: 'colvis',text: 'Columns',},];
		}
		var pageLength = 20;
		var pageStart = 0;
		if(jQuery.isNumeric(listsize)) {
			pageLength = listsize;
		}else {
			pageLength = listsize.pageLength;
			pageStart = listsize.pageStart;
		}
		 tableParams =  {
			responsive: true,
			processing: true,
			serverSide: true,
			autoWidth: true,
			//select: true,
			searching:false,
			order: order,
			"ajax": {
				"url": "http://apigw.ksdev.net" + url,
				"type": "GET",
				"data": function(data) {
					data.data = params();
				},
				
			},
			columns: Cols,
			"language": GetKoLocale(),
			lengthMenu: [5, 20, 40, 60, 80, 100],
			pageLength: pageLength,
			displayStart: pageStart,
			drawCallback: callback,
		};
		if(addParam){//기본에서 추가된 정보 있으면 추가한다.
			for(n in addParam){
				tableParams[n] = addParam[n];
			}
		}
		return $("#"+tablename).DataTable(tableParams);
	}
}

//기본 형식의 테이터 테이블만 구현
var Dtable = {
	Search: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = "",addParam = {}){
		addParam["searching"] = true;
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam);
	},
	SearchPage: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = "",addParam = {}){
		addParam["searching"] = true;
		addParam["stateSave"] = true;
		return fDefTable(tablename,url, Cols, params, listsize,order,callback);
	},
	Make: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = "",addParam= {},reload,showbutton){
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam,reload,showbutton);
	},
	Select: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = "",addParam = {}){
		addParam["select"] = {style: 'multi'};
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam);
	}
}
var DtableNonBtn = {
	Search: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = ""){
		var addParam = {searching:true,buttons: []};
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam);
	},
	SearchPage: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = ""){
		var addParam = {searching:true,stateSave: true,buttons: []};
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam);
	},
	Make: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = ""){
		var addParam = {buttons: []};
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam);
	},
	Select: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = ""){
		var addParam = {select: {style: 'multi'},buttons: []};
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam);
	},
}
//기본 형식에서 html 복사하거나 다양한 execl 형태의 다운 로드 추가한 버전
var DtableBtn = {
	Search: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = ""){
		var addParam = {buttons: [	{	
										extend: 'collection',
										text: 'Export',
										buttons: [ 'print',	'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ],
									},
									{
										extend: 'colvis',
										text: 'Columns'
									}
								],
						searching:true
		};
		return fDefTable(tablename,url, Cols, params, listsize,order,callback,addParam);
	},
	Make: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = ""){
		var addParam = {buttons: [	{	
										extend: 'collection',
										text: 'Export',
										buttons: [ 'print',	'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ],
									},
									{
										extend: 'colvis',
										text: 'Columns'
									}
								]
		};
		return fDefTable(tablename, url, Cols, params, listsize, order, callback, addParam);
	},
	Select: function(tablename, url, Cols, params, listsize = 10 ,order = [], callback = ""){
		var addParam ={	buttons: [	{	
										extend: 'collection',
										text: 'Export',
										buttons: [ 'print',	'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ],
									},
									{
										extend: 'colvis',
										text: 'Columns'
									}
								],
						select: {style: 'multi'}
		};
		return fDefTable(tablename, url, Cols, params, listsize, order, callback, addParam);
	},

	
}

//기본 형식에서 테이블을 그룹 형태로 지정 할수 있도록 하는 기능 추가한 함수 group = [] 동일한 값을 그룹형태로 보여질 값 선택(특정 값 지정 : 'second:name', 열번호 지정(열 번호) : 0 ,2 )
var DtableGrp = {
	Search: function(tablename, url, Cols, params, listsize = 10 ,group = [], callback = ""){
		var addParam = {rowsGroup: group, searching:true};
		return fDefTable(tablename, url, Cols, params, listsize, [], callback, addParam);
	},
	Make: function(tablename, url, Cols, params, listsize = 10 ,group = [] ,callback = ""){
		var addParam = {rowsGroup: group};
		return fDefTable(tablename, url, Cols, params, listsize, [], callback, addParam);
	},
	Select: function(tablename, url, Cols, params, listsize = 10 , group = [] , callback = ""){
		var addParam = {rowsGroup: group, select: {style: 'multi'}};
		return fDefTable(tablename, url, Cols, params, listsize, [], callback, addParam);
	},
};

//기본 형식에서 테이블을 그룹 형태로 지정 할수 있도록 하는 기능 추가한 함수 group = [] 동일한 값을 그룹형태로 보여질 값 선택(특정 값 지정 : 'second:name', 열번호 지정(열 번호) : 0 ,2 )
//기본 형식에서 html 복사하거나 다양한 execl 형태의 다운 로드 추가한 버전
var DtableGrpBtn = {
	Search: function(tablename, url, Cols, params, listsize = 10 ,group = [], callback = ""){
		var addParam = {buttons: [	{	
										extend: 'collection',
										text: 'Export',
										buttons: [ 'print',	'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ],
									},
									{
										extend: 'colvis',
										text: 'Columns'
									}
								],
						rowsGroup: group,
						searching:true
		};
		return fDefTable(tablename,url, Cols, params, listsize,[],callback,addParam);
	},
	Make: function(tablename, url, Cols, params, listsize = 10 ,group = [], callback = ""){
		var addParam = {buttons: [	{	
										extend: 'collection',
										text: 'Export',
										buttons: [ 'print',	'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ],
									},
									{
										extend: 'colvis',
										text: 'Columns'
									}
								],
						rowsGroup: group
		};
		return fDefTable(tablename, url, Cols, params, listsize, [], callback, addParam);
	},
	Select: function(tablename, url, Cols, params, listsize = 10 ,group = [], callback = ""){
		var addParam = {buttons: [	{	
										extend: 'collection',
										text: 'Export',
										buttons: [ 'print',	'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ],
									},
									{
										extend: 'colvis',
										text: 'Columns'
									}
								],
						rowsGroup: group,
						select: {style: 'multi'}
		};
		return fDefTable(tablename, url, Cols, params, listsize, [], callback, addParam);
	},

	
};

//데이터 테이블 보여줄 정보
var GetKoLocale = function(){
	return {
		"sEmptyTable":     "데이터가 없습니다",
		"sInfo":           "_START_ - _END_ / _TOTAL_",
		"sInfoEmpty":      "0 - 0 / 0",
		"sInfoFiltered":   "(총 _MAX_ 개)",
		"sInfoPostFix":    "",
		"sInfoThousands":  ",",
		"sLengthMenu":     "_MENU_",
		"sLoadingRecords": "읽는중...",
		"sProcessing":     '<div class="loader-wrapper d-flex justify-content-center align-items-center" style="padding-top:100px"><div class="loader"><div class="ball-scale"><div></div></div></div></div>',
		"sSearch":         "검색:",
		"sZeroRecords":    "검색 결과가 없습니다",
		"oPaginate": {
		"sFirst":    "처음",
		"sLast":     "마지막",
		"sNext":     ">",
		"sPrevious": "<"
		},
		"oAria": {
			"sSortAscending":  ": 오름차순 정렬",
			"sSortDescending": ": 내림차순 정렬"
		}
	};
}
