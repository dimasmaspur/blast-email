<?php namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController; 

class Api extends ResourceController
{

	public function index()
	{
        return $this->response
                    ->setStatusCode(200)
                    ->setContentType('text/json')
                    ->setBody('hallo');
	}

   
    
	
}
