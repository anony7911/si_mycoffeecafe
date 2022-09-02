<?php

namespace App\Http\Livewire;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pelanggan;
use App\Models\Pesanan;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Pesan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $perPage = 3;

    protected $mejas, $menus, $pesanans, $pelanggan;
    public $meja;
    public $menu;
    public $no_meja, $nama_meja, $status_meja, $qrcode, $link, $mejaId;
    public $nama_menu, $harga_menu, $gambar_menu, $deskripsi_menu, $status_menu;
    public $nama_pelanggan, $telp_pelanggan;
    public $jumlah, $total;
    public $keranjang = [];
    public $totalBeli;

    public function mount($no_meja)
    {
        $this->meja = Meja::find($no_meja);
        $this->mejaId = $no_meja;
    }

    public function render()
    {
        $this->menus = Menu::where('status_menu', 1)->orderBy('nama_menu', 'desc')->paginate($this->perPage);
        return view('livewire.pesan', [
            'mejas' => $this->mejas,
            'menus' => $this->menus,
            'keranjang' => $this->keranjang,
        ])->extends('layouts.app');
    }

    public function addToCart($id)
    {
        $menu = Menu::find($id);

        $this->keranjang[] = [
            'id' => $id,
            'nama_menu' => $menu->nama_menu,
            'harga_menu' => $menu->harga_menu,
            'gambar_menu' => $menu->gambar_menu,
            'deskripsi_menu' => $menu->deskripsi_menu,
            'jumlah' => 1,
            'total' => $menu->harga_menu,
        ];
        session()->put('keranjang', $this->keranjang);
    }

    public function decrement($id)
    {
        if ($this->keranjang[$id]['jumlah'] !== 1) {
            $this->keranjang[$id]['jumlah']--;
            $this->keranjang[$id]['total'] = $this->keranjang[$id]['harga_menu'] * $this->keranjang[$id]['jumlah'];
            session()->put('keranjang', $this->keranjang);
        } else {
            session()->flash('keranjangmin', 'Jumlah tidak boleh kurang dari 1.');
        }
        session()->put('keranjang', $this->keranjang);
    }

    public function increment($id)
    {
        $this->keranjang[$id]['jumlah']++;
        $this->keranjang[$id]['total'] = $this->keranjang[$id]['harga_menu'] * $this->keranjang[$id]['jumlah'];
        session()->put('keranjang', $this->keranjang);
    }

    public function remove($id)
    {
        unset($this->keranjang[$id]);
        session()->put('keranjang', $this->keranjang);
    }

    public function store()
    {
        $this->validate([
            'nama_pelanggan' => 'required',
            'telp_pelanggan' => 'required',
        ], [
            'nama_pelanggan.required' => 'Nama pelanggan tidak boleh kosong.',
            'telp_pelanggan.required' => 'Telp pelanggan tidak boleh kosong.',
        ]);
        $this->pelanggan = Pelanggan::create([
            'nama_pelanggan' => $this->nama_pelanggan,
            'telp_pelanggan' => $this->telp_pelanggan,
        ]);
        $pelangganId = $this->pelanggan->id;
        foreach ($this->keranjang as $keranjang) {
            $this->pesanan = Pesanan::create([
                'menu_id' => $keranjang['id'],
                'pelanggan_id' => $pelangganId,
                'meja_id' => $this->mejaId,
                'jumlah' => $keranjang['jumlah'],
                'total' => $keranjang['total'],
            ]);
        }
        $this->nama_pelanggan = null;
        $this->telp_pelanggan = null;
        $this->keranjang = [];
        session()->forget('keranjang');
        session()->flash('pesan', 'Pesanan berhasil dilakukan. Hubungi admin untuk pembayaran dan pembatalan pesanan.');
    }
}
