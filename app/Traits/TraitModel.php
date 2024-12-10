<?php
namespace App\Traits;

use Request, Validator;
use App\Helpers\FileHelper;

trait TraitModel{

	// Get Data / Set Data
	public function getId(){ return $this->id ?: 0; }

	public function getProductId(){ return $this->i_product_id; }
	public function getSlug(){ return $this->v_slug; }

	public function getName(){ return $this->name; }
	public function getEmail(){ return $this->email; }
	public function getUsername(){ return $this->username; }
	public function getNameWithStatus(){ return $this->getName().''.(!$this->isActive() ? ' ('.$this->printStatus().')' : ''); }

	public function getStatus(){ return $this->getId() ? $this->status : NULL; }
	public function printStatus(){ return $this->isActive() ? 'Active' : 'Inactive'; }
	public function isActive(){ return $this->getStatus() == 1; }
	public function makeActive(){ $this->status = 1; }
	public function makeInactive(){ $this->status = 0; }

	public function setAdded(){ if(!$this->getId()) $this->created_at = dbDate(); }
	public function getCreated(){ return $this->created_at; }
	public function showCreated($datetime=0){ return frDate($this->getCreated(), $datetime); }

	public function setUpdated(){ $this->updated_at = dbDate(); }
	public function getUpdated(){ return $this->updated_at; }
	public function showUpdated($datetime=0){ return frDate($this->getUpdated(), $datetime); }

	public static function folderName($folder=NULL){
		if($folder) return [$folder, self::FOLDER];
		return [self::FOLDER];
	}
	public function putFile($key, $file, $folder){
		if($file){
			$oldName = $this->$key;
			if($newName = FileHelper::upload($file, self::folderName($folder))){
				if($oldName)
				FileHelper::delete($oldName, self::folderName($folder));
				$this->$key = $newName;
			}
		}
	}


	public static function routeBase() {
		return self::BASE_ROUTE;
	}
	public static function makeUrl($name, $args = []) {
		return routePut(self::routeBase().$name, $args);
	}
	public function urlEdit() { return self::makeUrl('edit', ['id' => encrypt($this->getId())]); }
	public function urlView() { return self::makeUrl('view', ['id' => encrypt($this->getId())]); }
	public function urlDelete() { return self::makeUrl('delete', ['id' => encrypt($this->getId())]); }
	public function urlSave() { return self::makeUrl('save', ['id' => encrypt($this->getId())]); }
	public function urlAdmissionEdit() { return self::makeUrl('admission.edit', ['patient_id'=>encrypt($this->patient_id),'id' => encrypt($this->getId()),]); }
	public function listStatusBadge(){
		return '<span class="' . ($this->isActive() ? 'label bg-green' : 'label bg-red') . '">' . $this->printStatus() . '</span>';
	}
    public function report(){
        return '<a href="'.routePut('agent.activity',['id'=>encId($this->id)]).'" title="Activity" class="col-cyan mr-2"><i class="material-icons">assessment</i></a>';
    }
    public function sale(){
        return '<a href="'.routePut('agent.activity',['id'=>encId($this->id)]).'" title="Sale" class="col-cyan mr-2"><i class="material-icons">account_balance_wallet</i></a>';
    }

}