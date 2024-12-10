<?php

namespace App\Helpers;

class DataTableHelper
{

  public static function start($default = 0)
  {
    return (int)request('start', $default);
  }
  public static function limit($default = 10)
  {
    return (int)request('length', $default);
  }
  public static function sortBy()
  {
    $num = request('order.0.column');
    return request('columns.' . $num . '.name') ?: request('columns.' . $num . '.data');
  }
  public static function sortDir()
  {
    return request('order.0.dir');
  }

  public static function search()
  {
    return request('search.value') ?: request('srch_general');
  }
  public static function multiCheck()
  {
    return '<input type="checkbox" class="crud-check" onchange="crudMultiCheck(this)" />';
  }
  public static function multiActive($url)
  {
    return '<a href="javascript:void(0);" onclick="crudStatusChange(\'' . $url . '\', 1)" ><button type="button" class="btn btn-secondary btn-sm">Active</button></a>';
  }
  public static function multiInactive($url)
  {
    return '<a href="javascript:void(0);" onclick="crudStatusChange(\'' . $url . '\', 0)" ><button type="button" class="btn btn-secondary btn-sm">Inactive</button></a>';
  }
  public static function multiDelete($url)
  {
    return '<a href="javascript:void(0);" onclick="crudDelete(\'' . $url . '\')" ><button type="button" class="btn btn-danger btn-sm">Delete</button></a>';
  }
  public static function multiOrderUpdate($url)
  {
    return '<a href="javascript:void(0);" onclick="crudUpdateOrder(\'' . $url . '\')" ><button type="button" class="btn btn-secondary btn-sm">Update Order</button></a>';
  }
  public static function addUrl($url)
  {
    return '<a href="' . $url . '" ><button type="button" class="btn btn-info btn-sm ml-3">Add New</button></a>';
  }
  public static function whNumeric($q, $key, $value)
  {
    if (is_numeric($value)) $q = $q->where($key, $value);
    return $q;
  }

  public static function listActions($args = [])
  {
    $data = [];
    if ($args['edit'] ?? '') {
      $data[] = '<a href="' . $args['edit'] . '" title="Edit" class="col-cyan mr-2"><i class="material-icons">edit</i></a>';
    }
    if ($args['delete'] ?? '') {
      $data[] = '<a href="javascript:;" title="Delete" class="col-red mr-2" onclick="crudDelete(\'' . $args['delete'] . '\')"><i class="material-icons">delete_forever</i></a>';
    }
    if ($args['view'] ?? '') {
      $data[] = '<a href="' . $args['view'] . '" title="View" class="col-cyan mr-2"><i class="material-icons">visibility</i></a>';
    }
    if ($data) {
      return implode('', $data);
    }
    return '';
  }
  public static function listActivity($args = []){
    $data = [];
    if ($args['report'] ?? '') {
      $data[] = '<a href="'.$args['report'].'" title="Activity" class="col-cyan mr-2"><i class="material-icons">assessment</i></a>';
    }
    if ($args['sale'] ?? '') {
        $data[] = '<a href="'.$args['sale'].'" title="Sale" class="col-cyan mr-2"><i class="material-icons">account_balance_wallet</i></a>';
    }
    if ($data) {
      return implode('', $data);
    }
    return '';
  }
  public static function applySearch($q, $cols)
  {
    if ($srch = self::search()) {
      $q->where(function ($query) use ($cols, $srch) {
        foreach ($cols as $k => $v) {
          if (!$k) $query->where($v, 'like', '%' . $srch . '%');
          else $query->orWhere($v, 'like', '%' . $srch . '%');
        }
        return $query;
      });
    }
    return $q;
  }
}
