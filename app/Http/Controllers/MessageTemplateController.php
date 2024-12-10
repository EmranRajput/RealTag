<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\TraitController;
use App\Helpers\DataTableHelper;

class MessageTemplateController extends Controller
{

    use TraitController;
    public function crudTitle($single = 0)
	{
		return $single ? 'Message' : 'Messages';
	}
	public function crudView($type)
	{
		return 'message.' . $type;
	}

    public function index($id = 0){
        if (isPost()) {
			return $this->listData();
		}
		return view($this->crudView('whatsapp-template'), [
			'title' => 'WhatsApp Message Template',
			'table' => 'tableMessageTemplate',
			'urlListData' => routePut('message.index'),
            'urlAdd'=>routePut('message.add')
		]);
    }
    public function listData(){
        $data = [];
        $count = 10;
        $counter = 0;
        try {
            if($counter <= $count){

                for ($i = 0; $i < request()->length; $i++) {
                    $counter = $i+ 1;
                    $status  = ($i % 2 === 0) ? 1 : 0;
                    $class =$status ? "label bg-green" : "label bg-red";
                    $printStatus = $status ? "Active": "Inactive";
                    $statusBadge = '<span class="' . $class . '">' . $printStatus . '</span>';
                    $data[] = [
                        'name' => 'Template ' . ($counter),
                        'type' => 'Whatsapp Template sub Type ' . ($counter),
                        'created_at' => date('Y-m-d H:i:s'),
                        'status'=>putNA($statusBadge),
                        'actions' => putNA(DataTableHelper::listActions([
                            'edit' => routePut('message.edit',['id'=>$counter]),
                            'delete'=>routePut('message.delete',['id'=>$counter])
                        ]))
                    ];
                }
            }
			return $this->resp(1, '', [
				'draw' => request('draw'),
				'recordsTotal' => $count,
				'recordsFiltered' => $count,
				'data' => $data
			]);
		} catch (\Throwable $th) {
			return $this->resp(0, exMessage($th), [], 500);
		}

    }
    public function form($id = 0){
        $title = $id ? "Edit " : "Add " . $this->crudTitle();
        return view('message.form',['title'=>$title]);
    }
    public function save(){

    }
    public function delete(){

    }

    public function emailIndex($id = 0){
        if (isPost()) {
			return $this->emailListData();
		}
		return view($this->crudView('email-template'), [
			'title' => 'Email Template',
			'table' => 'tableEmailTemplate',
			'urlListData' => routePut('email.index'),
            'urlAdd'=>routePut('message.add')
		]);
    }
    public function emailListData(){
        $data = [];
        $count = 10;
        $counter = 0;
        try {
            if($counter <= $count){

                for ($i = 0; $i < request()->length; $i++) {
                    $counter = $i+ 1;
                    $status  = ($i % 2 === 0) ? 1 : 0;
                    $class =$status ? "label bg-green" : "label bg-red";
                    $printStatus = $status ? "Active": "Inactive";
                    $statusBadge = '<span class="' . $class . '">' . $printStatus . '</span>';
                    $data[] = [
                        'name' => 'Template ' . ($counter),
                        'type' => 'Email Template sub Type ' . ($counter),
                        'created_at' => date('Y-m-d H:i:s'),
                        'status'=>putNA($statusBadge),
                        'actions' => putNA(DataTableHelper::listActions([
                            'edit' => routePut('message.edit',['id'=>$counter]),
                            'delete'=>routePut('message.delete',['id'=>$counter])
                        ]))
                    ];
                }
            }
			return $this->resp(1, '', [
				'draw' => request('draw'),
				'recordsTotal' => $count,
				'recordsFiltered' => $count,
				'data' => $data
			]);
		} catch (\Throwable $th) {
			return $this->resp(0, exMessage($th), [], 500);
		}

    }

    public function excludeList(){
        if (isPost()) {
			return $this->excludeListData();
		}
		return view($this->crudView('exclude-list'), [
			'title' => 'Exclude List',
			'table' => 'tableExcludeList',
			'urlListData' => routePut('message.exclude-list'),
            'urlAdd'=>''
		]);
    }
    public function excludeListData(){
        $data = [];
        $count = 10;
        $counter = 0;
        try {
            if($counter <= $count){

                for ($i = 0; $i < request()->length; $i++) {
                    $counter = $i+ 1;
                    $status  =  0;
                    $class =$status ? "label bg-green" : "label bg-red";
                    $printStatus = $status ? "Active": "Inactive";
                    $statusBadge = '<span class="' . $class . '">' . $printStatus . '</span>';
                    $data[] = [
                        'name' => 'Template ' . ($counter),
                        'number' => rand(1111111111,9999999999),
                        'created_at' => date('Y-m-d H:i:s'),
                        'status'=>putNA($statusBadge),
                        'actions' => '<input type="checkbox" class="switch-chebkox" /><label for="switch">Toggle</label>'
                    ];
                }
            }
			return $this->resp(1, '', [
				'draw' => request('draw'),
				'recordsTotal' => $count,
				'recordsFiltered' => $count,
				'data' => $data
			]);
		} catch (\Throwable $th) {
			return $this->resp(0, exMessage($th), [], 500);
		}
    }
}