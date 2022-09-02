<?php

namespace App\Http\Controllers;

use App\Models\Meja;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::all();
        return view('meja', compact('mejas'));
    }

}
