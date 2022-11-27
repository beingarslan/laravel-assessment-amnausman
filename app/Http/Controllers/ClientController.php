<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::isClient()->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }
}
