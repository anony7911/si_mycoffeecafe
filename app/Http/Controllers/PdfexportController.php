<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Carbon\Carbon;

class PdfexportController extends Controller
{
    public function index()
    {
        $laporans = Pesanan::join('pelanggans', 'pesanans.pelanggan_id', '=', 'pelanggans.id')
            ->join('menus', 'pesanans.menu_id', '=', 'menus.id')
            ->join('mejas', 'pesanans.meja_id', '=', 'mejas.no_meja')
            ->select('pesanans.id', 'pesanans.pelanggan_id', 'pelanggans.nama_pelanggan', 'pelanggans.telp_pelanggan', 'pesanans.menu_id', 'menus.nama_menu', 'menus.harga_menu', 'menus.gambar_menu', 'menus.deskripsi_menu', 'menus.status_menu', 'pesanans.meja_id', 'mejas.no_meja', 'mejas.nama_meja', 'mejas.qrcode', 'mejas.link', 'pesanans.jumlah', 'pesanans.total')
            ->where('pesanans.status_pesanan', '=', 'dikonfirmasi')
            ->whereDate('pesanans.updated_at', '=', Carbon::today())
            ->orderBy('pesanans.pelanggan_id', 'desc')
            ->get();
        return view('livewire.laporan-export', compact('laporans'));
    }

    public function export_pdf()
    {
        $laporans = Pesanan::join('pelanggans', 'pesanans.pelanggan_id', '=', 'pelanggans.id')
            ->join('menus', 'pesanans.menu_id', '=', 'menus.id')
            ->join('mejas', 'pesanans.meja_id', '=', 'mejas.no_meja')
            ->select('pesanans.*', 'pelanggans.nama_pelanggan', 'pelanggans.telp_pelanggan', 'menus.nama_menu', 'menus.harga_menu', 'mejas.no_meja', 'mejas.nama_meja')
            ->where('pesanans.status_pesanan', '=', 'dikonfirmasi')
            ->whereDate('pesanans.updated_at', '=', Carbon::today())
            ->orderBy('pesanans.pelanggan_id', 'desc')
            ->get();
        $pdf = \PDF::loadView('livewire.laporan-cetak', ['laporans' => $laporans]);
        return $pdf->download(date('Y-m-d_H:i:s') . '_cetak_laporan' . '.pdf');
    }
}
