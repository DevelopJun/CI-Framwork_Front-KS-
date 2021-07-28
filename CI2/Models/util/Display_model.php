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
		$oKn = new DB('ks_navigation', 'ksadmin');

		// 3중 for문 이외의 query 조회시 정렬하여 받아올 수 있도록 table 수정
		$oKn->Where("kn_display_flag = 'Y'");
		$oKn->Where("kn_depth = '0'");
		// print_r($oKn);
		$aRoot = $oKn->GetData();
		$this->aTop['data'] = [];
		print_r($aRoot);

		foreach ($aRoot as $nKey1 => $nRoot){
			$this->aTop['data'][$nKey1] = [
				'name' => $nRoot['kn_name'],
				'url' => $nRoot['kn_url'],
				'child' => []
			];

			$oKn->Where("kn_display_flag = 'Y'");
			$oKn->Where("kn_depth = '1'");
			$oKn->Where("kn_first_idx = '".$nRoot['kn_idx']."'");
			$aFirst = $oKn->GetData();
			foreach ($aFirst as $nKey2 => $nFirst){
				$this->aTop['data'][$nKey1]['child'][$nKey2] = [
					'name' => $nFirst['kn_name'],
					'url' => $nFirst['kn_url'],
					'child' => []
				];
				$oKn->Where("kn_display_flag = 'Y'");
				$oKn->Where("kn_depth = '2'");
				$oKn->Where("kn_second_idx = '".$nFirst['kn_idx']."'");
				$aSecond = $oKn->GetData();
				foreach ($aSecond as $nKey3 => $nSecond){
					$this->aTop['data'][$nKey1]['child'][$nKey2]['child'][$nKey3] = [
						'name' => $nSecond['kn_name'],
						'url' => $nSecond['kn_url']
					];
				}
			}
		}
		/*
		echo "<pre>";
		print_r($this->aTop['data']);
		echo "</pre>";
		*/

		$oKn = new DB('ks_navigation', 'ksadmin');
		$oKn->Where("kn_display_flag = 'Y'");
		$oKn->Where("kn_url = '".$_SERVER['REQUEST_URI']."'");
		$aLocation = $oKn->GetDataOne();
		if ($aLocation){
			// 해당하는 location의 상위, 동위, 하위 조회(order by로 정렬하여)
		}
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
		$this->init_Navi();
		$aLayout = $this->aLayout["data"]; //Layout 기본 데이터
		$this->aHeader["data"]["TITLE"] = "testing";
		$aLayout["header"] = $this->parse($this->aHeader["form"], $this->aHeader["data"], true);
		$aLayout["top"] = view($this->aTop["form"], $this->aTop['data']);
		$aLayout["left"] = view($this->aLeft["form"], $this->aLeft['data']);

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
