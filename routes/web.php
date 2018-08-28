<?php

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

Route::group(['middleware' => 'chuserrole','prefix'=>'category'],function () {

  Route::get('/',['uses'=>'CategoryController@index','user_permissions'=>'manage_category']);
  Route::get('create/{where_from}',['uses'=>'CategoryController@create','user_permissions'=>'add_category']);
  Route::get('/{id}/show',['uses'=>'CategoryController@show','user_permissions'=>'show_category']);
  Route::post('/store',['uses'=>'CategoryController@store','user_permissions'=>'add_category']);
  Route::get('/{id}/edit',['uses'=>'CategoryController@edit','user_permissions'=>'edit_category']);
  Route::get('/{id}/editcode',['uses'=>'CategoryController@editcode','user_permissions'=>'edit_category']);
  Route::post('/{id}',['uses'=>'CategoryController@update','user_permissions'=>'edit_category']);
  Route::post('/updatecode/{id}',['uses'=>'CategoryController@updatecode']);
  Route::get('index/{id}',['uses'=>'CategoryController@destroy','user_permissions'=>'delete_category']);
  Route::get('/search',['uses'=>'CategoryController@search','user_permissions'=>'manage_category']);
});



Route::group(['middleware' => 'chuserrole','prefix'=>'city'],function () {

  Route::get('/',['uses'=>'CityController@index','user_permissions'=>'manage_city']);
  Route::get('create',['uses'=>'CityController@create','user_permissions'=>'add_city']);
  Route::get('/{id}/show',['uses'=>'CityController@show','user_permissions'=>'show_city']);
  Route::post('/store',['uses'=>'CityController@store','user_permissions'=>'add_city']);
  Route::get('/{id}/edit',['uses'=>'CityController@edit','user_permissions'=>'edit_city']);
  Route::post('/{id}',['uses'=>'CityController@update','user_permissions'=>'edit_city']);
  Route::get('index/{id}',['uses'=>'CityController@destroy','user_permissions'=>'delete_city']);
  Route::get('/search',['uses'=>'CityController@search','user_permissions'=>'manage_city']);

});

Route::group(['middleware' => 'chuserrole','prefix'=>'country'],function () {

  Route::get('/',['uses'=>'CountryController@index','user_permissions'=>'manage_country']);
  Route::get('/create/{where_from}',['uses'=>'CountryController@create','user_permissions'=>'add_country']);
  Route::get('/{id}/show',['uses'=>'CountryController@show','user_permissions'=>'show_country']);
  Route::post('/store',['uses'=>'CountryController@store','user_permissions'=>'add_country']);
  Route::get('/{id}/edit',['uses'=>'CountryController@edit','user_permissions'=>'edit_country']);
  Route::post('/{id}',['uses'=>'CountryController@update','user_permissions'=>'edit_country']);
  Route::get('index/{id}',['uses'=>'CountryController@destroy','user_permissions'=>'delete_country']);
  Route::get('/search',['uses'=>'CountryController@search','user_permissions'=>'manage_country']);



});

Route::group(['middleware' => 'chuserrole','prefix'=>'service'],function () {

  Route::get('/',['uses'=>'ServiceController@index','user_permissions'=>'manage_service']);
  Route::get('create',['uses'=>'ServiceController@create','user_permissions'=>'add_service']);
  Route::get('/{id}/show',['uses'=>'ServiceController@show','user_permissions'=>'show_service']);
  Route::post('/store',['uses'=>'ServiceController@store','user_permissions'=>'add_service']);
  Route::get('/{id}/edit',['uses'=>'ServiceController@edit','user_permissions'=>'edit_service']);
  Route::get('/{id}/editcode',['uses'=>'ServiceController@editcode','user_permissions'=>'edit_service']);
  Route::post('/{id}',['uses'=>'ServiceController@update','user_permissions'=>'edit_service']);
  Route::post('/updatecode/{id}',['uses'=>'ServiceController@updatecode','user_permissions'=>'edit_service']);
  Route::get('index/{id}',['uses'=>'ServiceController@destroy','user_permissions'=>'delete_service']);
  Route::get('/search',['uses'=>'ServiceController@search','user_permissions'=>'manage_service']);

});

