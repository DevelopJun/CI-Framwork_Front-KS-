<?php
namespace App\Controllers;

use App\Models\util\Util;

class Index extends BaseController
{
	public function index(){
		$aData = [
			'ka_idx' => $_SESSION['info']['idx'],
			'ka_id' => $_SESSION['info']['id'],
			'ka_name' => $_SESSION['info']['name'],
			'ksadmin' => [$_SESSION['ksadmin']]
		];

		return $this->display->load('/index', $aData, true);
	}
}
