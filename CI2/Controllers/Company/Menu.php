<?php
namespace App\Controllers\Company;

use App\Controllers\BaseController;

class Menu extends BaseController{
    public function index(){
        return $this->display->load('/index', [], true);
    }
}
