<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\util\Util;

class Sjlee extends BaseController {
	public function __construct(){
	}

	public function apiTesting(){
		$sAccessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJjdXN0b20iOiJtYWtlIHlvdXIgb3duIGp3dCBwYXlsb2FkIiwiaWQiOiI5OGM0NjVkMDg0NDMwY2ZiNTA0ZWFiZGJmYmU1NWYyMjEyMjYyMTJhIiwianRpIjoiOThjNDY1ZDA4NDQzMGNmYjUwNGVhYmRiZmJlNTVmMjIxMjI2MjEyYSIsImlzcyI6ImxvY2FsaG9zdDo4MDgyIiwiYXVkIjoia3NhZG1pbiIsInN1YiI6InNqbGVlNDYyOCIsImV4cCI6MTYyNjc3MTkxNywiaWF0IjoxNjI2NzcwMTE3LCJ0b2tlbl90eXBlIjoiYmVhcmVyIiwic2NvcGUiOm51bGx9.SOoL3pSvGE94M9kpjNf2K_deGTuELJjB37jyDhdT3xYt8r3tz2t7gu7KTDEWG7dMysl_LvBxEcY47-yKlYXCavn1uEjgTFpNpejP8HVPlyqsv57rmEeg7m3lZN3ZbQJB83BGKNKhSR0zn8_C9-yJ05eHeMDJlcGHn1NZRQcsh3G6mMkwW6VaTpm_YgnctohmM1_3IQDPWj2xdlR1sHWawkbfSJ2mZ3Cs-kMxgqU0fx4vZNGg1DXlkKoNEHT4P64F4amOwNlyg17uQx4aWgvYzSsEVM928iu6KgJQgceHaeqW0-J8mTj67a5ceixgDs4FopNSQ4l4RKjcFY5a-pG4NQ';
		$aTest = Util::api_request('/api/v1/ksadmin/admin/ksmember/id', 'GET', ['id'=>'sjlee4628'], $sAccessToken);
		echo '<pre>';
		print_r($aTest);
		echo '</pre>';

	}

	public function oauthTesting(){
		$aParams = [
			'username' => 'sjlee4628',
			'password' => 'testpass',
		];
		$sGrantType = 'password';
		$aTest = Util::oauth_request($aParams, $sGrantType);
		echo '<pre>';
		print_r($aTest);
		echo '</pre>';
	}

	public function paging(){
		$aData = [
			'test' => 'testing',
			'test1' => 'testing1',
			'test2' => 'testing2'
		];
		return $this->display->load('/cookie/cookie_test', $aData, true);
	}

	public function sessionTest(){
		echo "session testing<br>";
		echo "<pre>";
		print_r($_SESSION);
	}

	public function login(){
		return $this->display->load('/Sjlee/Login/index', []);
	}
}
