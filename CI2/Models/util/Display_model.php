<?php

namespace App\Models\util;

use App\Models\DB;

class Display_model
{
	public $aLayout = array("form" => "", "data" => array());					//기본 header, left, content, footer에 넣는 메인 폼
	public $aHeader = array("form" => "", "data" => array("aLib" => array()));	//상단 js, css 호출하는 form
	public $aTop = array("form" => "", "data" => array());						//메뉴를 보여는 폼
	public $aLeft = array("form" => "", "data" => array());						//메뉴를 보여는 폼
	public $aFooter = array("form" => "", "data" => array());					//하단 메뉴 정보를 보여주는 form
	public $aParser = null;
	public $response;

	public function __construct()
	{
		$this->aParser = \Config\Services::parser();

		$this->aHeader["form"] = "v1_layout/header";
		$this->aTop["form"] = "v1_layout/top";
		$this->aLeft["form"] = "v1_layout/left";
		$this->aFooter["form"] = "v1_layout/footer";
		$this->aLayout["form"] = "v1_layout/main_form";
	}

	public function init_Navi(){

		// $this->aTop['data'] = ['testing'=>'now'];
		// $this->aLeft['data'] = ['testing'=>'next'];

		$oKn = new DB('ks_navigation', 'ksadmin');
		$aData = $oKn->GetData();
		// $oKn->where('kn_name', $aData['kn_name']);
		// print_r(gettype(count($aData)));
		// print_r($aData[0]);

		$i = 0;
		$aReturnTop = [];
		$aReturnSide = [];

		while($i < count($aData)){
			$valuesArray = array_values($aData[$i]);
			// array_push($aReturnVriable, [
			// 	'kn_name'=> $valuesArray[1],
			// 	'kn_url'=> $valuesArray[2],
			// 	'kn_depth'=> $valuesArray[3],
			// 	'kn_depth1'=> $valuesArray[4],
			// ]);
			if($valuesArray[3] == 0 ){
				array_push($aReturnTop, $valuesArray[1]);
			}else{
				array_push($aReturnSide, $aData[$i]);
			}
			$i ++;
		}

		$valuesArray1 = array_values($aReturnTop);
		print_r($valuesArray1[0]);
		print_r($valuesArray1[1]);


		$this->aTop['data'] = ['test1'=>$valuesArray1[0], 'test2' => $valuesArray1[1]];
		// $this->aTop['data'] = ['testing'=>$valuesArray1[1]];
		//
		// print_r($aReturnTop);
		// echo "<br>";
		// print_r($aReturnSide);


		return;


		// print_r($aReturnVriable);


		//
		// $valuesArray1 = array_values($aData[0]);
		//
		//
		// $valuesArray2 = array_values($aData[1]);
		// $valuesArray3 = array_values($aData[2]);


		// json 추출 실패 -> json 추출시 string으로 되기 때문에 key, value 뽑기 힘듬//
/*
		$jData =  json_encode($aData); // array json 변환
		print_r($jData);
		print_r(gettype($jData));
		print_r($jData[0]['kn_name']);
		foreach ($jData[0]['data'] as $field => $value) {
 }
		json_encode($aData) // array json 변환
		print_r($aData);
		print_r(gettype($aData));*/
		//
		// $Data1 = [
		// 	'kn_name'=> $valuesArray1[1],
		// 	'kn_url'=> $valuesArray1[2],
		// 	'kn_depth'=> $valuesArray1[3],
		// 	'kn_depth1'=> $valuesArray1[4],
		// ];
		//
		//
		// $Data2 = [
		// 	'kn_name'	=> $valuesArray2[1],
		// 	'kn_url'	=> $valuesArray2[2],
		// 	'kn_depth'=> $valuesArray2[3],
		// 	'kn_depth1'=> $valuesArray1[4],
		// ];
		// $Data3 = [
		// 	'kn_name'	=> $valuesArray3[1],
		// 	'kn_url'	=> $valuesArray3[2],
		// 	'kn_depth'=> $valuesArray3[3],
		// 	'kn_depth1'=> $valuesArray1[4],
		// ];


		// return $this->parse($sContent, $aData, true);
		//
		//
		// $parser->setData($data)
		//
		// if(데이터 관련 관련 조건문 삽입){
		// 	return $this->display->load('/index', $kData, true);
		// }
		// else{
		// 	return $this->display->load('/index', $lData, true);
		// }


		// $this->aTop['data'] = [];
		// $NO = 0;
		// $_topmenu_html = "";
		// foreach($_topmenu_arr as $key => $val)
		// {
		// 	if($NO==0) $_topmenu_html .= "<li style='margin-left:1px'>";
		// 	else $_topmenu_html .= "<li>";
		//
		// 	if(in_array($val[0]['kn_url'],$_topmenu_url_arr) && $val[0]['kn_url']!="" && $val[0]['kn_url']!="/"){ // 권한이 있으면 그대로 보여준다.
		// 		$kn_url_A = $val[0]['kn_url'];
		// 	}else{ // 권한이 없으면 첫번째 소분류 메뉴로 링크
		// 		$kn_url_A = $_submenu_arr[$val[0]['kn_first_code']][0]['kn_url'];
		// 	}
		//
		// 	$_topmenu_html .= "<a href='".$kn_url_A."' onmouseover='change_bg(".$change_bg_arr[$NO].");' >".$val[0]['kn_group_name']."</a>";
		//
		// 	$_topmenu_html .= "<ul class='first_dept' style='width:600px'>";
		// 		foreach($val as $val2)
		// 		{
		// 			$_topmenu_html .= "<li>";
		//
		// 			if(in_array($val2['kn_url'],$_topmenu_url_arr) && $val2['kn_url']!="" && $val2['kn_url']!="/"){
		// 				$kn_url_B = $val2['kn_url'];
		// 			}else{
		// 				$kn_url_B = $_submenu_arr[$val2['kn_first_code']][0]['kn_url'];
		// 			}
		//
		// 			$_topmenu_html .= "<a href='".$kn_url_B."'>".$val2['kn_first_name']."</a>";
		//
		//
		// 			if(is_array($_submenu_arr[$val2['kn_first_code']])){
		// 				$_topmenu_html .= "<ul class='dropdown-menu' style='z-index:1000; position:absolute; width:260px !important; padding:10px;'>";
		// 				foreach($_submenu_arr[$val2['kn_first_code']] as $val3){
		// 					$_topmenu_html .= "<li><a href='".$val3['kn_url']."'>".$val3['kn_second_name']."</a></li>";
		// 				}
		// 				$_topmenu_html .= "</ul>";
		// 			}
		// 			$_topmenu_html .= "</li>";
		// 		}
		// 	$_topmenu_html .= "</ul>";
		// 	$_topmenu_html .= "</li>";
		// 	$NO++;
		// }
		//
		//
		// $this->aLeft['data'] = [];
		// $_leftmenu_html = "";
		// if($result_A)
		// {
		// 	if($result_A['kn_depth']=="1"){
		// 		$kn_group = $result_A['kn_group'];
		// 	} else if($result_A['kn_depth']=="2") {
		// 		// 같은 소분류 구하기.
		// 		$sql_B = "SELECT * FROM ks_navigation_new WHERE kn_disp_flag='Y' AND kn_first_code = '".$result_A['kn_first_code']."' AND kn_depth='1' ORDER BY kn_ord_no ASC LIMIT 0,1";
		// 		$result_B = $this->oDb->FetchOne($sql_B);
		// 		$kn_group = $result_B['kn_group'];
		// 	}
		//
		// 	$_leftmenu_html .= "<div class='subtop'>";
		// 		$_leftmenu_html .= "<ul>";
		// 			$_leftmenu_html .= "<li style='font-size:11pt;'>".$_topmenu_arr[$kn_group][0]['kn_group_name']."</li>";
		// 			foreach($_topmenu_arr[$kn_group] as $key => $val)
		// 			{
		// 				if(in_array($val['kn_url'],$_topmenu_url_arr) && $val['kn_url']!="" && $val['kn_url']!="/") $kn_url_B = $val['kn_url'];
		// 				else $kn_url_B = $_submenu_arr[$val['kn_first_code']][0]['kn_url'];
		//
		// 				if($result_A['kn_first_code']==$val['kn_first_code'])
		// 				{
		// 					if(is_array($_submenu_arr[$val['kn_first_code']]))
		// 					{
		// 						$_leftmenu_html .= "<li class='listm_on'><span style='font-weight:bold;'>".$val['kn_first_name']."</span></li>";
		//
		// 						 foreach($_submenu_arr[$val['kn_first_code']] as $val2)
		// 						{
		// 							if($result_A['kn_idx']==$val2['kn_idx']) $_leftmenu_html .= "<li class='listm_l'><a href='".$val2['kn_url']."' class='left_subtitle'><span style='font-weight:bold;color:red;'>".$val2['kn_second_name']."</span></a></li>";
		// 							else $_leftmenu_html .= "<li class='listm_l'><a href='".$val2['kn_url']."' class='left_subtitle'>".$val2['kn_second_name']."</a></li>";
		// 						}
		// 					}
		// 					else  $_leftmenu_html .= "<li class='listm_on'><a href='".$kn_url_B."'><span style='font-weight:bold;color:red;'>".$val['kn_first_name']."</span></a></li>";
		// 				}
		// 				else $_leftmenu_html .= "<li class='listm'><a href='".$kn_url_B."'><span style='font-weight:bold;'>".$val['kn_first_name']."</span></a></li>";
		// 			}
		// 		$_leftmenu_html .= "</ul>";
		// 	$_leftmenu_html .= "</div>";
		// }

	}

