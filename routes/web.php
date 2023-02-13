<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
    // Exportar xml
	Route::get('export-table-to-xml', 'ExportXmlController@exportTableToXml')->name('export-table-to-xml');
	Route::get('export-to-txt', 'ExportController@exportToTxt')->name('export-to-txt');

	Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');




    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Crear Empleado
    Route::delete('crear-empleados/destroy', 'CrearEmpleadoController@massDestroy')->name('crear-empleados.massDestroy');
    Route::post('crear-empleados/parse-csv-import', 'CrearEmpleadoController@parseCsvImport')->name('crear-empleados.parseCsvImport');
    Route::post('crear-empleados/process-csv-import', 'CrearEmpleadoController@processCsvImport')->name('crear-empleados.processCsvImport');
    Route::resource('crear-empleados', 'CrearEmpleadoController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
