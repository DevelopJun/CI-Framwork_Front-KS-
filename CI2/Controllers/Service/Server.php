<?php
namespace App\Controllers\Service;

use App\Controllers\BaseController;
use App\Models\util\Util;

class Server extends BaseController
{
	public function index(){
		return $this->display->load('/Company/Board/index', [], true);
	}
}