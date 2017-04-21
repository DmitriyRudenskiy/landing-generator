<?php
namespace App\Http\Controllers\Admin;

use Laravel\Lumen\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function info()
    {
        return view('admin.dashboard.info');
    }
}
