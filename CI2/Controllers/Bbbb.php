<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class Bbbb extends BaseController {
	public function __construct(){
	}

	public function index(){
		$sUrl = "http://1.234.15.180/todos";
		$oCurl = curl_init();
		curl_setopt($oCurl, CURLOPT_URL, $sUrl);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		$sResponse = curl_exec($oCurl);
		$aInfo = json_decode($sResponse, true);
		echo "<pre>";
		print_r($aInfo);
		echo "<pre>";
	}

	public function test(){
    /*
		$sUrl = "http://1.234.15.179/php/info";
		$oCurl = curl_init();
		curl_setopt($oCurl, CURLOPT_URL, $sUrl);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_HEADER, true);//헤더 정보를 보내도록 함(*필수)
		curl_setopt($oCurl, CURLOPT_HTTPHEADER, $aHeader); //header 지정하기
		$sResponse = curl_exec($oCurl);
		$aToken_info = json_decode($sResponse, true);
		echo "<pre>";
		// response 내용
		print_r($sResponse);

		// response body
		print_r($aToken_info);
		echo "<pre>";
    */
    echo "test page";
	}

  public function test1(){
    echo "testing now...";
  }







}
