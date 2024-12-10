<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageTemplatesController;
use App\Http\Controllers\BirthdayTemplatesController;
use App\Http\Controllers\RentalTemplateController;
use App\Http\Controllers\WhatsappInstanceController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\NewTenantController;
use App\Http\Controllers\NewLandlordController;
use App\Http\Controllers\RentalAgreementController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceSettingController;
use App\Http\Controllers\EmailTemplatesController;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Models\User;
use App\Models\RentalAgreement;
use Illuminate\Support\Facades\DB;


Route::get('/check-user-id', function () {

       $user_id = auth()->guard(userGuard())->user()->id;
       $emailTemplate = DB::table('email_templates')->where('agent_id',$user_id)->first();
        return "User ID: $emailTemplate->agent_id";
    
});

// Example implementation of userGuard() function


Route::get('/showAgentEmails', function () {
     $usersWithReminderEmail = User::where('reminder_email_toggle', 1)->pluck('id');

$dueDate = Carbon::now()->addDays(7);

$agentIds = RentalAgreement::whereIn('agent_id', $usersWithReminderEmail)
   ->whereDate('end_date', '=',  $dueDate->toDateString())
    ->pluck('tenant_id');


    // Now, fetch the corresponding emails using the agent IDs
    $agentEmails = User::whereIn('id', $agentIds)->pluck('email', 'agent_id');


    // Display the result
    return view('agentEmails')->with('agentEmails', $usersWithReminderEmail);
});


// Now $agentEmails contains the emails of users with reminder_email set to 1 and their corresponding agent emails.



