<?php

namespace App\Http\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DataMenu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;

    public $perPage = 10;

    protected $menus;
    public $nama_menu, $harga_menu, $gambar_menu, $deskripsi_menu, $status_menu, $menuId;

    public function resetInput()
    {
        $this->nama_menu = null;
        $this->harga_menu = null;
        $this->gambar_menu = null;
        $this->deskripsi_menu = null;
        $this->status_menu = null;
    }

    public function render()
    {
        $this->menus = Menu::orderBy('created_at', 'desc')->paginate($this->perPage);
        return view('livewire.data-menu', [
            'menus' => $this->menus,
        ]);
    }

    public function menuId($id)
    {
        $this->menuId = $id;

        $menu = Menu::find($id);
        $this->nama_menu = $menu->nama_menu;
        $this->harga_menu = $menu->harga_menu;
        $this->deskripsi_menu = $menu->deskripsi_menu;
        $this->status_menu = $menu->status_menu;
    }

    public function store()
    {
        $this->validate([
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'deskripsi_menu' => 'required',
            'gambar_menu' => 'image|mimes:jpeg,png,jpg,gif,svg, PNG, JPG|max:2048',
        ]);
        Menu::create([
            'nama_menu' => $this->nama_menu,
            'harga_menu' => $this->harga_menu,
            'gambar_menu' => $this->gambar_menu->store('gambar_menu'),
            'deskripsi_menu' => $this->deskripsi_menu,
            'status_menu' => true,
        ]);
        $this->resetInput();
        session()->flash('success', 'Menu berhasil ditambahkan!');
    }

    public function destroy($id){
        $menu = Menu::find($id);
        $menu->delete();
        session()->flash('success', 'Menu berhasil dihapus!');
    }

    public function update(){
        $this->validate([
            'nama_menu' => 'required',
            'harga_menu' => 'required',
            'deskripsi_menu' => 'required',
        ]);

        if($this->gambar_menu){
            Menu::find($this->menuId)->update([
                'nama_menu' => $this->nama_menu,
                'harga_menu' => $this->harga_menu,
                'gambar_menu' => $this->gambar_menu->store('gambar_menu'),
                'deskripsi_menu' => $this->deskripsi_menu,
            ]);
        }else{
            Menu::find($this->menuId)->update([
                'nama_menu' => $this->nama_menu,
                'harga_menu' => $this->harga_menu,
                'deskripsi_menu' => $this->deskripsi_menu,
            ]);
        }
        $this->resetInput();
        session()->flash('success', 'Menu berhasil diubah!');
    }

    public function nonaktif($id){
        $menu = Menu::find($id);
        $menu->update([
            'status_menu' => false,
        ]);
        session()->flash('success', 'Status Menu berhasil diubah!');
    }
    public function aktif($id){
        $menu = Menu::find($id);
        $menu->update([
            'status_menu' => true,
        ]);
        session()->flash('success', 'Status Menu berhasil diubah!');
    }
}