Route::group(['middleware' => 'chuserrole','prefix'=>'job'],function () {

  Route::get('/',['uses'=>'JobController@index','user_permissions'=>'manage_job']);
  Route::get('create/{where_from}',['uses'=>'JobController@create','user_permissions'=>'add_job']);
  Route::get('/{id}/show',['uses'=>'JobController@show','user_permissions'=>'show_job']);
  Route::post('/store',['uses'=>'JobController@store','user_permissions'=>'add_job']);
  Route::get('/{id}/edit',['uses'=>'JobController@edit','user_permissions'=>'edit_job']);
  Route::get('/{id}/editcode',['uses'=>'JobController@editcode','user_permissions'=>'edit_job']);
  Route::post('/{id}',['uses'=>'JobController@update','user_permissions'=>'edit_job']);
  Route::post('/updatecode/{id}',['uses'=>'JobController@updatecode','user_permissions'=>'edit_job']);
  Route::get('index/{id}',['uses'=>'JobController@destroy','user_permissions'=>'delete_job']);
  Route::get('/search',['uses'=>'JobController@search','user_permissions'=>'manage_job']);


});


Route::group(['middleware' => 'chuserrole','prefix'=>'account'],function () {

  Route::get('/',['uses'=>'accountController@index','user_permissions'=>'manage_account']);
  Route::get('create/{where_from}',['uses'=>'accountController@create','user_permissions'=>'add_account']);
  Route::get('/{id}/show',['uses'=>'accountController@show','user_permissions'=>'show_account']);
  Route::post('/store',['uses'=>'accountController@store','user_permissions'=>'add_account']);
  Route::get('/{id}/edit',['uses'=>'accountController@edit','user_permissions'=>'edit_account']);
  Route::post('/{id}',['uses'=>'accountController@update','user_permissions'=>'edit_account']);
  Route::get('index/{id}',['uses'=>'accountController@destroy','user_permissions'=>'delete_account']);
  Route::get('/search',['uses'=>'accountController@search','user_permissions'=>'manage_account']);

});

Route::group(['middleware' => 'chuserrole','prefix'=>'employee'],function () {

  Route::get('/',['uses'=>'EmployeeController@index','user_permissions'=>'manage_employee']);
  Route::get('create/{where_from}',['uses'=>'EmployeeController@create','user_permissions'=>'add_employee']);
  Route::get('/{id}/show',['uses'=>'EmployeeController@show','user_permissions'=>'show_employee']);
  Route::post('/store',['uses'=>'EmployeeController@store','user_permissions'=>'add_employee']);
  Route::get('/{id}/edit',['uses'=>'EmployeeController@edit','user_permissions'=>'edit_employee']);
  Route::post('/{id}',['uses'=>'EmployeeController@update','user_permissions'=>'edit_employee']);
  Route::get('index/{id}',['uses'=>'EmployeeController@destroy','user_permissions'=>'delete_employee']);
  Route::get('/search',['uses'=>'EmployeeController@search','user_permissions'=>'manage_employee']);

});

Route::group(['middleware' => 'chuserrole','prefix'=>'major'],function () {

  Route::get('/',['uses'=>'MajorController@index','user_permissions'=>'manage_major']);
  Route::get('create/{where_from}',['uses'=>'MajorController@create','user_permissions'=>'add_major']);
  Route::get('/{id}/show',['uses'=>'MajorController@show','user_permissions'=>'show_major']);
  Route::post('/store',['uses'=>'MajorController@store','user_permissions'=>'add_major']);
  Route::get('/{id}/edit',['uses'=>'MajorController@edit','user_permissions'=>'edit_major']);
  Route::post('/{id}',['uses'=>'MajorController@update','user_permissions'=>'edit_major']);
  Route::get('index/{id}',['uses'=>'MajorController@destroy','user_permissions'=>'delete_major']);
  Route::get('/search',['uses'=>'MajorController@search','user_permissions'=>'manage_major']);

});


Route::group(['middleware' => 'chuserrole','prefix'=>'templates'],function () {
  Route::get('/',['uses'=>'TemplatesController@index','user_permissions'=>'manage_template']);
  Route::get('/{id}/edit',['uses'=>'TemplatesController@edit','user_permissions'=>'edit_template']);
  Route::post('/{id}',['uses'=>'TemplatesController@update','user_permissions'=>'edit_template']);
});

Route::group(['middleware' => 'chuserrole','prefix'=>'customer'],function () {

  Route::get('/',['uses'=>'CustomerController@index','user_permissions'=>'manage_customer']);
  Route::get('create',['uses'=>'CustomerController@create','user_permissions'=>'add_customer']);
  Route::get('/{id}/show','CustomerController@show');
  Route::post('/store',['uses'=>'CustomerController@store','user_permissions'=>'add_customer']);
  Route::get('/{id}/edit',['uses'=>'CustomerController@edit','user_permissions'=>'edit_customer']);
  Route::post('/{id}',['uses'=>'CustomerController@update','user_permissions'=>'edit_customer']);
  Route::get('index/{id}',['uses'=>'CustomerController@destroy','user_permissions'=>'delete_customer']);
  Route::get('/search',['uses'=>'CustomerController@search','user_permissions'=>'manage_customer']);
  Route::get('/address/{id}',['uses'=>'CustomerController@get_address','user_permissions'=>'manage_customer']);
});

