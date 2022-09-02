<?php

namespace App\Http\Livewire;

use App\Models\Meja;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DataMeja extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $perPage = 10;

    protected $mejas;
    public $no_meja, $nama_meja, $status_meja, $qrcode, $link, $mejaId;

    public function resetInput()
    {
        $this->no_meja = null;
        $this->nama_meja = null;
        $this->status_meja = null;
        $this->qrcode = null;
        $this->link = null;
    }

    public function render()
    {
        $this->mejas = Meja::orderBy('no_meja', 'asc')->paginate($this->perPage);
        return view('livewire.data-meja', [
            'mejas' => $this->mejas,
        ]);
    }

    public function mejaId($id)
    {
        $this->mejaId = $id;

        $meja = Meja::find($id);
        $this->no_meja = $meja->no_meja;
        $this->nama_meja = $meja->nama_meja;
        $this->status_meja = $meja->status_meja;
        $this->qrcode = $meja->qrcode;
        $this->link = $meja->link;
    }

    public function store()
    {
        $this->validate([
            'no_meja' => 'required',
            'nama_meja' => 'required',
        ]);
        $this->link = 'http://127.0.0.1:8000/' . 'meja_' . $this->no_meja . '_' . Str::lower(preg_replace('/\s+/', '', $this->nama_meja));
        // $this->qrcode = QrCode::format('png')->size(399)->generate($this->link);
        Meja::create([
            'no_meja' => 'meja_' . $this->no_meja . '_' . Str::lower(preg_replace('/\s+/', '', $this->nama_meja)),
            'nama_meja' => $this->nama_meja,
            'status_meja' => 1,
            'link' => $this->link,
        ]);
        $this->resetInput();
        session()->flash('success', 'Data berhasil ditambahkan!');
    }

    public function update()
    {
        $this->validate([
            'no_meja' => 'required',
            'nama_meja' => 'required',
        ]);
        Meja::find($this->mejaId)->update([
            'no_meja' => 'meja_' . $this->no_meja . '_' . Str::lower(preg_replace('/\s+/', '', $this->nama_meja)),
            'nama_meja' => $this->nama_meja,
            'link' => 'http: //127.0.0.1:8000/' . 'meja_' . $this->no_meja . '_' . Str::lower(preg_replace('/\s+/', '', $this->nama_meja)),
        ]);
        $this->resetInput();
        session()->flash('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Meja::find($id)->delete();
        session()->flash('success', 'Data berhasil dihapus!');
    }

    public function qrImage($id)
    {
        $meja = Meja::find($id);
        $output = '/' . $meja->no_meja . '.png';
        QrCode::format('png')->size(399)->generate($meja->link, public_path($output));
        return response()->download(public_path($output));
    }

}
