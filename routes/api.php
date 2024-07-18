<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

route::prefix('v1')->group(function () {

    require __DIR__ . '/auth.php';
});