	public function setResponse($response) {
		$this->response = $response;
	}

	/*
	header의 원하는 형식의 script나 특정 외부 라이브러리 추가후 사용하는 형식
	적용 시키는 모듈이 view/header 폴더 안에 있어야 작동
	예) $this->display->setLib("daterangepicker");
	*/
	public function setLib($sLib)
	{
		if ($sLib) { //sLib의 값이 존재 해야 작동
			$this->aHeader["data"]["aLib"][] =  array("html" => view("header/".$sLib, array(), ['saveData' => true]));
		}
	}

	public function setHeader($sForm)
	{
		$this->aHeader["form"] = $sForm;
	}

	public function setTop($sForm)
	{
		$this->aTop["form"] = $sForm;
	}

	public function setLeft($sForm)
	{
		$this->aLeft["form"] = $sForm;
	}

	public function setLayout($sForm)
	{
		$this->aLayout["form"] = $sForm;
	}

	public function setFooter($sForm)
	{
		$this->aFooter["form"] = $sForm;
	}

	public function setDisplay($sHeader, $sTop, $sLeft, $sFooter, $sLayout)
	{
		$this->aHeader["form"] = $sHeader;	//header 기본 폼
		$this->aTop["form"] = $sTop;		//left 기본 폼
		$this->aLeft["form"] = $sLeft;		//left 기본 폼
		$this->aFooter["form"] = $sFooter;	//footer 기본 폼
		$this->aLayout["form"] =  $sLayout;	//Main 폼
	}

