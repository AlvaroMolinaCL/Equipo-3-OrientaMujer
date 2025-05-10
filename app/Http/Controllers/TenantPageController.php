<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantPage;
use Illuminate\Http\Request;

class TenantPageController extends Controller
{
    public function index()
    {
        return response()->json(TenantPage::all());
    }
}
