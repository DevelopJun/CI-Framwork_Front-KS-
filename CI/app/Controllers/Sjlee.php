<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\util\Util;

class Sjlee extends BaseController {
	public function __construct(){
	}

	public function apiTesting(){
		$sAccessToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJjdXN0b20iOiJtYWtlIHlvdXIgb3duIGp3dCBwYXlsb2FkIiwiaWQiOiJjMTQ3NWY5ZGQzZGViOGY4ZDk0MTk2MTBlNTQ4ZTRiMDJhNWEzZjJmIiwianRpIjoiYzE0NzVmOWRkM2RlYjhmOGQ5NDE5NjEwZTU0OGU0YjAyYTVhM2YyZiIsImlzcyI6ImxvY2FsaG9zdDo4MDgyIiwiYXVkIjoia3NhZG1pbiIsInN1YiI6InNqbGVlNDYyOCIsImV4cCI6MTYyNjc2ODk5NywiaWF0IjoxNjI2NzY3MTk3LCJ0b2tlbl90eXBlIjoiYmVhcmVyIiwic2NvcGUiOm51bGx9.bR_-G9UsnhxoTWBCry4IR3V-aKG1Ezk8XW99fmbWuN-_Jy9hrWQPPswFfOCeVy8QREIebjo8stFtoV6IhEtwd5Kx9NQh3PQ92IV9kH6HC7ztTj2G4s-3jFGwr7Yj5zpMJmv_eZDLUTjqB9lqkaJfAMQ7j0mV010fEx9vTcw5LwR6zc5sUtOx7BsF4x_z2UYhp2_xTQoWxS2hEfE8fWipU0bc4M9ZqemDY0ycQto55Dccf57_omLrDWt2kgglmTrU-nZhWOSuXZbt_2YJqkvWH63hm5-bo0xq44CmV5HPHi8OZRgzvMv2DU4bhw3kOsqAMhdUalwX53ChSWqE4SQ6ug';
		$aTest = Util::api_request('/api/v1/ksadmin/admin/ksmember', 'GET', [], $sAccessToken);
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
}
