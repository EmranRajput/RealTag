<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\TraitController;
use App\Helpers\DataTableHelper;

class UploadTemplateController extends Controller
{
    use TraitController;
    public function crudTitle($single = 0)
	{
		return $single ? 'Upload Template' : 'Uploaded Templates';
	}
	public function crudView($type)
	{
		return 'upload-template.' . $type;
	}

    public function invoice(){
        if (isPost()) {
			return $this->invoiceListData();
		}
		return view($this->crudView('index'), [
			'title' => $this->crudTitle(),
			'table' => 'tableUploadTemplate',
			'urlListData' => routePut('template.index'),
            'urlAdd'=>routePut('template.add')
		]);
    }
    public function invoiceListData(){
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
                        'name' => 'Invoice Template ' . ($counter),
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
        return view('upload-template.form',['title'=>$title]);
    }
    public function save(){

    }
    public function delete(){

    }


    public function agreement(){
        if (isPost()) {
			return $this->agreementListData();
		}
		return view($this->crudView('index'), [
			'title' => $this->crudTitle(),
			'table' => 'tableAgreementTemplate',
			'urlListData' => routePut('template.index'),
            'urlAdd'=>routePut('template.add')
		]);
    }
    public function agreementListData(){
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
                        'name' => 'Agreement Template ' . ($counter),
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
    public function receipt(){
        if (isPost()) {
			return $this->receiptListData();
		}
		return view($this->crudView('index'), [
			'title' => $this->crudTitle(),
			'table' => 'tableReceiptTemplate',
			'urlListData' => routePut('template.index'),
            'urlAdd'=>routePut('template.add')
		]);
    }
    public function receiptListData(){
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
                        'name' => 'Agreement Template ' . ($counter),
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
}