Route::prefix('tax')->group(function () {

  Route::get('/','TaxController@index');
  Route::get('create','TaxController@create');
  Route::get('/{id}/show','TaxController@show');
  Route::post('/store','TaxController@store');
  Route::get('/{id}/edit','TaxController@edit');
  Route::post('/{id}','TaxController@update');
  Route::get('index/{id}','TaxController@destroy');

});


Route::group(['middleware' => 'chuserrole','prefix'=>'invoice'],function () {

  Route::get('/',['uses'=>'InvoiceController@index','user_permissions'=>'customer_invoices']);
  Route::get('create',['uses'=>'InvoiceController@create','user_permissions'=>'add_invoices']);
  Route::get('/{id}/show',['uses'=>'InvoiceController@show','user_permissions'=>['manage_invoices','customer_invoices']]);
  Route::post('/store',['uses'=>'InvoiceController@store','user_permissions'=>'add_invoices']);
  Route::get('/{id}/edit',['uses'=>'InvoiceController@edit','user_permissions'=>'edit_invoices']);
  Route::post('/{id}',['uses'=>'InvoiceController@update','user_permissions'=>'edit_invoices']);
  Route::get('index/{id}',['uses'=>'InvoiceController@destroy','user_permissions'=>'delete_invoices']);
  Route::get('customer/{id}',['uses'=>'InvoiceController@customer','user_permissions'=>'invoices_rel_customers']);
  Route::get('/search',['uses'=>'InvoiceController@search','user_permissions'=>['manage_invoices','customer_invoices']]);
  Route::get('/all',['uses'=>'InvoiceController@all','user_permissions'=>'manage_invoices']);
  Route::get('/items/{id}',['uses'=>'InvoiceController@invoices_items','user_permissions'=>['add_invoices','edit_invoices']]);
  Route::post('/items/store',['uses'=>'InvoiceController@store_invoice_items','user_permissions'=>['add_invoices','edit_invoices']]);
  Route::get('/change/status/{id}/{ptype}',['uses'=>'InvoiceController@update_status','user_permissions'=>'up_invoice_status']);
  Route::get('/template/{id}/{t_type}',['uses'=>'InvoiceController@getTemplateData','user_permissions'=>['manage_invoices','customer_invoices']]);
  Route::post('/email/send',['uses'=>'InvoiceController@sendInvoice','user_permissions'=>'send_inv_email']);
});


Route::group(['middleware' => 'chuserrole','prefix'=>'quote'],function () {

  Route::get('/',['uses'=>'QuoteController@index','user_permissions'=>'customer_quote']);
  Route::get('create',['uses'=>'QuoteController@create','user_permissions'=>'add_quote']);
  Route::get('/{id}/show','QuoteController@show');
  Route::post('/store',['uses'=>'QuoteController@store','user_permissions'=>'add_quote']);
  Route::get('/{id}/edit',['uses'=>'QuoteController@edit','user_permissions'=>'edit_quote']);
  Route::post('/{id}',['uses'=>'QuoteController@update','user_permissions'=>'edit_quote']);
  Route::get('index/{id}',['uses'=>'QuoteController@destroy','user_permissions'=>'delete_quote']);
  Route::get('customer/{id}',['uses'=>'QuoteController@customer','user_permissions'=>'cu_under_quote']);
  Route::get('/search',['uses'=>'QuoteController@search','user_permissions'=>['customer_quote','manage_quote']]);
  Route::get('/all',['uses'=>'QuoteController@all','user_permissions'=>'manage_quote']);
  Route::get('/items/{id}',['uses'=>'QuoteController@quotes_items','user_permissions'=>['add_quote','edit_quote']]);
  Route::post('/items/store',['uses'=>'QuoteController@store_quote_items','user_permissions'=>['add_quote','edit_quote']]);
});

