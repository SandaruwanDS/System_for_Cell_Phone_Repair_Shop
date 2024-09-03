<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Company;
use App\Models\BankDetails;
use App\Models\BankBranch;
use App\Models\Technician;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BankDeltailsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Account_typeController;
use App\Http\Controllers\AccountCategoryController;


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

Route::get('/', function () {
    $data = Company::all();
    return view('welcome')
    ->with("Company",$data);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/view_users', [App\Http\Controllers\UserController::class, 'viewUsers'])->name('view_users');
Route::get('/delete_user/{id}', [App\Http\Controllers\UserController::class, 'deleteUsers'])->name('delete_user');
Route::get('/edit_user/{id}', [App\Http\Controllers\UserController::class, 'editUsers'])->name('edit_user');

// dashboard routes
Route::get('/users', [App\Http\Controllers\DashboardController::class, 'showUsers'])->name('users');

Route::get('/add_user', [App\Http\Controllers\UserController::class, 'showAddUser'])->name('add_user');
Route::post('/register_user', [App\Http\Controllers\UserController::class, 'AddUser'])->name('register_user');
Route::get('/roles', [App\Http\Controllers\UserController::class, 'showRoles'])->name('roles');

// Route::get('/suppliers', [App\Http\Controllers\SupplierController::class, 'showSuppliers'])->name('suppliers');
// Route::get('/add_supplier', [App\Http\Controllers\SupplierController::class, 'showAddSuppliers'])->name('add_supplier');

// Route::get('/pawning', [App\Http\Controllers\PawnController::class, 'showPawnReceipt'])->name('pawning');
// Route::get('/pawning_redeem', [App\Http\Controllers\PawnController::class, 'showRedeemReceipt'])->name('pawning_redeem');
// Route::post('/storePawn', [App\Http\Controllers\PawnController::class, 'storePawn'])->name('storePawn');
// search_receipt_ajax
// Route::get('/search_receipt_ajax', [App\Http\Controllers\PawnController::class, 'search'])->name('search_receipt_ajax');




// Route::get('/stock_OP', [App\Http\Controllers\TransactionsController::class, 'indexOP'])->name('stock_OP');
// Route::get('/stock_adjustment', [App\Http\Controllers\TransactionsController::class, 'indexStockAdjustment'])->name('stock_adjustment');
// Route::get('/stock_damage', [App\Http\Controllers\TransactionsController::class, 'indexStockDamage'])->name('stock_damage');


// Route::get('/transactions_GRN', [App\Http\Controllers\TransactionsController::class, 'indexGRN'])->name('transactions_GRN');


// Route::get('/products_add', [App\Http\Controllers\ProductsController::class, 'indexAddProducts'])->name('products_add');

// Route::get('/sales_add', [App\Http\Controllers\SalesController::class, 'indexAddSales'])->name('sales_add');


//Add Customer Route
Route::post('/addCustomer', [App\Http\Controllers\CustomerController::class, 'addCustomer'])->name('addCustomer');
//Edit View Customer Route
Route::get('/master_edit_customers/{id}', [App\Http\Controllers\CustomerController::class, 'indexEdit'])->name('master_edit_customers');
// Show Customers view
Route::get('/master_customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('master_customers');
//Get Customer by Code
Route::post('/getCustomer', [App\Http\Controllers\CustomerController::class, 'getByID'])->name('getCustomer');
//Update Customer by Code
Route::post('/update_customer/{id}', [App\Http\Controllers\CustomerController::class, 'updateCustomer'])->name('update_customer');
//delte customer
Route::get('/delete_customer/{id}', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('delete_customer');

//Add customer ajex
Route::post('/add_customer_ajax', [App\Http\Controllers\CustomerController::class, 'create'])->name('add_customer_ajax');
//delete customer ajex
Route::post('/delete_customer_ajax', [App\Http\Controllers\CustomerController::class, 'delete'])->name('delete_customer_ajax');
//update customer ajex
Route::post('/update_customer_ajax', [App\Http\Controllers\CustomerController::class, 'update'])->name('update_customer_ajax');
//pagination branch ajax
Route::get('/customer_pagination', [App\Http\Controllers\CustomerController::class, 'pagination']);
//search customer ajax
Route::get('/search_customer_ajax', [App\Http\Controllers\CustomerController::class, 'search'])->name('search_customer_ajax');
//get customer ajax
Route::get('/get_customer_ajax', [App\Http\Controllers\CustomerController::class, 'get'])->name('get_customer_ajax');


// Technician
Route::get('/Technician', [App\Http\Controllers\TechnicianController::class, 'index'])->name('Technician');
//Add Technician ajex
Route::post('/add_Technician_ajax', [App\Http\Controllers\TechnicianController::class, 'create'])->name('add_Technician_ajax');
//delete Technician ajex
Route::post('/delete_Technician_ajax', [App\Http\Controllers\TechnicianController::class, 'delete'])->name('delete_Technician_ajax');
//update Technician ajex
Route::post('/update_Technician_ajax', [App\Http\Controllers\TechnicianController::class, 'update'])->name('update_Technician_ajax');
//search Technician ajax
Route::get('/search_Technician_ajax', [App\Http\Controllers\TechnicianController::class, 'search'])->name('search_Technician_ajax');



// Suppliers
Route::get('/Suppliers', [App\Http\Controllers\SuppliersController::class, 'index'])->name('Suppliers');
//Add Suppliers ajex
Route::post('/add_Suppliers_ajax', [App\Http\Controllers\SuppliersController::class, 'create'])->name('add_Suppliers_ajax');
//delete Suppliers ajex
Route::post('/delete_Suppliers_ajax', [App\Http\Controllers\SuppliersController::class, 'delete'])->name('delete_Suppliers_ajax');
//update Suppliers ajex
Route::post('/update_Suppliers_ajax', [App\Http\Controllers\SuppliersController::class, 'update'])->name('update_Suppliers_ajax');
//search Suppliers ajax
Route::get('/search_Suppliers_ajax', [App\Http\Controllers\SuppliersController::class, 'search'])->name('search_Suppliers_ajax');


//search Customer by Code

// Route::post('/searchCustomer', [App\Http\Controllers\CustomerController::class, 'search'])->name('searchCustomer');
// Route::post('/action', [App\Http\Controllers\CustomerController::class, 'action'])->name('action');
// //Show receipts View
// Route::get('/master_receipt', [App\Http\Controllers\receiptController ::class, 'index'])->name('master_receipt');
// //Add receipts Route
// Route::post('/add_receipt', [App\Http\Controllers\receiptController::class, 'add_receipt'])->name('add_receipt');
// //delete receipts
// Route::get('/delete_receipt/{id}', [App\Http\Controllers\receiptController::class, 'destroy'])->name('delete_receipt');

// Route::get('/pawning_forfeit_receipt', [App\Http\Controllers\receiptController ::class, 'index_forfeit_receipt'])->name('pawning_forfeit_receipt');

//Add receipts ajax
// Route::post('/add_receipt_ajax', [App\Http\Controllers\ReceiptController::class, 'create'])->name('add_receipt_ajax');
// //delete receipts ajax
// Route::post('/delete_receipt_ajax', [App\Http\Controllers\ReceiptController::class, 'delete'])->name('delete_receipt_ajax');
// //update receipt ajax
// Route::post('/update_receipt_ajax', [App\Http\Controllers\ReceiptController::class, 'update'])->name('update_receipt_ajax');



//show branch details
Route::get('master_branchdetails', [App\Http\Controllers\branchdetailsController ::class, 'index'])->name('branchdetails');
//add branch
Route::post('/add_branchdetails', [App\Http\Controllers\branchdetailsController::class, 'add_branch'])->name('add_branch');
//delete branch
Route::get('/delete_branch/{id}', [App\Http\Controllers\branchdetailsController::class, 'destroy'])->name('delete_branch');


//add branch ajax
Route::post('/addBranchdetails', [App\Http\Controllers\branchdetailsController::class, 'create'])->name('add_branch_ajax');
//update branch ajax
Route::post('/updateBranchdetails', [App\Http\Controllers\branchdetailsController::class, 'update'])->name('update_branch_ajax');
//delete branch ajax
Route::post('/deleteBranchdetails', [App\Http\Controllers\branchdetailsController::class, 'delete'])->name('delete_branch_ajax');
//search branch ajax
Route::get('/searchBranchdetails', [App\Http\Controllers\branchdetailsController::class, 'search'])->name('search_branch_ajax');
//pagination branch ajax
Route::get('/branch_pagination', [App\Http\Controllers\branchdetailsController::class, 'pagination']);


// //show karatage
// Route::get('master_karatage', [App\Http\Controllers\KaratagerateController::class, 'index'])->name('karatage');
// //add karatage
// Route::post('/add_karatage', [App\Http\Controllers\KaratagerateController::class, 'add_karatage'])->name('add_karatage');
// //delete karatage
// Route::get('/delete_karatage/{id}', [App\Http\Controllers\KaratagerateController::class, 'destroy'])->name('delete_karatage');
// //add karatage ajax
// Route::post('/add_karatage_ajax', [App\Http\Controllers\KaratagerateController::class, 'create'])->name('add_karatage_ajax');
// //delete karatage ajax
// Route::post('/delete_karatage_ajax', [App\Http\Controllers\KaratagerateController::class, 'delete'])->name('delete_karatage_ajax');
// //update karatage ajax
// Route::post('/update_karatage_ajax', [App\Http\Controllers\KaratagerateController::class, 'update'])->name('update_karatage_ajax');

//show item condition
// Route::get('master_item_condition', [App\Http\Controllers\CategoryController ::class, 'index'])->name('master_item_condition');
// Route::post('/add_itemcondition', [App\Http\Controllers\CategoryController::class, 'add_Category'])->name('add_itemcondition');
// Route::post('/add_itemcondition_ajax', [App\Http\Controllers\CategoryController::class, 'create'])->name('add_itemcondition_ajax');
// Route::post('/update_condition_ajax', [App\Http\Controllers\CategoryController::class, 'update'])->name('update_condition_ajax');



// show item condition
Route::get('master_item_condition', [App\Http\Controllers\itemConditionController ::class, 'index'])->name('master_item_condition');
// add item condition
Route::post('/add_itemcondition', [App\Http\Controllers\itemConditionController::class, 'add_itemcondition'])->name('add_itemcondition');
// delete item Condition
Route::get('/delete_itemcondition/{id}', [App\Http\Controllers\itemConditionController::class, 'destroy'])->name('delete_itemcondition');
// add item condition ajax
Route::post('/add_itemcondition_ajax', [App\Http\Controllers\itemConditionController::class, 'create'])->name('add_itemcondition_ajax');
// update item condition ajax
Route::post('/update_condition_ajax', [App\Http\Controllers\itemConditionController::class, 'update'])->name('update_condition_ajax');



// delete branch
Route::post('/delete_condition_ajax', [App\Http\Controllers\itemConditionController::class, 'delete'])->name('delete_condition_ajax');



// Item setup
Route::get('/master_item_setup', [App\Http\Controllers\itemSetupController::class, 'index'])->name('master_item_setup');
//add item ajax
Route::post('/add_item_ajax', [App\Http\Controllers\itemSetupController::class, 'create'])->name('add_item_ajax');
//delete item ajax
Route::post('/delete_item_ajax', [App\Http\Controllers\itemSetupController::class, 'delete'])->name('delete_item_ajax');
//update item ajax
Route::post('/update_item_ajax', [App\Http\Controllers\itemSetupController::class, 'update'])->name('update_item_ajax');

// Company
Route::get('/Company', [App\Http\Controllers\CompanyController::class, 'index'])->name('Company');
Route::post('Companystore', [CompanyController::class, 'Companystore']);
Route::post('Companyedit', [CompanyController::class, 'Companyedit']);
Route::post('Companydelete', [CompanyController::class, 'Companydestroy']);

//Category
Route::get('Category', [CategoryController::class, 'index'])->name('Category');
Route::post('store', [CategoryController::class, 'store']);
Route::post('edit', [CategoryController::class, 'edit']);
Route::post('delete', [CategoryController::class, 'destroy']);

//Item
Route::get('Item', [ItemController::class, 'index'])->name('Item');
Route::post('mainstore', [ItemController::class, 'mainstore']);
Route::post('mainedit', [ItemController::class, 'mainedit']);
Route::post('maindelete', [ItemController::class, 'maindestroy']);

//get customer ajax
Route::get('/get_Item_ajax', [App\Http\Controllers\ItemController::class, 'get'])->name('get_Item_ajax');



// Show job Sheet page
Route::get('/repair_jobsheet', [App\Http\Controllers\JobSheetsController::class, 'index'])->name('repair_jobsheet');
// create_jobsheet
Route::post('/create_jobsheet', [App\Http\Controllers\JobSheetsController::class, 'store'])->name('create_jobsheet');
// show all jobs
Route::get('/repair_jobs', [App\Http\Controllers\AllJobsController::class, 'index'])->name('repair_jobs');
// delete jobs ajax
Route::post('/delete_jobs_ajax', [App\Http\Controllers\AllJobsController::class, 'destroy'])->name('delete_jobs_ajax');
//update job ajex
Route::post('/update_job_ajax', [App\Http\Controllers\AllJobsController::class, 'update'])->name('update_job_ajax');
// print jobs
Route::get('/print_jobs_ajax', [App\Http\Controllers\AllJobsController::class, 'print'])->name('print_jobs_ajax');

//pagination branch ajax
Route::get('/jobs_pagination', [App\Http\Controllers\AllJobsController::class, 'pagination']);
//search jobs ajax
Route::get('/search_jobs_ajax', [App\Http\Controllers\AllJobsController::class, 'search'])->name('search_jobs_ajax');


// Show rapair page
Route::get('/repair', [App\Http\Controllers\RepairController::class, 'index'])->name('repair');


// Show repair invoice page
Route::get('/sales_invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->name('sales_invoice');
// add_invoice
Route::post('/add_invoice', [App\Http\Controllers\InvoiceController::class, 'createInvoice'])->name('add_invoice');

//get job ajax
Route::get('/get_job_ajax', [App\Http\Controllers\InvoiceController::class, 'get'])->name('get_job_ajax');
// add_invoice_ajax
Route::post('/add_invoice_ajax', [App\Http\Controllers\InvoiceController::class, 'create'])->name('add_invoice_ajax');
// delete_invoice_ajax
Route::post('/delete_invoice_ajax', [App\Http\Controllers\InvoiceController::class, 'destroy'])->name('delete_invoice_ajax');
// index for sales_create_invoice
Route::get('/sales_create_invoice', [App\Http\Controllers\InvoiceController::class, 'indexInvoice'])->name('sales_create_invoice');
// show_select_category_item_ajax
Route::get('/show_select_category_item_ajax', [App\Http\Controllers\InvoiceController::class, 'setItemsCode'])->name('show_select_category_item_ajax');
// show_select_item_description_ajax
Route::get('/show_select_item_description_ajax', [App\Http\Controllers\InvoiceController::class, 'setItemDescription'])->name('show_select_item_description_ajax');


//show opening stock
Route::get('/stock_open', [App\Http\Controllers\OpeningStockController::class, 'index'])->name('stock_open');
// add_opening_stock
Route::post('/add_opening_stock', [App\Http\Controllers\OpeningStockController::class, 'create'])->name('add_opening_stock');
// show_select_category_item_ajax
Route::get('/show_select_category_item_open_stock_ajax', [App\Http\Controllers\OpeningStockController::class, 'setItemsCode'])->name('show_select_category_item_open_stock_ajax');
// show_select_item_description_ajax
Route::get('/show_select_item_description_open_stock_ajax', [App\Http\Controllers\OpeningStockController::class, 'setItemDescription'])->name('show_select_item_description_open_stock_ajax');

//show stock items
Route::get('/stock_items', [App\Http\Controllers\StockItemsController::class, 'index'])->name('stock_items');


// Show repair invoice page
Route::get('/purchases_invoice', [App\Http\Controllers\PurchasesController::class, 'index'])->name('purchases_invoice');
// add_purchases
Route::post('/add_purchases', [App\Http\Controllers\PurchasesController::class, 'create'])->name('add_purchases');


//Reports
Route::get('/sales_report', [App\Http\Controllers\SalereportController::class, 'index'])->name('sales_report');
//daily report
Route::get('/daily_report', [App\Http\Controllers\DailyreportController::class,'index'])->name('daily_report');
//pending report
Route::get('/Pending_report', [App\Http\Controllers\PendingreportController::class, 'index'])->name('Pending_report');
//Completereport
Route::get('/Completereport', [App\Http\Controllers\CompletereportController::class, 'index'])->name('Completereport');



//checking external job status
Route::get('/repairstatus', [App\Http\Controllers\JobStatusCheckingController::class, 'index'])->name('Track_job_status');
// get_job_status_ajax
Route::get('/get_job_status_ajax', [App\Http\Controllers\JobStatusCheckingController::class, 'get'])->name('get_job_status_ajax');

// get stock report
Route::get('/stock_report', [App\Http\Controllers\StockReportController::class, 'index'])->name('stock_report');
//filter_stock_by_date
Route::get('/filter_stock_by_date', [App\Http\Controllers\StockReportController::class, 'filter'])->name('filter_stock_by_date');

// report_by_technician
Route::get('/report_by_technician', [App\Http\Controllers\TechnicianReportController::class, 'index'])->name('report_by_technician');

// report_by_technician_profit
Route::get('/report_by_technician_profit', [App\Http\Controllers\TechnicianProfitReportController::class, 'index'])->name('report_by_technician_profit');


// rejected_job_report
Route::get('/rejected_job_report', [App\Http\Controllers\RejectedJobsReportController::class, 'index'])->name('rejected_job_report');

//StockTransfer
Route::get('/stock_transfer', [App\Http\Controllers\StockTransferController::class, 'index'])->name('stock_transfer');
// add_stock Transfer
Route::post('/add_stocktransfer', [App\Http\Controllers\StockTransferController::class, 'createStockTransfer'])->name('add_stocktransfer');
//get Branch ajax
Route::get('/get_Branch_ajax', [App\Http\Controllers\StockTransferController::class, 'getBranch'])->name('get_Branch_ajax');
