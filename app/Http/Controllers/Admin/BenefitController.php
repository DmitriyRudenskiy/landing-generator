<?php
namespace App\Http\Controllers\Admin;

use Laravel\Lumen\Routing\Controller;

class BenefitController extends Controller
{
    public function index()
    {
        return view('admin.benefit.index');
    }

    public function add()
    {
        return view('admin.benefit.add');
    }

    public function edit()
    {
        return view('admin.benefit.edit');
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function remove()
    {

    }
}
