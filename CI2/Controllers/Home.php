<?php
namespace App\Controllers;
use App\Models\util\Util;
use App\models\util\Display_model;

class Home extends BaseController
{
	public function index(){

		$aData = [
			'ka_idx' => $_SESSION['info']['idx'],
			'ka_id' => $_SESSION['info']['id'],
			'ka_name' => $_SESSION['info']['name']
		];

		return $this->display->load('/index', $aData, $aData, true);
	}

	public function menu1(){


		$adata1 = $this->display->init_Navi();


		$aData = [
			'ka_idx' => $_SESSION['info']['idx'],
			'ka_id' => $_SESSION['info']['id'],
			'ka_name' => $_SESSION['info']['name']
		];

		$aData1 = [

		];

		return $this->display->load('/menu1', $aData, $aData1, true);

	}


	public function menu2(){

		$aData = [
			'ka_idx' => $_SESSION['info']['idx'],
			'ka_id' => $_SESSION['info']['id'],
			'ka_name' => $_SESSION['info']['name']
		];

		$aData1 = [

		];

		return $this->display->load('/menu2', $aData, $aData1, true);

	}
}
