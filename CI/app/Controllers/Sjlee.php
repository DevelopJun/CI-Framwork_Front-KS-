<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\util\Util;
class Sjlee extends BaseController {
	public function __construct(){
	}

	public function token(){
		$aParams = [
			'client_id' => 'ksadmin',
			'client_secret' => 'ksadmin',
			'grant_type' => 'password',
			'username' => 'sjlee4628',
			'password' => 'testpass'
		];
		// oAuth 서버 정보
		$sUrl = "http://1.234.15.178/oauth/token";
		$oCurl = curl_init();
		curl_setopt($oCurl, CURLOPT_URL, $sUrl);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POST, true);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aParams);
		$sResponse = curl_exec($oCurl);
		$aToken_info = json_decode($sResponse, true);
		echo "<pre>";
		print_r($aToken_info);
		echo "<pre>";
	}

	public function phpapicall(){
		$sUrl = "http://1.234.15.179/php/info";
		$sAccessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJjdXN0b20iOiJtYWtlIHlvdXIgb3duIGp3dCBwYXlsb2FkIiwiaWQiOiJmYzE5OWRiZWRhNzBhMjBkMWY4OTM0MjU4MzFhMGY1NjRjOTdlYTk2IiwianRpIjoiZmMxOTlkYmVkYTcwYTIwZDFmODkzNDI1ODMxYTBmNTY0Yzk3ZWE5NiIsImlzcyI6ImxvY2FsaG9zdDo4MDgyIiwiYXVkIjoia3NhZG1pbiIsInN1YiI6InNqbGVlNDYyOCIsImV4cCI6MTYyNjMzNTgzNywiaWF0IjoxNjI2MzM0MDM3LCJ0b2tlbl90eXBlIjoiYmVhcmVyIiwic2NvcGUiOm51bGx9.L-HPUltpAgr4msTSjGIEOsJ-1l_JtDDL5KJtcC_snvaOoTkDczrzl3RoB5Dh8_TJ-PRiydxzaAYdqdVN03V4iPRuL-x1AQ_7WfoKJwqZjSNce7DvTggQgZ025CSeEmRtHsnmNxqtkKTOhMCy-sbciNpRUIPmnsMeFEL9Qa0PG2mg5m-5SrFVxm0E6OOKyDhIFkfImbG4YJq-IPd2F3WsmOEDtbILfHbk38BCX2ubU5b7Za8v6XHkLUOmKxJmXUYwAODlJ2jTCHgZ8Q-8Q6m9AbP_iWb_2gUmG5x2MV4kzuC3Fy7f1YXqKea0SWBBGlSNDo9Z7kbMg0zFPJnZmKYguA';
		$aHeader = [
			'Authorization: Bearer '.$sAccessToken,
			'Content-Type: application/json'
		];
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
	}

	public function testing(){
		$aTest = Util::api_request('/todos', 'POST', ['title'=>'testing', 'content'=>'10101010101010101010']);

		echo '<pre>';
		print_r($aTest);
		echo '</pre>';
	}
}
