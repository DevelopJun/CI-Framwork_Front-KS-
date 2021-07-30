<?php
namespace App\Controllers;

use App\Models\util\Util;

class Login extends BaseController {
	public function __construct(){
	}

	public function index(){
		if (isset($_SESSION['ksadmin'])){
			return redirect()->to('/');
		}
		return view('login');
	}

	public function loginCheck(){
		if (!isset($_SESSION['ksadmin'])){
			$aParams = $this->request->getPost();
			$sGrantType = 'password';
			$aOauthRes = Util::oauth_request($aParams, $sGrantType, '', '');
			if (!$aOauthRes){
				return $this->display->doBack('다시 시도');
			}
		}
		return redirect()->to('/');
	}

	public function logout(){
		$this->session->destroy();
		return redirect()->to('/login');
	}
}
