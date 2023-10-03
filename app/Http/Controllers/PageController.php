<?php 

namespace App\Controllers;
use App\Models\DataModel;


class PageController extends Controller
{

    public function __construct()
    {
		parent::__construct();
		$this->dataModel = new DataModel();
		
     
    }

    // Homepage action
	public function index()
	{
		$x = $this->dataModel->getById('usuarios',1);


		$people = $this->db->table('usuarios');

        $x = $people->select()->where('id', 1)->get();
        

        echo Twig::render('teste.htm', $this->data);

	}
}
