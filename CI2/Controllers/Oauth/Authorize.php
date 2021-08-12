<?php
namespace App\Controllers\Oauth;

use App\Controllers\BaseController;
use App\Models\util\Util;

class Authorize extends BaseController {
	public function __contruct(){
	}

	/**
	* @brief 검증 및 로그인 페이지 호출
	* @details
	* @author sjlee4628
	* @param
	* @return
	*/
	public function index(){
		// 기본 파라미터
		$aParam = $this->request->getGet();
		// 검증 curl
		$aValidData = [
			'response_type' => $aParam['response_type'],
			'client_id' => $aParam['client_id'],
			'redirect_uri' => '실패시 uri',
			'state' => $aParam['state']
		];
		$aData = Util::oauth('https://mauth.ksdev.net/authorize/valid', 'GET', $aValidData);
		if ($aData['code'] != 200){
			return '검증 실패';
		}
		// login popup page view
		return view('Oauth/Authorize/index', $aParam);
	}

	/**
	* @brief 로그인 action 및 redirect(callback)
	* @details
	* @author sjlee4628
	* @param
	* @return
	*/
	public function login(){
		$aParam = $this->request->getPost();
		$aData = Util::oauth('https://mauth.ksdev.net/authorize/auth', 'POST', $aParam);
		header('Location: '.$aData['header']['Location']);
		exit();
	}

	// 현재 ajax 호출 이후 oauth_request 호출 부분
	public function refresh(){
		if (!isset($_SESSION['admin']['sRefreshToken']) || !isset($_SESSION['admin']['sAccessToken'])){
			return $this->display->result(false, '로그인 이후에 이용하시기 바랍니다.');
		}
		if (Util::oauth_request(['refresh_token' => $_SESSION['admin']['sRefreshToken'], 'access_token' => $_SESSION['admin']['sAccessToken']], 'refresh_token')){
			return $this->display->result(true, '재발급 성공');
		}
		return $this->display->result(false, '재발급 실패');
	}
}
