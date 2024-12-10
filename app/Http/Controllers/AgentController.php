<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\DataTableHelper;
use Illuminate\Support\Facades\Hash;
use App\Traits\TraitController;
use App\Helpers\FileHelper;
use Mail,Session,Validator;
use App\Models\AgentInvite;

class AgentController extends Controller
{
    use TraitController;
    public function crudTitle($single = 0)
	{
		return $single ? 'Agent' : 'Agents';
	}
	public function crudView($type)
	{
		return 'agents.' . $type;
	}

    public function index(){
        
		if (isPost()) {
			return $this->loadList();
		}
		return view($this->crudView('index'), [
			'title' => $this->crudTitle(),
			'table' => 'tableAgent',
			'urlListData' => routePut('agent.index'),
			'urlAdd' => routePut('agent.add'),
			// 'urlDelete' => Rehab::makeUrl('delete'),
		]);
	}

    public function loadList()
	{
		try {
			$q = User::query();
            $q = $q->select('id','name', 'email','phone_number','birth_date','status','created_at');
			if ($srch = DataTableHelper::search()) {
				$q = $q->where(function ($query) use ($srch) {
					foreach (['name', 'email', 'phone_number'] as $k => $v) {
						if (!$k) $query->where($v, 'like', '%' . $srch . '%');
						else $query->orWhere($v, 'like', '%' . $srch . '%');
					}
				});
			}
			// $q = dtblWhNumeric($q, 'ti_status', request('srch_status'));
            $q = $q->where('role',User::ROLE_AGENT);
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
					'phone_number' => putNA($single->phone_number),
					'profile_photo' => putNA('<img src="'.$single->getProfilepic(1).'" width="64px">'),
                    'birth_date'=>putNA(frDate($single->birth_date)),
					'status' => $single->listStatusBadge(),
                    'activity'=>putNA(DataTableHelper::listActivity([
                        'report'=>routePut('agent.report',['id'=>encId($single->id)]),
                        'sale'=>routePut('agent.sales',['id'=>encId($single->id)]),
                    ])),
					'created_at' => putNA($single->showCreated(1)),
					'actions' => putNA(DataTableHelper::listActions([
						'edit' => routePut('agent.report',['id'=>encId($single->id)]),
						'delete' => routePut('agent.sales',['id'=>encId($single->id)]),
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
            $inviteData = request()->has('token') ? useId(request()->token) : [];
            $findUser =   User::where('email',@$inviteData['email'])->first();
            if($findUser){
                return redirect()->route('app.login')->with('success', 'You have already registered! Please login');   //commented
            }
			$single = $id ? User::find(useId($id)) : new User;
            return view($this->crudView('form'), [
				'title' => ($id ? 'Edit ' : 'Add ') . $this->crudTitle(1),
				'single' => $single,
				'urlList' => routePut('agent.index'),
				'urlSave' => routePut('agent.save'),
                'inviteData'=>$inviteData
			]);
		} catch (\Throwable $th) {
			return $this->resp(0, exMessage($th), [], 500);
		}
	}

    public function save(){
        
        $validator = Validator::make(request()->all(),
        [
            'first_name'=>['required', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'last_name'=>['required', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'birth_date'=>'required',
            'gender'=>'required',
            'email'=>'required|email|unique:users',
            'address'=>'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
            'identity_number' => 'required|numeric|min:12',
            'phone_number'=>'required|numeric|unique:users',
        ]
        );
         
        if($validator->fails()){
            return redirect()->back()->with('error',$validator->messages()->first())->withInput(); //
        }
        try {
            $id = request()->id;
            $single = User::find($id);
            $single  = $single ?? new User;
            $single->name = request()->get('first_name','') . " " .request()->get('last_name','');
            $single->email = request()->email;
            $single->phone_number=request()->phone_number;
            $single->role = request()->role;
            $single->identity_number = request()->identity_number;
            $single->birth_date= dbDate(request()->get('birth_date'));
            $single->status= request()->get('status',1);
            $single->gender= request()->get('gender',1);
            $single->address= request()->get('address',1);
            $single->password = Hash::make(request()->get('password'));
            if(request()->hasFile('profile_photo')){
                $file = request()->profile_photo;
                $single->putFile('profile_photo', $file, 'profile');
            }
            $single->save();
            return redirect()->route('app.login')->with('success', 'You have success register you can login now');
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
			'urlListData' => routePut('agent.report',['id'=>$id]),
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
			//return $this->resp(0, exMessage($th), [], 500);
		}

    }

    public  function agentSaleReport($id=0){
        return view('agents.agent-report');
    }

    public function addAgent(){
        return view('agents.add-form',[
            'title' => 'Add ' . $this->crudTitle(1),
            'urlSave'=>routePut('agent.sent.link')
        ]);
    }
    public function sentLinkAgent(Request $request){
        
        $validate = Validator::make(request()->all(),
        [
             'email' => 'required|email|unique:users',
        ]
        );
        if($validate->fails()){
            //  return $this->resp(0, $validate->messages()->first(), [], 500);   //commented
          return redirect()->route('add.agent')->with('success', 'You have already registered! Please login');  //You have already registered! Please login   .. replace this

            
        }

        $data = [
            'email'=>$request->get('email'),
            'role'=>User::ROLE_AGENT
        ];
        $role = User::ROLE_AGENT;
        $agent =  AgentInvite::where('email',$request->get('email'))->first();
        if(!$agent){
                AgentInvite::create($data);
        }
       try{
        Mail::send('email.agent-register',
        ['token'=>encId($data),'inviterName'=>logName(),'role'=>$role], 
        function($message) use($request){
            $message->to($request->email);
            $message->subject(siteName().' Register');
        });
        }catch(\Exception $ex){
          Log::info('Error occured at sending email to new agent.Error: '.$ex);   //commented
           
        }     
        return redirect()->route('add.agent')->with('success', 'We have e-mailed invitation link!');  //You have already registered! Please login   .. replace this
            // return response()->json(['success'=>'Tenant Deleted Successfully!']);
            // return $this->resp('1', 'We have e-mailed invitation link!', [], 200);         
    }
    public function registerViaLink($token){

    }
    public function showAgent(){
       $getInvites =   AgentInvite::get();
       return view('agents.show-agents',compact('getInvites'));
    }
    public function sendAgent(Request $request){
          $find =   AgentInvite::where('id',$request->id)->first();
          if($find){
            $data = [
                    'email'=>$find->email,
                    'role'=>User::ROLE_AGENT
                    ];
      
        Mail::send('email.agent-register',['token'=>encId($data),'inviterName'=>logName()], function($message) use($find){
            $message->to($find->email);
            $message->subject(siteName().' Register');
        });
            return response()->json(['success'=>true]);

          }
            return response()->json(['success'=>false]);
    }
}