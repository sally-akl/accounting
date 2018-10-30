<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thesesalar

| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'category'],function () {

  Route::get('/{lang}',['uses'=>'CategoryController@index','user_permissions'=>'manage_category']);
  Route::get('create/{where_from}/{lang}',['uses'=>'CategoryController@create','user_permissions'=>'add_category']);
  Route::get('/{id}/show/{lang}',['uses'=>'CategoryController@show','user_permissions'=>'show_category']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'CategoryController@store','user_permissions'=>'add_category']);
  Route::get('/{id}/edit/{lang}',['uses'=>'CategoryController@edit','user_permissions'=>'edit_category']);
  Route::get('/{id}/editcode/{lang}',['uses'=>'CategoryController@editcode','user_permissions'=>'edit_category']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'CategoryController@update','user_permissions'=>'edit_category']);
  Route::post('/updatecode/{id}/{lang}',['uses'=>'CategoryController@updatecode','user_permissions'=>'edit_category']);
  Route::get('index/{id}/{lang}',['uses'=>'CategoryController@destroy','user_permissions'=>'delete_category']);
  Route::get('/search/{lang}',['uses'=>'CategoryController@search','user_permissions'=>'manage_category']);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches'],'before' => 'auth.basic','prefix'=>'contracts'],function () {
  Route::get('/{lang}',['uses'=>'ContractsController@index','user_permissions'=>'manage_contract']);
  Route::get('create/{lang}',['uses'=>'ContractsController@create','user_permissions'=>'add_contract']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'ContractsController@store','user_permissions'=>'add_contract']);
  Route::get('index/{id}/{lang}',['uses'=>'ContractsController@destroy','user_permissions'=>'delete_contract']);
  Route::get('/search/{lang}',['uses'=>'ContractsController@search','user_permissions'=>'manage_contract']);
});


Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'ajax'],function () {
    Route::get('/salary/details/{id}/{lang}',['uses'=>'AjaxController@employee_salary_details','user_permissions'=>['manage_employee']]);
    Route::get('/invoice/{id}/{lang}',['uses'=>'AjaxController@get_invoice_details','user_permissions'=>['manage_invoices']]);

    Route::get('/emp/user/{id}/{lang}',['uses'=>'AjaxController@setRelatedUser','user_permissions'=>['manage_employee','manage_user']]);
    Route::post('employeeuser/store/{lang}',['uses'=>'AjaxController@setUserEmpStore','user_permissions'=>'manage_employee','manage_user']);
    Route::get('/invoices/transactions/{id}/{lang}',['uses'=>'AjaxController@getTransactionsByInvoices','user_permissions'=>['employee_income']]);
    Route::get('/contract/{id}/{lang}',['before' => 'csrf','uses'=>'AjaxController@getContractDetails','user_permissions'=>['manage_contract']]);


});


Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'salarysettings'],function () {

  Route::get('/{mtype}/{lang}',['uses'=>'SalariesSettingsController@index','user_permissions'=>['manage_extra_bouns','manage_extra_discount','manage_extra_extra_salary']]);
  Route::get('create/{mtype}/{lang}',['uses'=>'SalariesSettingsController@create','user_permissions'=>['add_extra_bouns','add_extra_discount','add_extra_extra_salary']]);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'SalariesSettingsController@store','user_permissions'=>['add_extra_bouns','add_extra_discount','add_extra_extra_salary']]);
  Route::get('/{id}/edit/{mtype}/{lang}',['uses'=>'SalariesSettingsController@edit','user_permissions'=>['edit_extra_bouns','edit_extra_discount','edit_extra_extra_salary']]);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'SalariesSettingsController@update','user_permissions'=>['edit_extra_bouns','edit_extra_discount','edit_extra_extra_salary']]);
  Route::get('index/{id}/{lang}',['uses'=>'SalariesSettingsController@destroy','user_permissions'=>['delete_extra_bouns','delete_extra_discount','delete_extra_extra_salary']]);
  Route::get('/search/all/{lang}',['uses'=>'SalariesSettingsController@search','user_permissions'=>['manage_extra_bouns','manage_extra_discount','manage_extra_extra_salary']]);
});


Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'branch'],function () {

  Route::get('/{lang}',['uses'=>'BranchController@index','user_permissions'=>'manage_branch']);
  Route::get('create/{lang}',['uses'=>'BranchController@create','user_permissions'=>'add_branch']);
  Route::get('/{id}/show/{lang}',['uses'=>'BranchController@show','user_permissions'=>'show_branch']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'BranchController@store','user_permissions'=>'add_branch']);
  Route::get('/{id}/edit/{lang}',['uses'=>'BranchController@edit','user_permissions'=>'edit_branch']);
  Route::get('/{id}/editcode/{lang}',['uses'=>'BranchController@editcode','user_permissions'=>'edit_branch']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'BranchController@update','user_permissions'=>'edit_branch']);
  Route::post('/updatecode/{id}/{lang}',['before' => 'csrf','uses'=>'BranchController@updatecode','user_permissions'=>'edit_branch']);
  Route::get('index/{id}/{lang}',['uses'=>'BranchController@destroy','user_permissions'=>'delete_branch']);
  Route::get('/search/{lang}',['uses'=>'BranchController@search','user_permissions'=>'manage_branch']);
});



Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'city'],function () {

  Route::get('/{c}/{lang}',['uses'=>'CityController@index','user_permissions'=>'manage_city']);
  Route::get('create/{c}/{lang}',['uses'=>'CityController@create','user_permissions'=>'add_city']);
  Route::get('/{id}/show/{lang}',['uses'=>'CityController@show','user_permissions'=>'show_city']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'CityController@store','user_permissions'=>'add_city']);
  Route::get('/{id}/edit/{c}/{lang}',['uses'=>'CityController@edit','user_permissions'=>'edit_city']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'CityController@update','user_permissions'=>'edit_city']);
  Route::get('index/{id}/{lang}',['uses'=>'CityController@destroy','user_permissions'=>'delete_city']);
  Route::get('/search/all/{lang}',['uses'=>'CityController@search','user_permissions'=>'manage_city']);
  Route::get('/country/{id}/{lang}',['uses'=>'CityController@get_city_by_country','user_permissions'=>'manage_city']);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'country'],function () {

  Route::get('/{lang}',['uses'=>'CountryController@index','user_permissions'=>'manage_country']);
  Route::get('/create/{where_from}/{lang}',['uses'=>'CountryController@create','user_permissions'=>'add_country']);
  Route::get('/{id}/show/{lang}',['uses'=>'CountryController@show','user_permissions'=>'show_country']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'CountryController@store','user_permissions'=>'add_country']);
  Route::get('/{id}/edit/{lang}',['uses'=>'CountryController@edit','user_permissions'=>'edit_country']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'CountryController@update','user_permissions'=>'edit_country']);
  Route::get('index/{id}/{lang}',['uses'=>'CountryController@destroy','user_permissions'=>'delete_country']);
  Route::get('/search/{lang}',['uses'=>'CountryController@search','user_permissions'=>'manage_country']);

});


Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'customerrequests'],function () {

  Route::get('/{id}/{lang}',['uses'=>'CustomersRequestsController@index','user_permissions'=>'manage_customer_requests']);
  Route::get('create/{id}/{lang}',['uses'=>'CustomersRequestsController@create','user_permissions'=>'add_customer_request']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'CustomersRequestsController@store','user_permissions'=>'add_customer_request']);
  Route::get('/{id}/edit/{c}/{lang}',['uses'=>'CustomersRequestsController@edit','user_permissions'=>'edit_customer_request']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'CustomersRequestsController@update','user_permissions'=>'edit_customer_request']);
  Route::get('index/{id}/{lang}',['uses'=>'CustomersRequestsController@destroy','user_permissions'=>'delete_customer_request']);
  Route::get('/search/all/{lang}',['uses'=>'CustomersRequestsController@search','user_permissions'=>'manage_customer_requests']);

  });

  Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'customercomplain'],function () {

    Route::get('/{id}/{lang}',['uses'=>'CustomersComplainController@index','user_permissions'=>'manage_customer_requests']);
    Route::get('create/{id}/{lang}',['uses'=>'CustomersComplainController@create','user_permissions'=>'add_customer_request']);
    Route::post('/store/{lang}',['before' => 'csrf','uses'=>'CustomersComplainController@store','user_permissions'=>'add_customer_request']);
    Route::get('/{id}/edit/{c}/{lang}',['uses'=>'CustomersComplainController@edit','user_permissions'=>'edit_customer_request']);
    Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'CustomersComplainController@update','user_permissions'=>'edit_customer_request']);
    Route::get('index/{id}/{lang}',['uses'=>'CustomersComplainController@destroy','user_permissions'=>'delete_customer_request']);
    Route::get('/search/all/{lang}',['uses'=>'CustomersComplainController@search','user_permissions'=>'manage_customer_requests']);

    });



Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'service'],function () {

  Route::get('/{lang}',['uses'=>'ServiceController@index','user_permissions'=>'manage_service']);
  Route::get('create/{lang}',['uses'=>'ServiceController@create','user_permissions'=>'add_service']);
  Route::get('/{id}/show/{lang}',['uses'=>'ServiceController@show','user_permissions'=>'show_service']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'ServiceController@store','user_permissions'=>'add_service']);
  Route::get('/{id}/edit/{lang}',['uses'=>'ServiceController@edit','user_permissions'=>'edit_service']);
  Route::get('/{id}/editcode/{lang}',['uses'=>'ServiceController@editcode','user_permissions'=>'edit_service']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'ServiceController@update','user_permissions'=>'edit_service']);
  Route::post('/updatecode/{id}/{lang}',['before' => 'csrf','uses'=>'ServiceController@updatecode','user_permissions'=>'edit_service']);
  Route::get('index/{id}/{lang}',['uses'=>'ServiceController@destroy','user_permissions'=>'delete_service']);
  Route::get('/search/{lang}',['uses'=>'ServiceController@search','user_permissions'=>'manage_service']);

});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'job'],function () {

  Route::get('/{lang}',['uses'=>'JobController@index','user_permissions'=>'manage_job']);
  Route::get('create/{where_from}/{lang}',['uses'=>'JobController@create','user_permissions'=>'add_job']);
  Route::get('/{id}/show/{lang}',['uses'=>'JobController@show','user_permissions'=>'show_job']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'JobController@store','user_permissions'=>'add_job']);
  Route::get('/{id}/edit/{lang}',['uses'=>'JobController@edit','user_permissions'=>'edit_job']);
  Route::get('/{id}/editcode/{lang}',['uses'=>'JobController@editcode','user_permissions'=>'edit_job']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'JobController@update','user_permissions'=>'edit_job']);
  Route::post('/updatecode/{id}/{lang}',['before' => 'csrf','uses'=>'JobController@updatecode','user_permissions'=>'edit_job']);
  Route::get('index/{id}/{lang}',['uses'=>'JobController@destroy','user_permissions'=>'delete_job']);
  Route::get('/search/{lang}',['uses'=>'JobController@search','user_permissions'=>'manage_job']);


});


Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'account'],function () {

  Route::get('/{lang}',['uses'=>'accountController@index','user_permissions'=>'manage_account']);
  Route::get('create/{where_from}/{lang}',['uses'=>'accountController@create','user_permissions'=>'add_account']);
  Route::get('/{id}/show/{lang}',['uses'=>'accountController@show','user_permissions'=>'show_account']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'accountController@store','user_permissions'=>'add_account']);
  Route::get('/{id}/edit/{lang}',['uses'=>'accountController@edit','user_permissions'=>'edit_account']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'accountController@update','user_permissions'=>'edit_account']);
  Route::get('index/{id}/{lang}',['uses'=>'accountController@destroy','user_permissions'=>'delete_account']);
  Route::get('/search/{lang}',['uses'=>'accountController@search','user_permissions'=>'manage_account']);

});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'employee'],function () {

  Route::get('/{lang}',['uses'=>'EmployeeController@index','user_permissions'=>'manage_employee']);
  Route::get('create/{where_from}/{lang}',['uses'=>'EmployeeController@create','user_permissions'=>'add_employee']);
  Route::get('/{id}/show/{lang}',['uses'=>'EmployeeController@show','user_permissions'=>'show_employee']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'EmployeeController@store','user_permissions'=>'add_employee']);
  Route::get('/{id}/edit/{lang}',['uses'=>'EmployeeController@edit','user_permissions'=>'edit_employee']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'EmployeeController@update','user_permissions'=>'edit_employee']);
  Route::get('index/{id}/{lang}',['uses'=>'EmployeeController@destroy','user_permissions'=>'delete_employee']);
  Route::get('/search/{lang}',['uses'=>'EmployeeController@search','user_permissions'=>'manage_employee']);

});

Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'major'],function () {

  Route::get('/{lang}',['uses'=>'MajorController@index','user_permissions'=>'manage_major']);
  Route::get('create/{where_from}/{lang}',['uses'=>'MajorController@create','user_permissions'=>'add_major']);
  Route::get('/{id}/show/{lang}',['uses'=>'MajorController@show','user_permissions'=>'show_major']);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'MajorController@store','user_permissions'=>'add_major']);
  Route::get('/{id}/edit/{lang}',['uses'=>'MajorController@edit','user_permissions'=>'edit_major']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'MajorController@update','user_permissions'=>'edit_major']);
  Route::get('index/{id}/{lang}',['uses'=>'MajorController@destroy','user_permissions'=>'delete_major']);
  Route::get('/search/{lang}',['uses'=>'MajorController@search','user_permissions'=>'manage_major']);

});


Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'templates'],function () {
  Route::get('/{lang}',['uses'=>'TemplatesController@index','user_permissions'=>'manage_template']);
  Route::get('/{id}/edit/{lang}',['uses'=>'TemplatesController@edit','user_permissions'=>'edit_template']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'TemplatesController@update','user_permissions'=>'edit_template']);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'customer'],function () {

  Route::get('/{lang}',['uses'=>'CustomerController@index','user_permissions'=>'manage_customer']);
  Route::get('create/{lang}',['uses'=>'CustomerController@create','user_permissions'=>'add_customer']);
  Route::get('/{id}/show/{lang}','CustomerController@show');
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'CustomerController@store','user_permissions'=>'add_customer']);
  Route::get('/{id}/edit/{lang}',['uses'=>'CustomerController@edit','user_permissions'=>'edit_customer']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'CustomerController@update','user_permissions'=>'edit_customer']);
  Route::get('index/{id}/{lang}',['uses'=>'CustomerController@destroy','user_permissions'=>'delete_customer']);
  Route::get('/search/{lang}',['uses'=>'CustomerController@search','user_permissions'=>'manage_customer']);
  Route::get('/address/{id}/{lang}',['uses'=>'CustomerController@get_address','user_permissions'=>'manage_customer']);
});