	//디스플레이 출력
	public function load($sContent, $aData = array(), $bParser = false)
	{
		// $parser = \Config\Services::parser();
		$this->init_Navi();

		print_r($this->aTop["data"]);
		// $this->aTop["data"];
		// print_r($this->aLeft["data"]);
		// $this->aLeft['data'] = $aData1;
		// $this->parser->render();
		// echo $parser->setData($finaldata)->render('top.php');

		$aLayout = $this->aLayout["data"]; //Layout 기본 데이터
		$this->aHeader["data"]["TITLE"] = "testing";
		$aLayout["header"] = $this->parse($this->aHeader["form"], $this->aHeader["data"], true);
		$aLayout["top"] = $this->parse($this->aTop["form"], $this->aTop["data"], true);

		$aLayout["left"] = $this->parse($this->aLeft["form"], $this->aLeft["data"], true);

		if ($bParser) { //내용을 파서로 처리하는 경우
			$aLayout["content"] = $this->parse($sContent, $aData, true);
		} else {
			$aLayout["content"] = view($sContent, $aData);
		}
		$aLayout["footer"] = $this->parse($this->aFooter["form"], $this->aFooter["data"], true);
		return view($this->aLayout["form"], $aLayout);
	}

	//결과 반환
	//성공 success
	//실패 fail
	public function result($bResult, $sMsg, $aData = null)
	{
		$aResult = array();
		if ($bResult) {
			$aResult["success"] = $sMsg;
		} else {
			$aResult["fail"] = $sMsg;
		}
		if ($aData) $aResult["data"] = $aData;

		return $this->response->setContentType('application/json')->setJSON($aResult);
	}

