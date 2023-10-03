<?php

namespace App\Libraries;

use Sabre\HTTP;

class SabreHttp
{
	public function getPostData()
	{
              
        if ($_POST) {
            verificaSToken();
            $http = HTTP\Sapi::getRequest();
            return  $http->getPostData();
            
        }
	}
}


?>