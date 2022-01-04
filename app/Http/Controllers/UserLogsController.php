<?php

namespace App\Http\Controllers;

use App\Models\UserLogs;
use Illuminate\Http\Request;

class UserLogsController extends Controller
{
   
    public function index()
    {
        return view('admin.user_logs');
    }

    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }

    public function show(UserLogs $userLogs)
    {
        //
    }

    public function edit(UserLogs $userLogs)
    {
        //
    }

   
    public function update(Request $request, UserLogs $userLogs)
    {
        //
    }

    
    public function destroy(UserLogs $userLogs)
    {
        //
    }
}
