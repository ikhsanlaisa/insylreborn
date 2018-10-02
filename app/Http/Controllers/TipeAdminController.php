<?php

namespace App\Http\Controllers;

use App\Models\TipeAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\TipeAdmin as Tipe;

class TipeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listTipeAdmin()
    {
        $tipeadmin = TipeAdmin::all();
        return Tipe::collection($tipeadmin);

    }
}