Route::prefix('tax')->group(function () {

  Route::get('/{lang}','TaxController@index');
  Route::get('create/{lang}','TaxController@create');
  Route::get('/{id}/show/{lang}','TaxController@show');
  Route::post('/store/{lang}','TaxController@store');
  Route::get('/{id}/edit/{lang}','TaxController@edit');
  Route::post('/{id}/{lang}','TaxController@update');
  Route::get('index/{id}/{lang}','TaxController@destroy');

});


Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'invoice'],function () {

  Route::get('/{lang}',['uses'=>'InvoiceController@index','user_permissions'=>'customer_invoices']);
  Route::get('create/{c}/{type}/{lang}',['uses'=>'InvoiceController@create','user_permissions'=>'add_invoices']);
  Route::get('/{id}/show/{lang}',['uses'=>'InvoiceController@show','user_permissions'=>['manage_invoices','customer_invoices']]);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'InvoiceController@store','user_permissions'=>'add_invoices']);
  Route::get('/{id}/edit/{lang}',['uses'=>'InvoiceController@edit','user_permissions'=>'edit_invoices']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'InvoiceController@update','user_permissions'=>'edit_invoices']);
  Route::get('index/{id}/{lang}',['uses'=>'InvoiceController@destroy','user_permissions'=>'delete_invoices']);
  Route::get('customer/{id}/{lang}',['uses'=>'InvoiceController@customer','user_permissions'=>'invoices_rel_customers']);
  Route::get('/search/{lang}',['uses'=>'InvoiceController@search','user_permissions'=>['manage_invoices','customer_invoices']]);
  Route::get('/all/{lang}',['uses'=>'InvoiceController@all','user_permissions'=>'manage_invoices']);
  Route::get('/items/{id}/{lang}',['uses'=>'InvoiceController@invoices_items','user_permissions'=>['add_invoices','edit_invoices']]);
  Route::post('/items/store/{lang}',['before' => 'csrf','uses'=>'InvoiceController@store_invoice_items','user_permissions'=>['add_invoices','edit_invoices']]);
  Route::get('/change/status/{id}/{ptype}/{lang}',['uses'=>'InvoiceController@update_status','user_permissions'=>'up_invoice_status']);
  Route::get('/template/{id}/{t_type}/{lang}',['uses'=>'InvoiceController@getTemplateData','user_permissions'=>['manage_invoices','customer_invoices']]);
  Route::post('/email/send/{lang}',['before' => 'csrf','uses'=>'InvoiceController@sendInvoice','user_permissions'=>'send_inv_email']);
});


Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'quote'],function () {

  Route::get('/{lang}',['uses'=>'QuoteController@index','user_permissions'=>'customer_quote']);
  Route::get('create/{lang}',['uses'=>'QuoteController@create','user_permissions'=>'add_quote']);
  Route::get('/{id}/show/{lang}','QuoteController@show');
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'QuoteController@store','user_permissions'=>'add_quote']);
  Route::get('/{id}/edit/{lang}',['uses'=>'QuoteController@edit','user_permissions'=>'edit_quote']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'QuoteController@update','user_permissions'=>'edit_quote']);
  Route::get('index/{id}/{lang}',['uses'=>'QuoteController@destroy','user_permissions'=>'delete_quote']);
  Route::get('customer/{id}/{lang}',['uses'=>'QuoteController@customer','user_permissions'=>'cu_under_quote']);
  Route::get('/search/{lang}',['uses'=>'QuoteController@search','user_permissions'=>['customer_quote','manage_quote']]);
  Route::get('/all/{lang}',['uses'=>'QuoteController@all','user_permissions'=>'manage_quote']);
  Route::get('/items/{id}/{lang}',['uses'=>'QuoteController@quotes_items','user_permissions'=>['add_quote','edit_quote']]);
  Route::post('/items/store/{lang}',['before' => 'csrf','uses'=>'QuoteController@store_quote_items','user_permissions'=>['add_quote','edit_quote']]);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'expense'],function () {

  Route::get('/{lang}',['uses'=>'ExpenseTypeController@index','user_permissions'=>'manage_expense_type']);
  Route::get('create/{where_from}/{lang}',['uses'=>'ExpenseTypeController@create','user_permissions'=>'add_expense_type']);
  Route::get('/{id}/show/{lang}','ExpenseTypeController@show');
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'ExpenseTypeController@store','user_permissions'=>'add_expense_type']);
  Route::get('/{id}/edit/{lang}',['uses'=>'ExpenseTypeController@edit','user_permissions'=>'edit_expense_type']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'ExpenseTypeController@update','user_permissions'=>'edit_expense_type']);
  Route::get('index/{id}/{lang}',['uses'=>'ExpenseTypeController@destroy','user_permissions'=>'delete_expense_type']);
  Route::get('/search/{lang}',['uses'=>'ExpenseTypeController@search','user_permissions'=>'manage_expense_type']);

});

Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'employeemajor'],function () {

  Route::get('/{emp_id}/{lang}',['uses'=>'salaryController@index','user_permissions'=>'manage_salary']);
  Route::get('create/{where_from}/{emp_id}/{lang}',['uses'=>'salaryController@create','user_permissions'=>'add_salary']);
  Route::get('/{id}/show/{lang}','salaryController@show');
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'salaryController@store','user_permissions'=>'add_salary']);
  Route::get('/{id}/edit/{emp_id}/{lang}',['uses'=>'salaryController@edit','user_permissions'=>'edit_salary']);
  Route::get('/{id}/editcode/{emp_id}/{lang}',['uses'=>'salaryController@editcode','user_permissions'=>'edit_salary']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'salaryController@update','user_permissions'=>'edit_salary']);
  Route::post('/updatecode/{id}/{lang}',['before' => 'csrf','uses'=>'salaryController@updatecode','user_permissions'=>'edit_salary']);
  Route::get('index/{id}/{lang}',['uses'=>'salaryController@destroy','user_permissions'=>'delete_salary']);
  Route::get('/search/{lang}',['uses'=>'salaryController@search','user_permissions'=>'manage_salary']);
});


Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'extrasalary'],function () {

  Route::get('{emp_id}/{lang}',['uses'=>'ExtraSalaryController@index','user_permissions'=>'manage_extra_salary']);
  Route::get('/create/{emp_id}/{lang}',['uses'=>'ExtraSalaryController@create','user_permissions'=>'add_extra_salary']);
  Route::get('/{id}/show/{lang}','ExtraSalaryController@show');
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'ExtraSalaryController@store','user_permissions'=>'add_extra_salary']);
  Route::get('/{id}/edit/{lang}',['uses'=>'ExtraSalaryController@edit','user_permissions'=>'edit_extra_salary']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'ExtraSalaryController@update','user_permissions'=>'edit_extra_salary']);
  Route::get('index/{id}/{lang}',['uses'=>'ExtraSalaryController@destroy','user_permissions'=>'delete_extra_salary']);
  Route::get('/search/all/{lang}',['uses'=>'ExtraSalaryController@search','user_permissions'=>'manage_extra_salary']);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'bouns'],function () {

  Route::get('{emp_id}/{lang}',['uses'=>'BounsController@index','user_permissions'=>'manage_bouns']);
  Route::get('/create/{emp_id}/{lang}',['uses'=>'BounsController@create','user_permissions'=>'add_bouns']);
  Route::get('/{id}/show/{lang}','BounsController@show');
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'BounsController@store','user_permissions'=>'add_bouns']);
  Route::get('/{id}/edit/{lang}',['uses'=>'BounsController@edit','user_permissions'=>'edit_bouns']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'BounsController@update','user_permissions'=>'edit_bouns']);
  Route::get('index/{id}/{lang}',['uses'=>'BounsController@destroy','user_permissions'=>'delete_bouns']);
  Route::get('/search/all/{lang}',['uses'=>'BounsController@search','user_permissions'=>'manage_bouns']);
});

Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'discount'],function () {

  Route::get('{emp_id}/{lang}',['uses'=>'DiscountController@index','user_permissions'=>'manage_discount']);
  Route::get('/create/{emp_id}/{lang}',['uses'=>'DiscountController@create','user_permissions'=>'add_discount']);
  Route::get('/{id}/show/{lang}','DiscountController@show');
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'DiscountController@store','user_permissions'=>'add_discount']);
  Route::get('/{id}/edit/{lang}',['uses'=>'DiscountController@edit','user_permissions'=>'edit_discount']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'DiscountController@update','user_permissions'=>'edit_discount']);
  Route::get('index/{id}/{lang}',['uses'=>'DiscountController@destroy','user_permissions'=>'delete_discount']);
  Route::get('/search/all/{lang}',['uses'=>'DiscountController@search','user_permissions'=>'manage_discount']);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'user'],function () {

  Route::get('/{lang}',['uses'=>'UserController@index','user_permissions'=>'manage_user']);
  Route::get('/{id}/show/{lang}','UserController@show');
  Route::get('/{id}/edit/{lang}',['uses'=>'UserController@edit','user_permissions'=>'edit_user']);
  Route::post('/{id}/{lang}',['before' => 'csrf','uses'=>'UserController@update','user_permissions'=>'edit_user']);
  Route::get('index/{id}/{lang}',['uses'=>'UserController@destroy','user_permissions'=>'delete_user']);
  Route::get('/search/{lang}',['uses'=>'UserController@search','user_permissions'=>'manage_user']);
  Route::get('/roles/{id}/{lang}',['uses'=>'UserController@user_roles','user_permissions'=>'manage_user_roles']);
  Route::post('/roles/store/{lang}',['before' => 'csrf','uses'=>'UserController@user_role_store','user_permissions'=>'manage_user_roles']);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'transactions'],function () {
  Route::get('/{trans_type}/{lang}',['uses'=>'TransactionController@index','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);
  Route::get('index/{id}/{lang}',['uses'=>'TransactionController@destroy','user_permissions'=>['delete_transfer','delete_expense','delete_income']]);
  Route::get('/create/{trans_type}/{lang}',['uses'=>'TransactionController@create','user_permissions'=>['add_transfer','add_expense','add_income']]);
  Route::post('/store/{lang}',['before' => 'csrf','uses'=>'TransactionController@store','user_permissions'=>['add_transfer','add_expense','add_income']]);
  Route::get('/all/filter/search/{lang}',['uses'=>'TransactionController@search','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);
  Route::get('/show/balancesheet/{lang}',['uses'=>'TransactionController@balance','user_permissions'=>'view_balance_sheet']);
  Route::get('/{id}/balanceDetails/{lang}',['uses'=>'TransactionController@balanceTransactionDetails','user_permissions'=>'view_balance_sheet_details']);
  Route::get('/show/invoices/{lang}',['uses'=>'TransactionController@invoices','user_permissions'=>'view_payments']);
  Route::get('/{id}/invoicesDetails/{lang}',['uses'=>'TransactionController@invoicesDetails','user_permissions'=>'view_payments_details']);
  Route::get('/income/{id}/{lang}',['uses'=>'TransactionController@invoices_income','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);
  Route::get('/salary/{id}/{lang}',['uses'=>'TransactionController@employee_transactions','user_permissions'=>['manage_employee']]);
  Route::get('filter/employee_filter/{lang}',['uses'=>'TransactionController@employee_search','user_permissions'=>['manage_employee']]);
  Route::get('print/{id}/{ty}/{lang}',['uses'=>'TransactionController@print_transaction','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);
  Route::get('sendmail/{id}/{ty}/{lang}',['uses'=>'TransactionController@sendTransaction','user_permissions'=>['manage_income','manage_expense','manage_transfer']]);
  Route::get('employee/salary/{id}/{lang}',['uses'=>'TransactionController@employee_salaries_pay_step1','user_permissions'=>['manage_expense']]);
  Route::get('employee/salary/{lang}',['uses'=>'TransactionController@employee_salaries_pay','user_permissions'=>['manage_expense']]);
});

Route::group(['middleware' => ['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'reports'],function () {
  Route::get('/transaction/{trans_type}/{lang}',['uses'=>'ReportController@transaction','user_permissions'=>['income_report','expense_report']]);
  Route::get('/transaction/filter/{trans_type}/{lang}',['uses'=>'ReportController@filterTransactionByDate','user_permissions'=>['expense_income_by_date','expense_income_by_date_range']]);
  Route::get('/search/{lang}',['uses'=>'ReportController@search','user_permissions'=>['income_report','expense_report','expense_income_by_date','expense_income_by_date_range']]);
  Route::get('/invoices/{lang}',['uses'=>'ReportController@invoices','user_permissions'=>'invoice_report']);
  Route::get('/invoicesearch/{lang}',['uses'=>'ReportController@invoiceSearch','user_permissions'=>'invoice_report']);
  Route::get('/expenses/category/{lang}',['uses'=>'ReportController@category','user_permissions'=>['income_report','expense_report']]);
  Route::get('/category/search/{lang}',['uses'=>'ReportController@categorysearch','user_permissions'=>['income_report','expense_report']]);
  Route::get('/salary/{lang}',['uses'=>'ReportController@employee_salary','user_permissions'=>['salary_report']]);
  Route::get('/employee/income/{lang}',['uses'=>'ReportController@employee_income','user_permissions'=>['employee_income']]);
  Route::get('/employee/income/search/{lang}',['uses'=>'ReportController@employee_income_search','user_permissions'=>['employee_income']]);

});


Route::group(['middleware' =>['chuserrole','language','checkbranches','XSSCheck'],'before' => 'auth.basic','prefix'=>'roles'],function () {
  Route::get('/createpermission/{lang}','RoleController@createpermission');
  Route::post('/storepermission/{lang}','RoleController@storepermission');

  Route::get('/{lang}',['uses'=>'RoleController@index','user_permissions'=>'manage_roles']);
  Route::get('create/{lang}',['uses'=>'RoleController@create','user_permissions'=>'add_role']);
  Route::get('/{id}/show/{lang}','RoleController@show');
  Route::post('/store/{lang}',['uses'=>'RoleController@store','user_permissions'=>'add_role']);
  Route::get('/{id}/edit/{lang}',['uses'=>'RoleController@edit','user_permissions'=>'edit_role']);
  Route::post('/{id}/{lang}',['uses'=>'RoleController@update','user_permissions'=>'edit_role']);
  Route::get('index/{id}/{lang}',['uses'=>'RoleController@destroy','user_permissions'=>'delete_role']);
  Route::get('/user/{id}/{lang}',['uses'=>'RoleController@user_roles','user_permissions'=>'user_under_role']);
  Route::get('/permissions/{id}/{lang}',['uses'=>'RoleController@permissions','user_permissions'=>'add_permisions']);
  Route::post('/permissions/store/{lang}',['uses'=>'RoleController@store_permissions','user_permissions'=>'add_permisions']);
});

Auth::routes();
Route::get('/dashboard', 'HomeController@index')->name('home')->middleware(["language","checkbranches"]);
Route::get('/settings/{id}/edit/{lang}', 'HomeController@getSetting')->middleware(["language","checkbranches"]);
Route::post('/settings/{id}/{lang}','HomeController@update_setting')->middleware(["language","checkbranches",'XSSCheck']);

Route::get('/currency/{lang}', 'CurrencySettingsController@index')->middleware(["language","checkbranches"]);
Route::get('/currency/{id}/edit/{lang}', 'CurrencySettingsController@edit')->middleware(["language","checkbranches",'XSSCheck']);
Route::post('/currency/{id}/{lang}', 'CurrencySettingsController@update')->middleware(["language","checkbranches",'XSSCheck']);
Route::get('nopermission','HomeController@nopermission');
