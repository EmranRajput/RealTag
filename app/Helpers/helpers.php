<?php

use Request as Request,
	Route as Route,
	DB as DB,
	Config as Config,
	File as File;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception as Exception;
use Illuminate\Support\Facades\Session;
use App\Helpers\AccessHelper;


use App\Models\MessageTemplate;
use App\Models\Setting;
use App\Models\WhatsappInstance;

// COMMON FUNCTIONS --------------------------------------------------------------------------------------------------- //
function _p($data, $exit = 0)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	if ($exit) die('');
}
function putNA($val)
{
	if (is_numeric($val)) return $val;
	return $val ? $val : '-';
}
function _lvl()
{
	return '<span class="lvl">&nbsp; &raquo; &nbsp;</span>';
}
function siteName($title = NULL)
{
	return $title ? env('APP_NAME') . ' | ' . $title : env('APP_NAME');
}
function siteLogo()
{
	return pathAssets('images/roots-logo.png');
}
function uniqueCode()
{
	return uniqid();
}
function seoText($str)
{
	for ($i = 0; $i < 5; $i++) {
		$str = str_replace('&', 'and', trim($str));
		$str = str_replace(['#', '$', '\'', '"', '?', '&', ':', '!', '%', '&reg;', '&trade;', '(', ')', '/', ',', '_'], '-', trim($str));
		$str = str_replace([' '], '-', trim($str));
		$str = str_replace(['--', '--'], '-', trim($str));
	}
	return $str;
}
function siteConfig($key, $default = NULL)
{
	return config('site-config.' . $key, $default);
}
function makeDropdown($options = [], $selected = [])
{
	$return = [];
	if (count($options)) {
		foreach ($options as $k => $v) {
			$sel = '';
			if (is_array($selected)) {
				if (in_array($k, $selected))
					$sel = 'selected';
			} else if ($selected === $k) {
				$sel = 'selected';
			}
			$return[] = '<option value="' . $k . '" ' . $sel . '>' . ucfirst(trim(strip_tags($v))) . '</option>';
		}
	}

	return implode('', $return);
}
function printPrice($price = 0)
{
	return '$' . round($price, 2);
}
function _star()
{
	return '<span class="text-danger">*</span>';
}
function labelInfo($text)
{
	return $text ? '<span class="text-info" >' . $text . '</span>' : '';
}

function pathPublic($path)
{
	return url($path);
}
function pathAssets($path)
{
	return url('assets/' . $path) . '?ts=' . time();
}
function validate($request, $rules = [], $messages = [])
{
	$validator = Validator::make($request, $rules, $messages);
	return $validator->errors()->all();
}
function exMessage($e)
{
	return 'Error on line ' . $e->getLine() . ' in ' . $e->getFile() . ': ' . $e->getMessage();
}
function encId($id)
{
	return encrypt($id);
}
function useId($id)
{
	return decrypt($id);
}

// DATE FUNCTIONS --------------------------------------------------------------------------------------------------- //
function dbDate($date, $datetime = true)
{
	$date = $date ? $date : date('Y-m-d H:i:s');
	if ($datetime) {
		return date('Y-m-d H:i:s', strtotime($date));
	} else {
		return date('Y-m-d');
	}
}
function frDate($date, $datetime = 0)
{
	if ($date) {
		$tz = 'Asia/Kuala_Lumpur';
		$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
		$dt->setTimestamp(is_numeric($date) ? $date : strtotime($date)); //adjust the object to correct timestamp
		return $datetime ? $dt->format('d-m-Y H:i') : $dt->format('d-m-Y');
	}
	return '';
}
function fullDate($date)
{
	if ($date) {
		$tz = 'Asia/Kuala_Lumpur';
		$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
		$dt->setTimestamp(is_numeric($date) ? $date : strtotime($date)); //adjust the object to correct timestamp
		return  $dt->format('d M Y');
	}
	return '';
}

function dayCalc($date)
{
	$now = time(); // or your date as well
	$date_diff = $now - strtotime($date);
	return round($date_diff / (60 * 60 * 24));
}
function totalHoursCalc($date)
{
	$origin = now();
	$target = date_create($date);
	$interval = date_diff($origin, $target);
	return $interval->format('%a days, %h hours, %i minutes, %s seconds');
}
// ROUTE FUNCTIONS --------------------------------------------------------------------------------------------------- //
function routePut($name, $args = [])
{
	return $name && Route::has($name) && isAccess($name) ? route($name, $args) : '';
}
function routeCurrName()
{
	return Route::getCurrentRoute() ? Route::getCurrentRoute()->getName() : '';
}
function routeActive($name)
{
	return routeCurrName() == $name ? 1 : '';
}


