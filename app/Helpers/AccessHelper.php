<?php

namespace App\Helpers;

class AccessHelper
{

  public static function valid($route = NULL)
  {
    $route = routeCurrName();
    if (isAdmin()) {
      return in_array($route, self::adminRoute());
    }else if(isAgent()){
        return in_array($route, self::agentRoute());
    } else if (isLandLord()) {
      return in_array($route, self::landLordRoute());
    } else if (isTenent()) {
      return in_array($route, self::tenentRoute());
    }
    return false;
  }
  public static function adminRoute()
  {
    return [
      'app.dashboard',
      'app.profile',
      'app.profile.save',
      'app.password.save',
      'agent.index',
      'add.agent',
      'show.agent',
      'agent.sent.link',
      'agent.edit',
      'agent.save',
      'agent.delete',
      'agent.report',
      'agent.sales',
      'message.index',
      'email.index',
      'message.add',
      'message.save',
      'message.edit',
      'message.delete',
      'template.invoice',
      'template.agreement',
      'template.receipt',
      'template.add',
      'template.save',
      'template.edit',
      'template.delete',
      'report.sales',
      'whatsapp.instance.index',
      'whatsapp.instance.sleep.timer',
      'show.users',
      'user.agreements',
      'agreements.delete',
      'user.agreements.edit',
      'agreements.create.update',
      'whatsapp.instance.edit',
      'birthday.templates',
      'birthday.templates.edit',
      'birthday.template.delete',
      'birthday.template.create.update',
      'rental.templates',
      'rental.templates.edit',
      'rental.template.delete',
      'rental.template.create.update',
      //  'tanent.index',
      // 'tanent.add',
      // 'tanent.edit',
      // 'tanent.save',
      // 'tanent.delete',
      // 'tanent.report',
      // 'tanent.sales',
      'whatsapp.instance.add',
       'invoices.index',
      'invoices.edit',
      'invoices.delete',
      'invoices.create.update',
      'invoices.deactive',
      'invoices.download.pdf',
      'invoices.edit.create'
    ];
  }

  public static function agentRoute()
  {
    return [
      'app.dashboard',
      'message.templates',
      'message.templates.edit',
      'email.templates',
      'email.templates.edit',
      'app.profile',
      'app.profile.save',
      'app.password.save',
      'message.exclude-list',
      'invoice.list',
      'invoice.view-invoice',
      'agreement.index',
      'agreement.add',
      'agreement.edit',
      'agreement.save',
      'agreement.delete',
      'whatsapp.blasting',
      'whatsapp.blasting.history',
      'show.file.contacts',
      'agent.tenants',
      'agent.tenants.edit',
      'agent.tenants.delete',
      'agent.tenants.create.update',
      'agent.tenants.active.update.deactive',
      'agent.landlord',
      'agent.landlord.edit',
      'agent.landlord.delete',
      'agent.landlord.create.update',
      'agent.landlord.active.update.deactive',
      'agent.rental.agreements',
      'agent.rental.agreement.edit',
      'agent.rental.agreement.delete',
      'agent.rental.agreement.create.update',
      'agent.rental.agreement.active.deactive',
      'invoices.index',
      'invoices.edit',
      'invoices.delete',
      'invoices.create.update',
      'invoices.deactive',
      'invoices.download.pdf',
      'invoices.edit.create'
    ];

  }
  public static function landLordRoute()
  {
    return [
      'app.dashboard',
      'app.profile',
      'app.profile.save',
      'app.password.save',
    ];
  }
  public static function tenentRoute()
  {
    return [
      'app.dashboard',
      'app.profile',
      'app.profile.save',
      'app.password.save'
    ];
  }

  public static function blockAccess($key)
  {
    $accessArr = [];
    if (isAdmin()) {
      $accessArr = [

      ];
    } elseif (isAgent()) {
      $accessArr = [
      ];
    } elseif (isLandLord()) {
      $accessArr = [

      ];
    } elseif (isTenent()) {
      $accessArr = [

      ];
    }
    return in_array($key, $accessArr);
  }
}