// 使用方法：复制到routes/admin.php中
Route::prefix('{$group}')->name('{$group}.')->group(function () {
    // {$moduleName}管理
    Route::controller(\App\Http\Controllers\Admin\{$base}\{$controller}Controller::class)->prefix('{$module}')->name('{$module}.')->group(function (){
        Route::any('/index', 'index')->name('index');
        Route::any('/add', 'add')->name('add');
        Route::any('/edit', 'edit')->name('edit');
        Route::post('/drop', 'drop')->name('drop');
        Route::post('/dropall', 'dropall')->name('dropall');
    });
});
