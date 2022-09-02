<?php

namespace App\Http\Livewire;

use App\Models\Pesanan;
use Livewire\Component;
use Livewire\WithPagination;

class DataPesanan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 5;
    protected $mejas, $menus, $pesanans, $pelanggan;

    public $meja_id, $nama_meja, $status_meja, $qrcode, $link, $mejaId;
    public $nama_menu, $harga_menu, $gambar_menu, $deskripsi_menu, $status_menu;
    public $nama_pelanggan, $telp_pelanggan;
    public $pelanggan_id, $jumlah, $total, $menu_id, $status_pesanan;

    public function render()
    {
        $this->pesanans = Pesanan::join('pelanggans', 'pelanggans.id', '=', 'pesanans.pelanggan_id')
            ->join('menus', 'menus.id', '=', 'pesanans.menu_id')
            ->join('mejas', 'mejas.no_meja', '=', 'pesanans.meja_id')
            ->select('pesanans.*', 'pelanggans.nama_pelanggan', 'mejas.no_meja', 'pelanggans.telp_pelanggan', 'menus.nama_menu', 'menus.harga_menu', 'menus.gambar_menu', 'menus.deskripsi_menu', 'menus.status_menu', 'mejas.nama_meja', 'mejas.status_meja', 'mejas.qrcode', 'mejas.link')
        // ->groupBy('pesanans.pelanggan_id')
            ->where('pesanans.status_pesanan', '=', null)
            ->orderBy('pesanans.created_at', 'desc')
            ->paginate($this->perPage);
        // dd($this->pesanans);
        return view('livewire.data-pesanan', [
            'pesanans' => $this->pesanans,
        ]);
    }

    public function konfirmasi($id){
        Pesanan::where('id', $id)->update([
            'status_pesanan' => 'dikonfirmasi',
        ]);
        session()->flash('success', 'Pesanan berhasil dikonfirmasi');
    }

    public function tolak($id){
        Pesanan::where('id', $id)->update([
            'status_pesanan' => 'ditolak',
        ]);
        session()->flash('error', 'Pesanan berhasil ditolak');
    }
}
