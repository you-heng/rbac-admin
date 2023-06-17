<?php
use think\facade\Route;

Route::rule(':version/:controller/:action', 'seek/:version.:controller/:action');