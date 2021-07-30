<?php
namespace App\Controllers\Company;

use App\Controllers\BaseController;
use App\Models\util\Util;

class Board extends BaseController
{
	public function index(){
		return $this->display->load('/Company/Board/index', [], true);
	}

	public function t1(){
		return $this->display->load('/Company/Board/index', [], true);
	}
}