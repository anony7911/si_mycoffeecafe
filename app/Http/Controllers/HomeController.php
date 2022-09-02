<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Pesanan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mejas = Meja::count();
        $menus = Menu::count();
        $pesanans = Pesanan::count();
        $pelanggans = Pelanggan::count();
        return view('home', compact('mejas', 'menus', 'pesanans', 'pelanggans'));
    }
}