// REQUEST FUNCTIONS --------------------------------------------------------------------------------------------------- //
function isReq($key)
{
	return request()->exists($key);
}
function isPost()
{
	return request()->isMethod('POST') ? 1 : 0;
}
function addReq($key, $val)
{
	request()->merge([$key => $val]);
}

// TRANSLATION FUNCTIONS --------------------------------------------------------------------------------------------------- //
function getMsg($key, $args = [])
{
	return trans('messages.' . $key, $args);
}
// User Auth --------------------------------------------------------------------------------------------------- //
function userGuard()
{
	return 'user';
}
function userLogin()
{
	if (!auth()->guard(userGuard())->check()) return 0;
	return auth()->guard(userGuard())->user();
}
function logId()
{
	return userLogin() ? userLogin()->getId() : 0;
}
function logName()
{
	return userLogin() ? userLogin()->getName() : '';
}
function logEmail()
{
	return userLogin() ? userLogin()->email : '';
}
function logRole()
{
	return userLogin() ? userLogin()->getRole() : '';
}
function logRolePrint()
{
	return userLogin() ? userLogin()->printRole() : '';
}
function logUserName()
{
	return userLogin() ? userLogin()->getUsername() : '';
}
function logFullName()
{
	return userLogin() ? userLogin()->printFullName() : '';
}
function logPrintRole()
{
	return userLogin() ? userLogin()->printRole() : '';
}
function isAdmin()
{
	return userLogin() ? userLogin()->isAdmin() : '';
}
function isAgent()
{
	return userLogin() ? userLogin()->isAgent() : '';
}
function isLandLord()
{
	return userLogin() ? userLogin()->isLandLord() : '';
}
function isTenent()
{
	return userLogin() ? userLogin()->isTenent() : '';
}
function isAccess($route)
{
	return AccessHelper::valid($route);
}
function getDropdownName($data, $selected)
{
	return $selected ? $data[$selected] : '';
}
function getMultipleDropdownName($options = [], $selected = [])
{

	$return = [];
	if (count($options)) {
		foreach ($options as $k => $v) {
			if (is_array($selected)) {
				if (in_array($k, $selected))
					$return[] = ucfirst(trim(strip_tags($v)));
			}
		}
	}
	return implode(',', $return);
}
function isAccessible($key)
{
	return AccessHelper::blockAccess($key);
}

function getButtonClass()
{
	return "g-bg-cyan";
}
function getLabelClass()
{
	return "col-red";
}
function isView()
{
	return  routeCurrName() != "patient.admission.view" ? 1 : 0;
}
function array_push_assoc(&$array, $key, $value)
{
	$array[$key] = $value;
	return $array;
}
function convertHoursToDays($hours = 0)
{
	if ($hours) {
		return (int) ceil($hours / 24);
	}
	return 0;
}

function getDayCount($date)
{
	if ($date) {
		$diff = time() - strtotime($date);
		return  (int) round($diff / (60 * 60 * 24));
	}
	return 0;
}
function createResourseDirecrotory($folder_path)
{

    $path = public_path($folder_path);
    if (!File::isDirectory($path)) {
        File::makeDirectory($path, 0777, true, true);
    }
}

function setHeadersInArray($row){	
	Session::put('header_array', $row);
}

function getHeadersFromArray(){		
return 	Session::get('header_array');
}

function matchReplaceVariable($row,$msg_description){
	$array =   getHeadersFromArray();
	foreach($array as $key => $arr){
		$match = '{'.$arr.'}';
		$isMatch = preg_match($match,$msg_description);
		if($isMatch){
		 $msg_description = str_replace($match,$row[$key],$msg_description);  // search,replace,description			
		}
	}
	return  $msg_description ;
}
function getWhatsAppInstances($number){
	
	return  WhatsappInstance::where('phone_number', 'like', '%' . $number . '%')->first();
	
}
function getSetting($key){
     return  Setting::where('key',$key)->first();

}
function getUserRole($role){

	switch ($role) {
        case 1:
            return 'Admin';
        case 2:
           return 'Agent';
		case 3:
             return 'Talent';             
		case 4:
			return 'Land Lord';

    }
}
function calculatePercentage($rental_amount,$tax){
return  ( @$rental_amount * $tax ) / 100;
}
function convertNumberToWords($number)
{
    $fmt = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);

    return $fmt->format($number);
}
function formatNumber($number)
{
	$number = (float) $number;
    // Format the number with two digits after the decimal point
    $formattedNumber = number_format($number, 2, '.', '');

    // If there are no decimal digits, add ".00"
    if (strpos($formattedNumber, '.') === false) {
        $formattedNumber .= '.00';
    }

    return $formattedNumber;
}