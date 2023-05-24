<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DataStatsController;
use Illuminate\Http\Request;

class DataStatsApiController extends Controller
{
    public function index(Request $request)
    {
        return (new DataStatsController)->index($request, 'api');
    }
}