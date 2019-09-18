<?php
Route::get('cron/run', 'CronController@cron')->name('cron');
Route::get('/{any}', 'AppController')->where('any', '.*');