Route::group(['prefix' => '', 'namespace' => '\App\Http\Controllers', 'middleware' => []], function () {
    Route::group(['prefix' => '', 'middleware' => ['web']], function () {
            // Without Login
            Route::group(['prefix' => ''], function () {
                    
                    // Route::get('tenent/login', 'AuthController@login')->name('app.telent.login');
                    // Route::post('tenent-login', 'AuthController@telentLogin')->name('app.telent.login-submit');
                    // Route::get('home', 'DashboardController@index')->name('app.dashboard.tenent');
             
                Route::group(['prefix' => 'login'], function () {
                    Route::get('', 'AuthController@login')->name('app.login');
                    Route::post('submit', 'AuthController@loginSubmit')->name('app.submit-login');
                    Route::get('forget-password', 'AuthController@showForgetPasswordForm')->name('app.forgot.form');
                    Route::post('forget-password', 'AuthController@submitForgetPasswordForm')->name('forget.password-submit');
                    Route::get('reset-password', 'AuthController@resetPassword')->name('reset.password.form');
                    Route::post('reset-password', 'AuthController@submitResetPasswordForm')->name('reset.password.submit-form');
                });
                Route::get('logout', 'AuthController@logout')->name('app.logout');
                Route::get("/add-agent",'AgentController@index')->name('add.agent');
                Route::get("/agent-add",'AgentController@form')->name('agent.add');
                Route::post("/agent-save",'AgentController@save')->name('agent.save');
            });
            //Invoice Setting
            Route::any('/submitInvioce','InvoiceSettingController@submitInvoice')->name('Invoice-setting');

            // With Login
            Route::group(['prefix' => '', 'middleware' => ['user']], function () {
            Route::get('', 'DashboardController@index')->name('app.dashboard');
            Route::any('/profile', 'UserController@updateProfileForm')->name('app.profile');
            Route::post('/profile-save', 'UserController@updateProfile')->name('app.profile.save');
            Route::post('/password-change', 'UserController@changePassword')->name('app.password.save');
            Route::post('/enableEmail', 'UserController@enableEmail')->name('app.password.email');
            //    message templates
            Route::get('message/templates', 'MessageTemplatesController@index')->name('message.templates');
            Route::get('message-templates/action/{id?}', 'MessageTemplatesController@edit')->name('message.templates.edit');
            Route::post('delete-template', 'MessageTemplatesController@delete')->name('message.template.delete');
            Route::post('create-update-template', 'MessageTemplatesController@createUpdate')->name('message.template.create.update');
            Route::post('message/template-active-deactive', 'MessageTemplatesController@activeDeactiveMessageTemplate')->name('message.template.active.update.deactive');           
           
            //   email templates
            Route::get('email/templates', 'EmailTemplatesController@index')->name('email.templates');
            Route::get('email-templates/action/{id?}', 'EmailTemplatesController@edit')->name('email.templates.edit');
            Route::post('delete-email', 'EmailTemplatesController@delete')->name('email.template.delete');
            Route::post('create-update-email', 'EmailTemplatesController@createUpdate')->name('email.template.create.update');
            Route::post('email/template-active-deactive', 'EmailTemplatesController@activeDeactiveMessageTemplate')->name('email.template.active.update.deactive');           
        
           
            //   landlord
            Route::get('/landlords', 'NewLandlordController@index')->name('agent.landlord');
            Route::get('landlord/action/{id?}', 'NewLandlordController@edit')->name('agent.landlord.edit');
            Route::post('/landlord-Birthday', 'BirthdayEmailReminderController@birthdayRemiderUpdate')->name('agent.landlord.birthday.notification');
            Route::post('delete-landlord', 'NewLandlordController@delete')->name('agent.landlord.delete');
            Route::post('create-update-landlord', 'NewLandlordController@createUpdate')->name('agent.landlord.create.update');
            Route::post('/landlord-active-deactive', 'NewLandlordController@activeDeactiveTenant')->name('agent.landlord.active.update.deactive');    
            Route::get('/landlordsContact-Download', 'NewLandlordController@downloadContact')->name('agent.landlord.downloadContact');
            Route::get('/tenantContact-Download', 'NewTenantController@downloadContact')->name('agent.tenant.downloadContact');
            

            //   tenants
            Route::get('/tenants', 'NewTenantController@index')->name('agent.tenants');
            Route::get('tenant/action/{id?}', 'NewTenantController@edit')->name('agent.tenants.edit');
            Route::post('delete-tenant', 'NewTenantController@delete')->name('agent.tenants.delete');
            Route::post('create-update-tenants', 'NewTenantController@createUpdate')->name('agent.tenants.create.update');
            Route::post('/tenant-active-deactive', 'NewTenantController@activeDeactiveTenant')->name('agent.tenants.active.update.deactive');           
            // birthdat templates
            Route::get('birthday/templates', 'BirthdayTemplatesController@index')->name('birthday.templates');
            Route::get('birthday/templates/action/{id?}', 'BirthdayTemplatesController@edit')->name('birthday.templates.edit');
            Route::post('birthday/delete-template', 'BirthdayTemplatesController@delete')->name('birthday.template.delete');
            Route::post('birthday/create-update-template', 'BirthdayTemplatesController@createUpdate')->name('birthday.template.create.update');
            Route::post('birthday/template-active-deactive', 'BirthdayTemplatesController@activeDeactiveBirthdayTemplate')->name('birthday.template.active.update.deactive');
            Route::post('birthday/birthday-template-set-default', 'BirthdayTemplatesController@setTemplateDefault')->name('birthday.template.set.default');
            // rental templates
            Route::get('rental/templates', 'RentalTemplateController@index')->name('rental.templates');
            Route::get('rental/templates/action/{id?}', 'RentalTemplateController@edit')->name('rental.templates.edit');
            Route::post('rental/delete-template', 'RentalTemplateController@delete')->name('rental.template.delete');
            Route::post('rental/create-update-template', 'RentalTemplateController@createUpdate')->name('rental.template.create.update');
            Route::post('rental/rental-active-deactive', 'RentalTemplateController@activeDeactiveRentalTemplate')->name('rental.template.active.update.deactive');
            Route::post('rental/rental-template-set-default', 'RentalTemplateController@setTemplateDefault')->name('rental.template.set.default');
            //    rental agreement
            Route::get('/rental-agreement', 'RentalAgreementController@index')->name('agent.rental.agreements');
            Route::post('/rental-agreement/show', 'RentalAgreementController@show')->name('agent.rental.agreement.show');
            Route::post('/rental-agreement/parse', 'RentalAgreementController@parse')->name('agent.rental.agreement.parse');
            Route::get('rental-agreement/action/{id?}', 'RentalAgreementController@edit')->name('agent.rental.agreement.edit');
            Route::get('rental-agreement-invoice/{id?}', 'RentalAgreementController@gotinvoice')->name('agent.rental.agreement.invoice');
            Route::get('rental-agreement-createinvoice/{id?}', 'RentalAgreementController@createinvoice')->name('agent.rental.agreement.createinvoice');
            
            
            Route::post('delete-rental-agreement', 'RentalAgreementController@delete')->name('agent.rental.agreement.delete');
            Route::post('create-update-rental-agreement', 'RentalAgreementController@createUpdate')->name('agent.rental.agreement.create.update');
            Route::post('/rental-agreement-active-deactive', 'RentalAgreementController@activeDeactiveTenant')->name('agent.rental.agreement.active.deactive');           
            // invoices
            Route::get('/invoices', 'InvoiceController@index')->name('invoices.index');
            Route::get('invoices/action/{id?}', 'InvoiceController@edit')->name('invoices.edit.create');
            Route::post('delete-invoices', 'InvoiceController@delete')->name('invoices.delete');
            Route::post('create-update-invoices', 'InvoiceController@createUpdate')->name('invoices.create.update');
            Route::post('/invoices-deactive', 'InvoiceController@changeStatus')->name('invoices.change.status');           
            Route::get('/download/receipt/{id?}/{type?}', 'InvoiceController@downloadReceipt')->name('invoices.download.pdf');           
               
                //! information routes start
                Route::get('info', function () {
                    phpinfo();
                });
                Route::get('server-time', function () {
                    print_r([time(), date("Y-m-d H:i:s")]);
                });
                //! information routes end

                //AGENT ROUTE
                Route::match(['get','post'],"/agent",'AgentController@index')->name('agent.index');
                Route::get("/add-agent",'AgentController@addAgent')->name('add.agent');
                Route::post("/send-agent-link",'AgentController@sendAgent')->name('resend.agent.link');
                // Route::get("/show-agent",'AgentController@showAgent')->name('show.agent');
                Route::get("/agent-edit/{id}",'AgentController@form')->name('agent.edit');
                Route::post("/agent-delete/{id}",'AgentController@delete')->name('agent.delete');
                Route::post('/sent-link','AgentController@sentLinkAgent')->name('agent.sent.link');
                Route::match(['get','post'],"/agent-activity/{id}",'AgentController@agentActivityIndex')->name('agent.report');
                Route::match(['get','post'],"/agent-sale/{id}",'AgentController@agentSaleReport')->name('agent.sales');
                // agrements 
                
                Route::get('user/agreements', 'AgreementController@index')->name('user.agreements');
                Route::get('user/agreement/{id?}', 'AgreementController@edit')->name('user.agreements.edit');
                Route::post('delete-agreements', 'AgreementController@delete')->name('agreements.delete');
                Route::post('create-update-agreements', 'AgreementController@createUpdate')->name('agreements.create.update');
                Route::post('Active/Deactive/agreements', 'AgreementController@activeDeactiveUser')->name('agreement.active.deactive');

                // instance routes
                // Route::match(['get','post'],"/agent",'AgentController@index')->name('agent.index');
                Route::match(['get','post'],"/instance/sleep/timer",'WhatsappInstanceController@instanceSleepTimer')->name('whatsapp.instance.sleep.timer');
                Route::post("/instance/sleep/timer",'WhatsappInstanceController@saveSleepTimer')->name('whatsapp.instance.sleep.timer.update');
                Route::match(['get','post'],"/instances",'WhatsappInstanceController@index')->name('whatsapp.instance.index');
                Route::get("/instance-edit/{id?}",'WhatsappInstanceController@edit')->name('whatsapp.instance.edit');
                Route::post("/createUpdate",'WhatsappInstanceController@createUpdate')->name('whatsapp.instance.create.update');
                Route::get("/deleteInstance/{id?}",'WhatsappInstanceController@delete')->name('whatsapp.instance.create.delete');
                Route::get("/create-instance",'WhatsappInstanceController@create')->name('whatsapp.instance.add');
                Route::get("/qr-code",'WhatsappInstanceController@getQrCode')->name('whatsapp.instance.qr.code');
                Route::get("/webhook",'WhatsappInstanceController@webhook')->name('whatsapp.instance.webhook');
                Route::get("/import-file",'WhatsappInstanceController@importFile')->name('whatsapp.instance.import.excel.page');
                Route::post("/import-data",'WhatsappInstanceController@importExcelFile')->name('whatsapp.instance.import.excel');
                Route::get("/whatsapp/blasting",'WhatsappInstanceController@whatappBlasting')->name('whatsapp.blasting');
                Route::get("whatsapp/agent/status",'WhatsappInstanceController@checkAgentStatus')->name('check.agent.whatsapp.instance.status');
                Route::post("whatsapp/agent/number",'WhatsappInstanceController@checkAgentNumber')->name('check.agent.whatsapp.number');
                Route::post("whatsapp/update/csvession",'WhatsappInstanceController@updateCSVSession')->name('update.csv.session');
                Route::get("whatsapp/update/sendCSVMsgs",'WhatsappInstanceController@sendCSVMsgs')->name('send.sms.whatsapp');

                Route::get("/whatsapp/history",'WhatsappInstanceController@whatappHistory')->name('whatsapp.blasting.history');
                Route::get("/whatsapp/file/status/{id?}",'WhatsappInstanceController@WhatsappFileContacts')->name('show.file.contacts');
                Route::post("/whatsapp/resend/message",'WhatsappInstanceController@resendMessage')->name('resend.whatsapp.message.link');
                Route::get("/whatsapp/instance/logout/{json?}",'WhatsappInstanceController@instanceLogout')->name('whatsapp.instance.logout');

                //MESSAGE ROUTE
                Route::match(['get','post'],"/message",'MessageTemplateController@index')->name('message.index');
                Route::match(['get','post'],"/email",'MessageTemplateController@emailIndex')->name('email.index');
                Route::get("/message-add",'MessageTemplateController@form')->name('message.add');
                Route::post("/message-save",'MessageTemplateController@save')->name('message.save');
                Route::get("/message-edit/{id}",'MessageTemplateController@form')->name('message.edit');
                Route::post("/message-delete/{id}",'MessageTemplateController@delete')->name('message.delete');
                Route::match(['get','post'],'/exclude-list','MessageTemplateController@excludeList')->name('message.exclude-list');
                //UPLOAD TEMPLATE ROUTES
                Route::match(['get','post'],"/template",'UploadTemplateController@index')->name('template.invoice');
                Route::match(['get','post'],"/template",'UploadTemplateController@index')->name('template.agreement');
                Route::match(['get','post'],"/template",'UploadTemplateController@index')->name('template.receipt');
                Route::get("/template-add",'UploadTemplateController@form')->name('template.add');
                Route::post("/template-save",'UploadTemplateController@save')->name('template.save');
                Route::get("/template-edit/{id}",'UploadTemplateController@form')->name('template.edit');
                Route::post("/template-delete/{id}",'UploadTemplateController@delete')->name('template.delete');
                    // Users Actions 
                Route::get('/show/users', 'UserController@getUsers')->name('show.users');
                Route::post('/show/getUserProfile', 'UserController@getUserProfile')->name('show.getUserProfile');
                Route::post('/active/deactive/user', 'UserController@activeDeactiveUser')->name('users.active.deactive');
                //REPORT ROUTES
                Route::get("/sales",'ReportController@index')->name('report.sales');
                //Invoice Route
                // Route::match(['get','post'],"/invoice",'InvoiceController@index')->name('invoice.list');
                // Route::get("/view-invoice/{id}",'InvoiceController@viewInvoice')->name('invoice.view-invoice');
                //Agreement Route
                Route::match(['get','post'],"/agreement",'AgreementController@index')->name('agreement.index');
                Route::get("/agreement-add",'AgreementController@form')->name('agreement.add');
                Route::get("/agreement-edit/{id}",'AgreementController@form')->name('agreement.edit');
                Route::post("/agreement-save",'AgreementController@save')->name('agreement.save');
                Route::post("/agreement-delete/{id}",'AgreementController@delete')->name('agreement.delete');

            });
    });
    
    // Route::get("/send-msg",'ScriptController@sendMessage')->name('send.whatsapp.message');
    // Route::get("/app-logout",'ScriptController@changeStauts')->name('send.whatsapp.message');
    Route::get("/busy-logout",'ScriptController@logoutBusy')->name('logout.busy.instance');
    Route::get("/cron",'ScriptController@cron');

});