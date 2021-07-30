<?php
namespace App\Controllers\June;

use App\Controllers\BaseController;
use App\Models\util\Util;

class Ajax extends BaseController {
	public function index(){
		print_r($_SERVER['REQUEST_URI']);
		/*
		$aToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpbmZvIjp7ImlkeCI6IjI2OTkiLCJpZCI6InNqbGVlNDYyOCIsIm5hbWUiOiJcdWM3NzRcdWMwYzEqKioqKioqIn0sImJvdW5kYXJ5Ijoia3NfYWRtaW4iLCJpZCI6IjIxMmFiZTliM2U3N2NiZGVkMTA0Mzk2NDc4YmE1NTc4NWY1OWJkZjIiLCJqdGkiOiIyMTJhYmU5YjNlNzdjYmRlZDEwNDM5NjQ3OGJhNTU3ODVmNTliZGYyIiwiaXNzIjoibG9jYWxob3N0OjgwODIiLCJhdWQiOiJrc2FkbWluIiwic3ViIjoic2psZWU0NjI4IiwiZXhwIjoxNjI3MjkxODMzLCJpYXQiOjE2MjcyOTAwMzMsInRva2VuX3R5cGUiOiJiZWFyZXIiLCJzY29wZSI6bnVsbH0.AnFEpnPyM-m6EZFbKUozECvpWNjwl-UHKA8copNuTOITETSWczL1ZoaA75HFg1jEvBjnw-LLYDx-4Vp6zro4LU4hy-0Hke85YhB6fhOgs-w2zhHR6sE0hxJzUfyOBwgxMqcr5SWC67aie9Pq4cQvGmrgXrxTXrPcr8xqA0NMC1VK6LRejADHduURdFIe8whBxrpI79e4XMjwfjTKEzpSg0OwVHX31s0B-7MRO_cE0bNcUNCfERwfb3rIpNgcxWDgX1bvcDS32o5zg93QeXhFdt0WdMYvaJQIllSuxg1uq3lWLmRO6IIrSaoFYveCt05TwRXs7uh2LJHeAXQz99cM-A';
		$decode_array = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $aToken)[1]))), true);
		echo '<pre>';
		print_r($decode_array);
		echo '</pre>';
		*/
	}

	public function TestPage(){
		return $this->display->load('/June/ajax1.php', [], true);
	}
}
