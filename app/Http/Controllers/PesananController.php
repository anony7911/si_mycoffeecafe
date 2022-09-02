<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $mejas = Meja::all();
        $pesanans = Pesanan::all();
        $pelanggans = Pesanan::all();
        return view('pesanan', compact('pesanans', 'menus', 'mejas', 'pelanggans'));
    }
}