Route::group(['middleware' => 'chuserrole','prefix'=>'expense'],function () {

  Route::get('/',['uses'=>'ExpenseTypeController@index','user_permissions'=>'manage_expense_type']);
  Route::get('create/{where_from}',['uses'=>'ExpenseTypeController@create','user_permissions'=>'add_expense_type']);
  Route::get('/{id}/show','ExpenseTypeController@show');
  Route::post('/store',['uses'=>'ExpenseTypeController@store','user_permissions'=>'add_expense_type']);
  Route::get('/{id}/edit',['uses'=>'ExpenseTypeController@edit','user_permissions'=>'edit_expense_type']);
  Route::post('/{id}',['uses'=>'ExpenseTypeController@update','user_permissions'=>'edit_expense_type']);
  Route::get('index/{id}',['uses'=>'ExpenseTypeController@destroy','user_permissions'=>'delete_expense_type']);
  Route::get('/search',['uses'=>'ExpenseTypeController@search','user_permissions'=>'manage_expense_type']);

});

Route::group(['middleware' => 'chuserrole','prefix'=>'employeemajor'],function () {

  Route::get('/',['uses'=>'salaryController@index','user_permissions'=>'manage_salary']);
  Route::get('create/{where_from}',['uses'=>'salaryController@create','user_permissions'=>'add_salary']);
  Route::get('/{id}/show','salaryController@show');
  Route::post('/store',['uses'=>'salaryController@store','user_permissions'=>'add_salary']);
  Route::get('/{id}/edit',['uses'=>'salaryController@edit','user_permissions'=>'edit_salary']);
  Route::get('/{id}/editcode',['uses'=>'salaryController@editcode','user_permissions'=>'edit_salary']);
  Route::post('/{id}',['uses'=>'salaryController@update','user_permissions'=>'edit_salary']);
  Route::post('/updatecode/{id}',['uses'=>'salaryController@updatecode','user_permissions'=>'edit_salary']);
  Route::get('index/{id}',['uses'=>'salaryController@destroy','user_permissions'=>'delete_salary']);
  Route::get('/search',['uses'=>'salaryController@search','user_permissions'=>'manage_salary']);
});


Route::group(['middleware' => 'chuserrole','prefix'=>'extrasalary'],function () {

  Route::get('/',['uses'=>'ExtraSalaryController@index','user_permissions'=>'manage_extra_salary']);
  Route::get('/create',['uses'=>'ExtraSalaryController@create','user_permissions'=>'add_extra_salary']);
  Route::get('/{id}/show','ExtraSalaryController@show');
  Route::post('/store',['uses'=>'ExtraSalaryController@store','user_permissions'=>'add_extra_salary']);
  Route::get('/{id}/edit',['uses'=>'ExtraSalaryController@edit','user_permissions'=>'edit_extra_salary']);
  Route::post('/{id}',['uses'=>'ExtraSalaryController@update','user_permissions'=>'edit_extra_salary']);
  Route::get('index/{id}',['uses'=>'ExtraSalaryController@destroy','user_permissions'=>'delete_extra_salary']);
  Route::get('/search',['uses'=>'ExtraSalaryController@search','user_permissions'=>'manage_extra_salary']);
});

Route::group(['middleware' => 'chuserrole','prefix'=>'bouns'],function () {

  Route::get('/',['uses'=>'BounsController@index','user_permissions'=>'manage_bouns']);
  Route::get('/create',['uses'=>'BounsController@create','user_permissions'=>'add_bouns']);
  Route::get('/{id}/show','BounsController@show');
  Route::post('/store',['uses'=>'BounsController@store','user_permissions'=>'add_bouns']);
  Route::get('/{id}/edit',['uses'=>'BounsController@edit','user_permissions'=>'edit_bouns']);
  Route::post('/{id}',['uses'=>'BounsController@update','user_permissions'=>'edit_bouns']);
  Route::get('index/{id}',['uses'=>'BounsController@destroy','user_permissions'=>'delete_bouns']);
  Route::get('/search',['uses'=>'BounsController@search','user_permissions'=>'manage_bouns']);
});

Route::group(['middleware' => 'chuserrole','prefix'=>'discount'],function () {

  Route::get('/',['uses'=>'DiscountController@index','user_permissions'=>'manage_discount']);
  Route::get('/create',['uses'=>'DiscountController@create','user_permissions'=>'add_discount']);
  Route::get('/{id}/show','DiscountController@show');
  Route::post('/store',['uses'=>'DiscountController@store','user_permissions'=>'add_discount']);
  Route::get('/{id}/edit',['uses'=>'DiscountController@edit','user_permissions'=>'edit_discount']);
  Route::post('/{id}',['uses'=>'DiscountController@update','user_permissions'=>'edit_discount']);
  Route::get('index/{id}',['uses'=>'DiscountController@destroy','user_permissions'=>'delete_discount']);
  Route::get('/search',['uses'=>'DiscountController@search','user_permissions'=>'manage_discount']);
});

