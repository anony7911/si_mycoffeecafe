<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Pesanan;
use Livewire\Component;
use App\Models\Pelanggan;
use Livewire\WithPagination;

class Laporan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 10;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $updatesQueryString = ['search'];

    protected $laporans, $menus;
    public $pelanggan_id, $nama_pelanggan, $telp_pelanggan, $alamat_pelanggan, $status_pelanggan, $menu_id, $nama_menu,
    $harga_menu, $gambar_menu, $deskripsi_menu, $status_menu, $meja_id, $no_meja, $nama_meja, $qrcode, $link, $jumlah, $total;
    public $totalBeli;
    public $totalBayar;
    public $pelanggan = '';
    public $pelanggans = '';
    public function render()
    {
        if ($this->pelanggan) {
            $this->laporans = Pesanan::join('pelanggans', 'pesanans.pelanggan_id', '=', 'pelanggans.id')
                ->join('menus', 'pesanans.menu_id', '=', 'menus.id')
                ->join('mejas', 'pesanans.meja_id', '=', 'mejas.no_meja')
                ->select('pesanans.id', 'pesanans.pelanggan_id', 'pesanans.updated_at as updateat', 'pelanggans.nama_pelanggan', 'pelanggans.telp_pelanggan', 'pesanans.menu_id', 'menus.nama_menu', 'menus.harga_menu', 'menus.gambar_menu', 'menus.deskripsi_menu', 'menus.status_menu', 'pesanans.meja_id', 'mejas.no_meja', 'mejas.nama_meja', 'mejas.qrcode', 'mejas.link', 'pesanans.jumlah', 'pesanans.total')
                ->where('pesanans.status_pesanan', '=', 'dikonfirmasi')
                ->where('pesanans.pelanggan_id', $this->pelanggan)
                ->whereDate('pesanans.updated_at', '=', Carbon::today())
                ->orderBy('pesanans.pelanggan_id', 'desc')
                ->paginate($this->perPage);
        } else {
            $this->laporans = Pesanan::join('pelanggans', 'pesanans.pelanggan_id', '=', 'pelanggans.id')
                ->join('menus', 'pesanans.menu_id', '=', 'menus.id')
                ->join('mejas', 'pesanans.meja_id', '=', 'mejas.no_meja')
                ->select('pesanans.id', 'pesanans.pelanggan_id', 'pesanans.updated_at as updateat', 'pelanggans.nama_pelanggan', 'pelanggans.telp_pelanggan', 'pesanans.menu_id', 'menus.nama_menu', 'menus.harga_menu', 'menus.gambar_menu', 'menus.deskripsi_menu', 'menus.status_menu', 'pesanans.meja_id', 'mejas.no_meja', 'mejas.nama_meja', 'mejas.qrcode', 'mejas.link', 'pesanans.jumlah', 'pesanans.total')
                ->where('pesanans.status_pesanan', '=', 'dikonfirmasi')
                ->whereDate('pesanans.updated_at', '=', Carbon::today())
                ->orderBy('pesanans.pelanggan_id', 'desc')
                ->paginate($this->perPage);
            $this->menus = Menu::all();
        }
        $this->pelanggans = Pelanggan::orderBy('created_at', 'desc')->get();
        return view('livewire.laporan', [
            'laporans' => $this->laporans,
            'totalBayar' => $this->totalBayar,
            'menus' => $this->menus,
            // 'pelanggans' => $this->pelanggans,
        ])->extends('layouts.app');
    }

}
