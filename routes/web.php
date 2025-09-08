<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleExportController;
use App\Http\Controllers\ModuleImportController;
use App\Http\Controllers\ProductflagController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\SidebarController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\SummaryboxesController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\StitchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderstatusController;
use App\Http\Controllers\ProducttagsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;

# Frontend Controller
use App\Http\Controllers\Frontend\UserAuthController;
use App\Http\Controllers\Frontend\ForgotPasswordController;
use App\Http\Controllers\Frontend\ResetPasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FrontBlogController;
use App\Http\Controllers\Frontend\FrontShopController;
use App\Http\Controllers\Frontend\FrontProductController;
use App\Livewire\ProductList;

#===================================================================================================================
#===================================================================================================================
#Frontend Website Routes


Route::prefix('user')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLoginForm'])->name('frontend.login.form');
    Route::post('/login', [UserAuthController::class, 'login'])->name('frontend.login');

    Route::get('/register', [UserAuthController::class, 'showRegisterForm'])->name('frontend.register.form');
    Route::post('/register', [UserAuthController::class, 'register'])->name('frontend.register');

    Route::post('/logout', [UserAuthController::class, 'logout'])->name('frontend.logout');

    // password reset routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'allCategories'])->name('frontend.categories');
Route::get('/category/{slug}', [HomeController::class, 'categoryProducts'])->name('frontend.category');

Route::get('/blog', [FrontBlogController::class, 'index'])->name('blog');


Route::get('/shop', [FrontShopController::class, 'index'])->name('shop');

// Route::get('/shop/{categorieslug}', ProductList::class)->name('frontend.shop.category');

Route::get('/quick-view/{id}', [FrontShopController::class, 'quickView'])->name('quick.view');


Route::get('/product/{product_slug}', [FrontProductController::class, 'show'])->name('product.details');

Route::get('/frontproduct', function () {
    return view('frontend.product');
})->name('product');


Route::get('/wishlist', function () {
    return view('frontend.wishlist'); 
})->name('wishlist');

Route::get('/cart', function () {
    return view('frontend.cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('frontend.checkout');
})->name('checkout');

Route::get('/about-us', function () {
    return view('frontend.about-us');
})->name('about-us');

 

Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');

Route::get('/ourstore', function () {
    return view('frontend.ourstore');
})->name('ourstore');

Route::get('/timeline', function () {
    return view('frontend.timeline');
})->name('timeline');


#===================================================================================================================    
#===================================================================================================================




#===================================================================================================================
#===================================================================================================================
#Start Theme Routes
Route::get('/css/custom.css', function () {
    $designSettings = getDesignSettings();

    $css = ":root {
        --topbar-header-bg: " . ($designSettings['site_topbar_header_background_color'] ?? '#1f62ff') . ";
        --topbar-header-color: " . ($designSettings['site_topbar_header_color'] ?? '#ffffff') . ";
        --page-title-bg: " . ($designSettings['site_page_title_background_color'] ?? '#ffffff') . ";
        --page-title-color: " . ($designSettings['site_page_title_color'] ?? '#000000') . ";
        --sidebar-bg: " . ($designSettings['site_sidebar_background_color'] ?? '#6c0456') . ";
        --sidebar-color: " . ($designSettings['site_sidebar_color'] ?? '#dfe7e3') . ";
        --primary-color: " . ($designSettings['site_primary_color'] ?? '#7367f0') . ";
        }";
    return Response::make($css)->header('Content-Type', 'text/css');
});
#===================================================================================================================
#===================================================================================================================