	//Array 형태 그대로 반환이 필요 한 경우
	public function data_result($aData)
	{
		return $this->response->setContentType('application/json')->setJSON($aData);
	}
	//parse 템플릿 Data Key있는
	/*
	예)
	Data 형식
	Array(
	"aAdmin"=>Array(
				Array("name"=>"1234"),
				Array("name"=>"2345")
			 )
	);
	//템플릿 사용 형식
	{aAdmin}
		{name}
	{/aAdmin}
	*/
	//$sContent(view 파일), $aData(parse될 데이터), $bReturn 데이터로 반환 여부 (true string 반환, false 출력)
	public function parse($sContent, $aData, $bReturn = true)
	{
		if (!$aData) $aData = array(); //데이터가 없는 경우 빈 Array 입력
		if ($sContent == ''){
			$sHtml = '';
		} else {
			$sHtml = $this->aParser->setData($aData)->render($sContent);
		}
		if ($bReturn) {

			return preg_replace("/({!?\w+!?})/", "", $sHtml);

		} else {
			return $this->output->append_output(preg_replace("/({!?\w+!?})/", "", $sHtml));
		}
	}

	/*select option 만드는 함수
	1. 매개변수($aOptData)
	option의 value는 code, 표시값은 code_name Array(Array("code"=>"1","code_name"=>"1234"))
	배열만 있는 경우 value, 표시값 동일하게 매칭 Array("1","2","3")

	2. 매개변수 ($aSelectCode)
	option값중 선택 Array로 반환시 다중 선택
	*/
	public function getOption($aOptData, $sSelectCode = '')
	{
		$aOpt = array();
		$aSelect = explode(',', $sSelectCode);
		foreach ($aOptData as $sKey => $nOpt) {
			$sSelect = ""; //option 선택여부
			$sCode = ""; //option value값
			$sName = ""; //option display name
			$option = "";
			if (is_array($nOpt)) {
				$sCode = $nOpt["code"];
				$sName = $nOpt["code_name"];
				if (!empty($nOpt['option'])) {
					$option = $nOpt['option'];
				}
			} else {
				if (is_numeric($sKey)) { //key값이 있으면 key값을 value 값으로
					$sCode = $nOpt;
				} else {
					$sCode = $sKey;
				}

				$sName = $nOpt;
			}
			if ((is_array($aSelect) && count($aSelect) > 1 && in_array($sCode, $aSelect)) || $sCode == $sSelectCode) {
				$sSelect = "selected";
			}
			$aOpt[] = "<option value='".$sCode."' ".$sSelect." data-option='".$option."'>".$sName."</option>";
		}
		return implode('\n', $aOpt);
	}

	//Array를 tr안에 td값으로 만들어주는 함수
	public function getTable($aArray)
	{
		$sHtml = "<tr>";
		foreach ($aArray as $nArray) {
			$sHtml .= "<td>" . $nArray . "</td>";
		}
		$sHtml .= "</tr>";
		return $sHtml;
	}

	//alert 보여주는 함수
	public function doAlert($sMsg = "")
	{
		return $this->parse('v1_layout/doalert', ['sMsg' => $sMsg], true);
	}

	//msg가 있으면 msg를 alert해주고 back해주는 함수
	public function doBack($sMsg = "")
	{
		return $this->parse('v1_layout/doback', ['sMsg' => $sMsg], true);
	}
}
