<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use \App\Traits\TraitController;

	public function crudTitle($single = 0)
	{
		return $single ? 'User' : 'Users';
	}
	public function crudView($type)
	{
		return 'dashboard.' . $type;
	}
    public function index()
	{
        $view = '';
            switch (logrole()) {
                case 1:
                    $view = 'admin';
                    break;
                case 2:
                    $view = 'agent';
                    break;
                case 3:
                    $view = 'landlord';
                    break;
                case 4:
                    $view = 'tenant';
                    break;
                default:
                   $view = 'agent';
                    break;
            }
            
			return view("dashboard.".$view,['title'=>'Home']);
	}
}