Route::group(['middleware' => 'chuserrole','prefix'=>'user'],function () {

  Route::get('/',['uses'=>'UserController@index','user_permissions'=>'manage_user']);
  Route::get('/{id}/show','UserController@show');
  Route::get('/{id}/edit',['uses'=>'UserController@edit','user_permissions'=>'edit_user']);
  Route::post('/{id}',['uses'=>'UserController@update','user_permissions'=>'edit_user']);
  Route::get('index/{id}',['uses'=>'UserController@destroy','user_permissions'=>'delete_user']);
  Route::get('/search',['uses'=>'UserController@search','user_permissions'=>'manage_user']);
  Route::get('/roles/{id}',['uses'=>'UserController@user_roles','user_permissions'=>'manage_user_roles']);
  Route::post('/roles/store',['uses'=>'UserController@user_role_store','user_permissions'=>'manage_user_roles']);
});

Route::group(['middleware' => 'chuserrole','prefix'=>'transactions'],function () {
  Route::get('/{trans_type}',['uses'=>'TransactionController@index','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);
  Route::get('index/{id}',['uses'=>'TransactionController@destroy','user_permissions'=>['delete_transfer','delete_expense','delete_income']]);
  Route::get('/create/{trans_type}',['uses'=>'TransactionController@create','user_permissions'=>['add_transfer','add_expense','add_income']]);
  Route::post('/store',['uses'=>'TransactionController@store','user_permissions'=>['add_transfer','add_expense','add_income']]);
  Route::get('/search',['uses'=>'TransactionController@search','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);
  Route::get('/show/balancesheet',['uses'=>'TransactionController@balance','user_permissions'=>'view_balance_sheet']);
  Route::get('/{id}/balanceDetails',['uses'=>'TransactionController@balanceTransactionDetails','user_permissions'=>'view_balance_sheet_details']);
  Route::get('/show/invoices',['uses'=>'TransactionController@invoices','user_permissions'=>'view_payments']);
  Route::get('/{id}/invoicesDetails',['uses'=>'TransactionController@invoicesDetails','user_permissions'=>'view_payments_details']);
  Route::get('/income/{id}',['uses'=>'TransactionController@invoices_income','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);

});

Route::group(['middleware' => 'chuserrole','prefix'=>'reports'],function () {
  Route::get('/transaction/{trans_type}',['uses'=>'ReportController@transaction','user_permissions'=>['income_report','expense_report']]);
  Route::get('/transaction/filter/{trans_type}',['uses'=>'ReportController@filterTransactionByDate','user_permissions'=>['expense_income_by_date','expense_income_by_date_range']]);
  Route::get('/search',['uses'=>'ReportController@search','user_permissions'=>['income_report','expense_report','expense_income_by_date','expense_income_by_date_range']]);
  Route::get('/invoices',['uses'=>'ReportController@invoices','user_permissions'=>'invoice_report']);
  Route::get('/invoicesearch',['uses'=>'ReportController@invoiceSearch','user_permissions'=>'invoice_report']);
});


Route::group(['middleware' => 'chuserrole','prefix'=>'roles'],function () {
  Route::get('/createpermission','RoleController@createpermission');
  Route::post('/storepermission','RoleController@storepermission');

  Route::get('/',['uses'=>'RoleController@index','user_permissions'=>'manage_roles']);
  Route::get('create',['uses'=>'RoleController@create','user_permissions'=>'add_role']);
  Route::get('/{id}/show','RoleController@show');
  Route::post('/store',['uses'=>'RoleController@store','user_permissions'=>'add_role']);
  Route::get('/{id}/edit',['uses'=>'RoleController@edit','user_permissions'=>'edit_role']);
  Route::post('/{id}',['uses'=>'RoleController@update','user_permissions'=>'edit_role']);
  Route::get('index/{id}',['uses'=>'RoleController@destroy','user_permissions'=>'delete_role']);
  Route::get('/user/{id}',['uses'=>'RoleController@user_roles','user_permissions'=>'user_under_role']);
  Route::get('/permissions/{id}',['uses'=>'RoleController@permissions','user_permissions'=>'add_permisions']);
  Route::post('/permissions/store',['uses'=>'RoleController@store_permissions','user_permissions'=>'add_permisions']);
});

Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/settings/{id}/edit', 'HomeController@getSetting');
Route::post('/settings/{id}','HomeController@update_setting');
Route::get('nopermission','HomeController@nopermission');