#===================================================================================================================
#===================================================================================================================
#ADMIN PANEL ROUTES
Route::group(['prefix' => 'admin'], function () {
    #--------------------------------------------------------------------------------------------------------------------
    #login and logout routes
    Route::middleware(['guest:admin'])->group(function () {
        // Main Page Route
        Route::get('/login', [AuthController::class, 'index'])->name('auth-login');

        Route::get('login', [AuthController::class, 'index'])->name('auth-login');

        Route::get('{is_adminLogin?}', [AuthController::class, 'index'])->where(['is_adminLogin' => 'supperadmin'])->name('auth-login');

        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/register', [AuthController::class, 'ShowRegistration'])->name('showuserregister');
        Route::post('/register', [AuthController::class, 'Registration'])->name('userregister');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    #--------------------------------------------------------------------------------------------------------------------

    #=====================================================================================================================================================
#================================================================Dynamic Module Routes================================================================
#=====================================================================================================================================================
#-----------------------------------------------------------------------------------------------------------------------------------------------------
# By Harsh
# Note: Do not make changes to these routes and controllers.
    Route::middleware(['auth:admin', 'role:supperadmin'])->group(function () {
        # Form and edit form
        Route::get('module/form/{slug?}', [ModuleController::class, 'form'])->name("module_form");
        #create Duplicate module
        Route::post('duplicate/module', [ModuleController::class, 'module_duplicate'])->name("module.duplicate");

        # Module Resource Route
        Route::resource('/module', ModuleController::class);
        Route::post('helper/delete-record/module/delete/{id}', [ModuleController::class, 'destroy'])->name('module.delete');
        # module fields delete route
        Route::post('delete/field', [ModuleController::class, 'field_del'])->name('delete.fields');

        # For fetch fields update position
        Route::post('update/sorting', [ModuleController::class, 'update_fields'])->name('update.module_fields');
        Route::post('update/status/table_feilds', [ModuleController::class, 'change_table_status'])->name('update.status_tablefeilds');

        #Update is Filter Feilds Of Module
        Route::post('update/filter_feilds', [ModuleController::class, 'update_filter_feilds'])->name('update.filter_feilds');
        #Update Filter Type Of Feilds
        Route::post('update/filter_type', [ModuleController::class, 'update_filter_type'])->name('update.filter_type');

        #fetch tables name and table column..
        Route::get('get/tables-columns', [ModuleController::class, 'getTablesColumns'])->name('get.tables_columns');

        #=================================================================================================================================================
        #=================================================================================================================================================
        #Start Sidebar Management Route
        Route::group(['prefix' => 'sidebar'], function () {
            Route::get('/', [SidebarController::class, 'index'])->name('sidebar.index');
            Route::post('/store', [SidebarController::class, 'store'])->name('sidebar.store');
            Route::post('/sortData', [SidebarController::class, 'sortData'])->name('sidebar.sortdata');
            Route::post('/update/sortData', [SidebarController::class, 'update_sortData'])->name('sidebar.update_sortdata');

        });
        #END Sidebar Management Route
        #=================================================================================================================================================
        #=================================================================================================================================================

        #=================================================================================================================================================
        #=================================================================================================================================================
        #Start Summary Boxes Management Route

        Route::post('/store/summeryboes', [SummaryboxesController::class, 'store'])->name('boxes.store');
        Route::post('/sort/summeryboes', [SummaryboxesController::class, 'boxes_sort'])->name('boxes.sorting');

        #End Summary Boxes Management Route
        #=================================================================================================================================================
        #=================================================================================================================================================
    });

    Route::middleware(['auth:admin', 'role:supperadmin|admin|staff'])->group(function () {
        #------------------------------------------------------------------------------------------------------------------------------------------
        #Module Field Route
        # For fetch fields of module(table sorting , form sorting , filter feilds , export & import feilds)
        Route::post('show/fields', [ModuleController::class, 'show_fields'])->name('show.module_fields');
        #------------------------------------------------------------------------------------------------------------------------------------------

        #------------------------------------------------------------------------------------------------------------------------------------------
        #Module Data Export Data Route
        Route::get('/export/module-data', [ModuleExportController::class, 'exportData'])->name('export.module_data');
        #------------------------------------------------------------------------------------------------------------------------------------------

        #------------------------------------------------------------------------------------------------------------------------------------------
        #Import Data
        Route::post('/import/module-data', [ModuleImportController::class, 'importData'])->name('import.module_data');
        #------------------------------------------------------------------------------------------------------------------------------------------

        #Dynamic Module Crud
        Route::post("store/module", [ModuleController::class, "store_module"])->name("store_module");
        #destory Data
        Route::post("helper/delete-record/table_data/{tablename}/{id}", [ModuleController::class, "destroy_data"])->name('delete.table_data');

        #bulk action
        Route::post('helper/bulk-action/module/{table_name}', [ModuleController::class, 'bulkAction'])->name('helper.bulkAction');

        # For Delete Image in Dynamic Module Crud

        Route::post("destory/image", [ModuleController::class, "destory_image"])->name("destory_image");

        Route::group(['prefix' => 'm'], function () {
            #Module Datatable route
            Route::get('datatable/{slug}', [ModuleController::class, 'module_DataTable'])->name("show.datatable");
            #--------------------------------------------------------------------------------------------------------------------
            #Route For Open Form in modal and one page form
            Route::post('view/modal_form', [ModuleController::class, 'modal_form'])->name("form.modal_form");
            Route::get('module_form/{slug}/{data_id?}', [ModuleController::class, 'view_onepage_form'])->name('view.module_OnepageForm');
            Route::get('get/onepage_form', [ModuleController::class, 'onepage_form'])->name('form.page_form');
            #--------------------------------------------------------------------------------------------------------------------

            #Image Preview Route
            Route::get('/image/preview', [ModuleController::class, 'img_preview'])->name('modules.img_preview');

            #Single Data View(Details)
            Route::get('/view/module', [ModuleController::class, 'record_view'])->name('view.details');

        });
    });
    #-----------------------------------------------------------------------------------------------------------------------------------------------------
#=====================================================================================================================================================
#===========================================================================END=======================================================================
#=====================================================================================================================================================


    Route::middleware(['auth:admin', 'role:supperadmin|admin|staff'])->group(function () {
        #========================================================================================================================
        #========================================================================================================================
        #Dashboard Route(Also for Summery box Route and Datatable Route)
        Route::get('dashboard', [DashboardController::class, 'dashboardAnalytics'])->name('admin.dashboard');
        Route::get('get-module/{slug}', [DashboardController::class, 'ModuleDashboard'])->name('dashboard.module');
        Route::post('/module/save-order', [DashboardController::class, 'saveOrder'])->name('module.save-order');
        Route::post('/update/module/size', [DashboardController::class, 'updateColumnSize'])->name('update.columnsize');
        #=========================================================================================================================
        #=========================================================================================================================

        #----------------------------------------------------------------------------------------------------------
        #Blogs
        Route::controller(BlogController::class)->group(function () {
            Route::get('blog', 'index')->name('blog.index');
            Route::post('blog/store', 'store')->name('blog.store');
            Route::post("helper/delete-record/blog/{id}", "destroy")->name('delete.blog');
            Route::post('helper/bulk-action/blog', 'bulkAction')->name('helper.bulkAction');
        });
        #----------------------------------------------------------------------------------------------------------

        #----------------------------------------------------------------------------------------------------------
        #Blogs
        Route::controller(OrderController::class)->group(function () {
            Route::get('/order', 'index')->name('order.index');
            Route::get('/order/details/{id}', 'OrderDetails')->name('order.details');
            Route::post('/order/status', 'OrderStatus')->name('order.status');
            Route::get('/order/print/{id}', 'printInvoice')->name('orders.print');
        });
        #----------------------------------------------------------------------------------------------------------

        #------------------------------------------------------------------------------------------------------------
        #Variant Route
        Route::controller(VariantController::class)->group(function () {
            Route::get('variant', 'index')->name('variant.index');
            Route::post('variant/store', 'store')->name('variant.store');
            Route::get('get/variants/columns', 'variant_column')->name('variant.columns');
            Route::get('/variant/{id}/data', 'variant_change')->name('variant_change');
        });
        #------------------------------------------------------------------------------------------------------------
        #------------------------------------------------------------------------------------------------------------
        #stitches Route
        Route::controller(StitchController::class)->group(function () {
            Route::get('stitches', 'index')->name('stitches.index');
            Route::post('stitches/store', 'store')->name('stitches.store');
        });
        #------------------------------------------------------------------------------------------------------------


        #------------------------------------------------------------------------------------------------------------
        #Categories Route
        Route::controller(CategoriesController::class)->group(function () {
            Route::get('categories', 'index')->name('categories.index');
            Route::post('categories/store', 'store')->name('categorie.store');
            Route::post("helper/delete-record/categories/{id}", "destroy")->name('delete.categories');
            Route::post('helper/getRecord/categories/{id}', 'getRecord')->name('getrecord.categories');
            Route::post('helper/bulk-action/categories', 'bulkAction')->name('helper.bulkAction');
            Route::post('/sortData', 'sortData')->name('category.sortdata');
            Route::post('/update/sortData', 'update_sortData')->name('category.update_sortdata');
        });
        #------------------------------------------------------------------------------------------------------------



        #----------------------------------------------------------------------------------------------------------------
        #Product flag
        Route::get('productflag', [ProductflagController::class, 'index'])->name('productflag.index');
        Route::post('productflag/store', [ProductflagController::class, 'store'])->name('productflag.store');
        #----------------------------------------------------------------------------------------------------------------

        #----------------------------------------------------------------------------------------------------------------
        #brand routes
        Route::controller(BrandController::class)->group(function () {
            Route::get('brand', 'index')->name('brand.index');
            Route::post('brand/store', 'store')->name('brand.store');
            Route::post("helper/delete-record/brands/{id}", "destroy")->name('delete.brand');
            Route::post('helper/bulk-action/brands', 'bulkAction')->name('helper.bulkAction');
            Route::post('/brandsortData', 'sortData')->name('brand.sortdata');
            Route::post('/brandupdate/sortData', 'update_sortData')->name('brand.update_sortdata');
        });
        #----------------------------------------------------------------------------------------------------------------

        #----------------------------------------------------------------------------------------------------------------
        #order status routes
        Route::get('orderstatus', [OrderstatusController::class, 'index'])->name('orderstatus.index');
        Route::post('orderstatus/store', [OrderstatusController::class, 'store'])->name('orderstatus.store');
        Route::post('orderstatus/get', [OrderstatusController::class, 'sortData'])->name('orderstatus.sortdata');
        Route::post('orderstatus/update', [OrderstatusController::class, 'update_sortData'])->name('orderstatus.sortdata_update');
        #----------------------------------------------------------------------------------------------------------------

        #----------------------------------------------------------------------------------------------------------------
        #product tags
        Route::controller(ProducttagsController::class)->group(function () {
            Route::get('producttags', 'index')->name('producttags.index');
            Route::post('producttags/store', 'store')->name('producttags.store');
        });
        #----------------------------------------------------------------------------------------------------------

        #----------------------------------------------------------------------------------------------------------
        #Banner
        Route::controller(BannerController::class)->group(function () {
            Route::get('banner', 'index')->name('banner.index');
            Route::post('banner/store', 'store')->name('banner.store');
            Route::post("helper/delete-record/banner/{id}", "destroy")->name('delete.banner');
            Route::post('helper/bulk-action/banner', 'bulkAction')->name('helper.bulkAction');
        });
        #----------------------------------------------------------------------------------------------------------

        #----------------------------------------------------------------------------------------------------------
        #slider
        Route::controller(SliderController::class)->group(function () {
            Route::get('slider', 'index')->name('slider.index');
            Route::post('slider/store', 'store')->name('slider.store');
            Route::post("helper/delete-record/slider/{id}", "destroy")->name('delete.slider');
            Route::post('helper/bulk-action/slider', 'bulkAction')->name('helper.bulkAction');
        });
        #----------------------------------------------------------------------------------------------------------


        #----------------------------------------------------------------------------------------------------------
        #product
        Route::controller(ProductController::class)->group(function () {
            Route::get('product', 'index')->name('product.index');
            Route::post('product/store', 'store')->name('product.store');
            Route::post("helper/delete-record/products/{id}", "destroy")->name('delete.products');
            Route::get('productform/{slug?}', 'productform')->name('productform');
            Route::post('removeimage', 'removeImage')->name('remove.image');

            Route::get('getvariants', 'variant_data')->name('variant.data');
            Route::post('helper/bulk-action/products', 'bulkAction')->name('helper.bulkAction');

            Route::get('get/products/columns/', 'product_columns')->name('products.columns');
            Route::get('/export/product-data', 'exportData')->name('export.product_data');

        });
        #----------------------------------------------------------------------------------------------------------

        #----------------------------------------------------------------------------------------------------------
        #Product Reviews
        Route::resource('productreview', ProductReviewController::class);
        Route::post("helper/delete-record/delete/productreview/{id}", [ProductReviewController::class, "destroy"]);
        Route::post('helper/bulk-action/productreview', [ProductReviewController::class, 'bulkAction']);
        #----------------------------------------------------------------------------------------------------------

        #---------------------------------------------------------------------------------------------------
        #Coupon module routes
        Route::get('coupon', [CouponController::class, 'index'])->name('coupon.index');
        Route::post('coupon-store', [CouponController::class, 'store'])->name('coupon.store');
        #---------------------------------------------------------------------------------------------------
    });




    #===========================================================================================================
#===========================================================================================================
    Route::middleware(['auth:admin', 'role:supperadmin|admin|staff'])->group(function () {

        #=============================================================================================================
        #helper function routes
        Route::controller(HelperController::class)->group(function () {
            Route::group(['prefix' => 'helper'], function () {
                Route::post('/delete-record/{table_name}/{id}', 'deleteRecord')->name('helper.deleteRecord');
                Route::post('/change-stautus/{table_name}/{id}/{status_column_name?}', 'changeStatus')->name('helper.changeStatus');
                Route::post('/getRecord/{table_name}/{id}', action: 'getRecord')->name('helper.getRecord');
                Route::post('/bulk-action/{table_name}/{column_name?}', 'bulkAction')->name('helper.bulkAction');
            });
        });
        Route::post('/delete-image', [HelperController::class, 'deleteImageFromHelper'])->name('delete.image');

        #=============================================================================================================

        #=============================================================================================================
        #Profile Pages
        Route::group(['prefix' => 'profile'], function () {
            Route::get('', [SettingsController::class, 'profile'])->name('profile.edit');
            Route::post('', [SettingsController::class, 'profile_store'])->name('profile.store');
            Route::post('password-update', [SettingsController::class, 'security_setting_store'])->name('password.update');

        });
        #=============================================================================================================
    });
    #===========================================================================================================
#===========================================================================================================


    #===========================================================================================================
#===========================================================================================================
#Client User Routes
    Route::middleware(['auth:admin', 'role:supperadmin|admin|staff'])->group(function () {
        Route::resource('client', ClientController::class);

        Route::controller(ClientController::class)->group(function () {

            Route::get('getClientList', 'getClientList')->name('getClientList');
            Route::get('create-client', 'form')->name('create.client');
            Route::get('edit-client/{id}', 'form')->name('edit.client');
            Route::post('get-cities', 'getCities')->name('get.cities');
            Route::post('helper/delete-record/delete/client/{id}', 'destroy');
        });
    });
    #===========================================================================================================
#===========================================================================================================

    #===========================================================================================================
#===========================================================================================================
#User(Panel user) routes
    Route::middleware(['auth:admin', 'role:supperadmin|admin|staff'])->group(function () {
        /* For All Staff List*/
        Route::controller(UserController::class)->group(function () {
            Route::get('user/{type?}', 'index')->name('view.user')->middleware(['auth:admin', 'role:supperadmin|admin|staff']);
            Route::get('create-user', 'form')->name('create.user');
            Route::get('edit-user/{id}', 'form')->name('edit.user');
            Route::post('user-store', 'StoreUsers')->name('store.user');
            Route::get('getUserList', 'getUserList')->name('getUserList');
            Route::post('reset-password/{id}', 'userPasswordReset')->name('resetpassword.user');
            Route::post('clearLoginAttempts/{code}', 'clearLoginAttempts')->name('clearloginlttempts.user');
            /* Route User */
            Route::get('getRoleWiseUserlist', 'getRoleWiseUserlist')->name('getRoleWiseUserlist');
            Route::post('helper/delete-record/delete/user/{id}', 'deleteUser')->name('deleteuser');
        });

    });
    #===========================================================================================================
#===========================================================================================================

    #===========================================================================================================
#===========================================================================================================
    Route::middleware(['auth:admin', 'role:supperadmin'])->group(function () {
        #-------------------------------------------------------------------------------------
        #PanelSettings Pages
        Route::group(['prefix' => 'panel-settings', 'middleware' => ['role:supperadmin']], function () {
            Route::get('{panelsettings}', [SettingsController::class, 'panel_settings'])->whereIn(
                'panelsettings',
                [
                    'panel-settings',
                    'mail-settings',
                    'design-settings',
                    'security-settings'
                    // ,'billing-settings','notifications-settings','connections-settings','design-settings'
                ]
            )->name('panel-settings');

            /* Settings Pages Store*/
            Route::post('panel-settings', [SettingsController::class, 'site_setting_store'])->name('store.panel-settings');
            Route::post('security-settings', [SettingsController::class, 'security_setting_store'])->name('store.security-settings');
            Route::post('mail-settings', [SettingsController::class, 'mail_setting_store'])->name('store.mail-settings');
            Route::post('design-settings', [SettingsController::class, 'design_setting_store'])->name('store.design-settings');
        });
        #-------------------------------------------------------------------------------------

    });
    #===========================================================================================================
#===========================================================================================================

    #==================================================================================================
# Staff Role & Permissions Routes
    Route::middleware(['auth:admin', 'role:admin|staff|supperadmin'])->group(function () {
        #===================================================================================================
        # Staff Role
        Route::get('role', [RolesController::class, 'index'])->name('role.index');
        Route::post('role/store', [RolesController::class, 'store'])->name('role.store');
        Route::post('helper/delete-record/delete/staff_roles/{id}', [RolesController::class, 'deleteRole'])->name('deleteuser');

        #===================================================================================================

        #===================================================================================================
        # Staff Role Permissions
        Route::get('role/permission/{id}', [RolesController::class, 'assignPermission'])->name('assign.permission');
        Route::post('store-role-permissions', [RolesController::class, 'StoreRolePermissions'])->name('store.role.permissions');
        #===================================================================================================
    });
    #end
#==================================================================================================
});
#===================================================================================================================
#===================================================================================================================
