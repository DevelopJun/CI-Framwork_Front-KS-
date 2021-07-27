<?php
namespace App\Models\util;

class Util {
	/**
	* @brief 인증 request
	* @details 
	* @author sjlee4628
	* @param 
	* @return
	*/
	public static function oauth_request($aParams = [], $sGrantType = '', $sClientId = '', $sClientSecret = ''){
		if (!$sGrantType || !$aParams){
			return false;
		}

		$sMethod = 'POST';
		$sUrl = "http://1.234.15.178/oauth/token";

		$aHeaders = [
			'Content-Type: application/json'
		];
		$aParams['grant_type'] = $sGrantType;
		if (isset($_SESSION['ksadmin']) && isset($_SESSION['ksadmin']['sClientId'])){
			$aParams['client_id'] = $_SESSION['ksadmin']['sClientId'];
		} else {
			$aParams['client_id'] = $sClientId == '' ? 'ksadmin' : $sClientId;
		}
		if (isset($_SESSION['ksadmin']) && isset($_SESSION['ksadmin']['sClientSecret'])){
			$aParams['client_secret'] = $_SESSION['ksadmin']['sClientSecret'];
		} else {
			$aParams['client_secret'] = hash('sha256', $sClientSecret == '' ? 'ksadmin' : $sClientSecret);
		}

		try {
			$oCurlSess = curl_init();
			curl_setopt($oCurlSess, CURLOPT_URL, $sUrl);
			curl_setopt($oCurlSess, CURLOPT_HTTPHEADER, $aHeaders);
			curl_setopt($oCurlSess, CURLOPT_CUSTOMREQUEST, $sMethod);
			curl_setopt($oCurlSess, CURLOPT_POSTFIELDS, json_encode($aParams));
			curl_setopt($oCurlSess, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($oCurlSess, CURLOPT_HEADER, true);
			curl_setopt($oCurlSess, CURLOPT_CONNECTTIMEOUT, 10);
			$sRtn = curl_exec($oCurlSess);
			$sHeader = curl_getinfo($oCurlSess, CURLINFO_HTTP_CODE);
			curl_close($oCurlSess);
		} catch(exception $e){
			return false;
		}

		$aResponse = explode("\r\n\r\n",$sRtn);
		$aHeader = self::header_to_array($aResponse[0]);
		if (strpos($aHeader['Content-Type'], 'application/json') !== false) {
			$body = json_decode($aResponse[1],true);
		} else {
			$body = $aResponse[1];
		}
		$aRtn = Array(
			'header' => $aHeader,
			'code' => $sHeader,
			'body' => $body
		);

		if ($aRtn['code'] != 200){
			// oauth server error or fail to login 분할 필요
			return false;
		}

		$aJWT = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $aRtn['body']['access_token'])[1]))), true);
		if (isset($_SESSION['ksadmin']) && isset($_SESSION['ksadmin']['sAccessToken'])){
			$aData = $_SESSION['ksadmin'];
			$aData['sAccessToken'] = $aRtn['body']['access_token'];
			$aData['sRefreshToken'] = $aRtn['body']['refresh_token'];
			$aData['sTokenType'] = $aRtn['body']['token_type'];
			$aData['sScope'] = $aRtn['body']['scope'];
			unset($_SESSION['ksadmin']);
		} else {
			$aData = [
				'sAdminId' => $aParams['username'],
				'sClientId' => $aParams['client_id'],
				'sClientSecret' => $aParams['client_secret'],
				'sAccessToken' => $aRtn['body']['access_token'],
				'sRefreshToken' => $aRtn['body']['refresh_token'],
				'sTokenType' => $aRtn['body']['token_type'],
				'sScope' => $aRtn['body']['scope'],
			];
		}
		$_SESSION['ksadmin'] = $aData;
		$_SESSION['info'] = $aJWT['info'];

		print_r($aJWT);

		return true;
	}

	/**
	* @brief API 호출
	* @details 
	* @author sjlee4628
	* @param 
	* @return
	*/
	public static function api_request($sPath = '', $sMethod = 'GET', $aParam = []){
		if (isset($_SESSION['ksadmin']) && isset($_SESSION['ksadmin']['sAccessToken'])){
			$aRes = self::api_request_action($sPath, $sMethod, $aParam);
			if ($aRes && $aRes['code'] == '401'){
				if (!$aOauthRes = self::oauth_request(['refresh_token' => $_SESSION['ksadmin']['sRefreshToken']], 'refresh_token')){
					// oauth token reflash error
					return false;
				}
				$aRes = self::api_request_action($sPath, $sMethod, $aParam);
			}
			
			if (!$aRes){
				// api gateway error
				return false;
			}
		} else {
			// need login
			return ['code' => '401', 'message' => 'authorization require'];
		}

		return $aRes;
	}

	/**
	* @brief 
	* @details 
	* @author sjlee4628
	* @param 
	* @return
	*/
	public static function api_request_action($sPath = '', $sMethod = 'GET', $aParam = []){
		$sAccessToken = $_SESSION['ksadmin']['sAccessToken'];
		$sUrl = "http://1.234.15.179".$sPath;
		if ($aParam && $sMethod == "GET"){
			$sUrl = $sUrl."?".http_build_query($aParam);
		}

		$aHeaders = [
			'Authorization: Bearer '.$sAccessToken,
			'Content-Type: application/json'
		];

		try {
			$oCurlSess = curl_init();
			curl_setopt($oCurlSess, CURLOPT_URL, $sUrl);
			curl_setopt($oCurlSess, CURLOPT_HTTPHEADER, $aHeaders);
			curl_setopt($oCurlSess, CURLOPT_CUSTOMREQUEST, $sMethod);
			if ($sMethod != 'GET' && $aParam){
				curl_setopt($oCurlSess, CURLOPT_POSTFIELDS, json_encode($aParam));
			}
			curl_setopt($oCurlSess, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($oCurlSess, CURLOPT_HEADER, true);
			curl_setopt($oCurlSess, CURLOPT_CONNECTTIMEOUT, 10);
			$sRtn = curl_exec($oCurlSess);
			$sHeader = curl_getinfo($oCurlSess, CURLINFO_HTTP_CODE);
			curl_close($oCurlSess);
		} catch(exception $e){
			return false;
		}

		$aResponse = explode("\r\n\r\n",$sRtn);
		$aHeader = self::header_to_array($aResponse[0]);
		if (strpos($aHeader['Content-Type'], 'application/json') !== false) {
			$body = json_decode($aResponse[1],true);
		} else {
			$body = $aResponse[1];
		}
		$aRtn = Array(
			'header' => $aHeader,
			'code' => $sHeader,
			'body' => $body
		);

		if ($aRtn['code'] == '401'){
			return ['code' => '401', 'message' => 'authorization require'];
		}

		return $aRtn['body'];
	}

	/**
	* @brief header 값을 array로 변경해주는 함수
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	public static function header_to_array($sHeader){
		$aHeader  = explode("\n",$sHeader);
		$aResult = Array();
		foreach($aHeader as $nHeader){
			$aRow = explode(":",$nHeader);
			$aRow[0] = trim($aRow[0]);
			if (!isset($aRow[1])){
				continue;
			}
			if (isset($aResult[$aRow[0]])){
				if (is_array($aResult[$aRow[0]])){
					$aResult[$aRow[0]][] = trim($aRow[1]);
				} else {
					$sTemp = $aResult[$aRow[0]];
					$aResult[$aRow[0]] = Array();
					$aResult[$aRow[0]][] = $sTemp;
					$aResult[$aRow[0]][] = trim($aRow[1]);
				}
			} else {
				$aResult[$aRow[0]] = trim($aRow[1]);
			}
		}
		return $aResult;
	}
}