<?php
namespace App\Controllers\Sjlee;

use App\Controllers\BaseController;
use App\Models\util\Util;

class Loin extends BaseController {
	public function __construct(){
	}

	public function testing(){
		phpinfo();
	}

	public function index(){
		return $this->display->load('/Sjlee/Login/login', []);
	}

	public function loginCheck(){
		if (!isset($_SESSION['ksadmin'])){
			$aParams = $this->request->getPost();
			$sGrantType = 'password';
			$aOauthRes = Util::oauth_request($aParams, $sGrantType, '', '');
			if (!$aOauthRes){
				return $this->display->doBack('로그인 확인');
			}
		}
		
		return redirect()->to('/sjlee/loin/main');
	}

	public function main(){
		if (isset($_SESSION['ksadmin']['sAdminId'])){
			if (!$aApiRes = Util::api_request('/api/v1/ksadmin/admin/ksmember/id', 'GET', ['id' => $_SESSION['ksadmin']['sAdminId']])){
				return '에러 발생';
			}
		}

		if ($aApiRes['code'] == '401'){
			return redirect()->to('/sjlee/loin');
		} else if ($aApiRes['code'] != '200'){
			return $aApiRes['code']." error on api gateway";
		}

		$aData = $aApiRes['data'];
		return $this->display->load('/Sjlee/Login/main', $aData, true);
	}

	public function logout(){
		$this->session->destroy();
		return redirect()->to('/sjlee/loin');
	}
}
