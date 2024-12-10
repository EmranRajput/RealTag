<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\DataTableHelper;
use App\Traits\TraitController;
use App\Helpers\FileHelper;
use Validator,Hash;
use Mail,Session,Auth,Str;

class LandLordController extends Controller
{
    use TraitController;
    public function crudTitle($single = 0)
	{
		return $single ? 'Landlord' : 'Landlords';
	}
	public function crudView($type)
	{
		return 'landlord.' . $type;
	}

    public function index(){
		if (isPost()) {
			return $this->loadList();
		}
		return view($this->crudView('index'), [
			'title' => $this->crudTitle(),
			'table' => 'tableLandlord',
			// 'urlListData' => routePut('landlord.index'),
			// 'urlAdd' => routePut('landlord.add'),
			// 'urlDelete' => Rehab::makeUrl('delete'),
		]);
	}

    public function loadList()
	{
		try {
			$q = User::query();
            $q = $q->select('id','name', 'email', 'tac_code','phone_number','birth_date','status','created_at');
			if ($srch = DataTableHelper::search()) {
				$q = $q->where(function ($query) use ($srch) {
					foreach (['name', 'email', 'tac_code','phone_number'] as $k => $v) {
						if (!$k) $query->where($v, 'like', '%' . $srch . '%');
						else $query->orWhere($v, 'like', '%' . $srch . '%');
					}
				});
			}
			// $q = dtblWhNumeric($q, 'ti_status', request('srch_status'));
            $q = $q->where('role',User::ROLE_LANDLORD);
			$count = $q->count();

			if (DataTableHelper::sortBy() == 'status') {
				$q = $q->orderBy(DataTableHelper::sortBy(), DataTableHelper::sortDir() == 'asc' ? 'desc' : 'asc');
			} else {
				$q = $q->orderBy(DataTableHelper::sortBy(), DataTableHelper::sortDir());
			}
			$q = $q->skip(DataTableHelper::start())->limit(DataTableHelper::limit());

			$data = [];
			foreach ($q->get() as $single) {
				$data[] = [
					'name' => putNA($single->getName()),
					'email' => putNA($single->getEmail()),
					'tac_code' => putNA($single->tac_code),
					'phone_number' => putNA($single->phone_number),
					'profile_photo' => putNA('<img src="'.$single->getProfilepic(1).'" width="64px">'),
                    'birth_date'=>putNA(frDate($single->birth_date)),
					'status' => $single->listStatusBadge(),
                    'activity'=>putNA(DataTableHelper::listActivity([
                        // 'report'=>routePut('landlord.report',['id'=>encId($single->id)]),
                        // 'sale'=>routePut('landlord.sales',['id'=>encId($single->id)]),
                    ])),
					'created_at' => putNA($single->showCreated(1)),
					'actions' => putNA(DataTableHelper::listActions([
						// 'edit' => routePut('landlord.report',['id'=>encId($single->id)]),
						// 'delete' => routePut('landlord.sales',['id'=>encId($single->id)]),
					]))
				];
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
    public function form($id = 0)
	{
		// // \FileHelper::move(\FileHelper::path(), \FileHelper::path());
		// _p(\FileHelper::makeFolder('11'));
		// die('D');
		try {
			$single = $id ? User::find(useId($id)) : new User;
			return view($this->crudView('form'), [
				'title' => ($id ? 'Edit ' : 'Add ') . $this->crudTitle(1),
				'single' => $single,
				// 'urlList' => routePut('landlord.index'),
				'urlSave' => $single->urlSave(),
			]);
		} catch (\Throwable $th) {
			return $this->resp(0, exMessage($th), [], 500);
		}
	}

    public function delete($id)
	{
		if ($single = User::find(useId($id))) {
			$single->status = 0;
            $single->save();
			return $this->resp(1, getMsg('deleted', ['name' => $this->crudTitle()]));
		} else {
			return $this->resp(0, getMsg('not_found'));
		}
	}

    public function agentActivityIndex($id = 0){
        if (isPost()) {
			return $this->agentActivityListData();
		}
		return view($this->crudView('rent-deed-list'), [
			'title' => "Rent Deed List of Agent Name",
			'table' => 'tableRentDeed',
			// 'urlListData' => routePut('landlord.report',['id'=>$id]),
		]);
    }
    public function agentActivityListData(){
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
                        'landlord_name' => 'Landlord ' . ($counter),
                        'tenanat_name' => 'Tenant ' . ($counter),
                        'start_date' => date('Y-m-d', strtotime("-$i days")),
                        'end_date' => date('Y-m-d', strtotime("+$i days")),
                        'created_at' => date('Y-m-d H:i:s'),
                        'status'=>putNA($statusBadge),
                        'actions' => putNA(DataTableHelper::listActions([
                            'view' => FileHelper::url('rent-deed-saample.pdf',['rent-deed']),
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

    public  function agentSaleReport($id=0){
        return view('agents.agent-report');
    }
}