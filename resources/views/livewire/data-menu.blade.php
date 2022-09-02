<div>
    <div class="card">
        <div class="card-header bg-dark text-light">
            <div class="row">
                <div class="col-md-10 col-sm-7">
                    <h3>Daftar Menu</h3>
                </div>
                <div class="col-md-2 col-sm-5">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus-circle" aria-hidden="true" data-toggle="toltipe" title="Tambah"></i> Data Menu</button>
                </div>
            </div>
        </div>
        <div class="card-body bg-secondary text-white">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._alert')
                </div>
                <div class="col-md-6 form-inline mb-4">
                    Per Page: &nbsp;
                    <select wire:model="perPage" class="form-control">
                        <option>2</option>
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12">
                    <div class="table table-responsive">
                        <table class="table table-striped table-bordered table-hover bg-white">
                            <thead style="background-image: linear-gradient(to bottom, #FFEE82, #F9EBC8)">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Nama Menu</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Deskripsi</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ url('/') }}/{{ $menu->gambar_menu }}" alt="" width="120px"></td>

                                    <td>{{ $menu->nama_menu }}</td>
                                    <td>{{ $menu->harga_menu }}</td>
                                    <td>{{ $menu->deskripsi_menu }}</td>
                                    <td>
                                        @if ($menu->status_menu == true)
                                        <span class="badge badge-success">Tersedia</span>
                                        @else
                                        <span class="badge badge-danger">Belum Tersedia</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($menu->status_menu == true)
                                        <button wire:click="nonaktif({{ $menu->id }})" type="button" class="btn btn-info btn-sm btn-block">Nonaktif</button>
                                        @else
                                        <button wire:click="aktif({{ $menu->id }})" type="button" class="btn btn-success btn-sm btn-block">Aktif</button>
                                        @endif
                                        <button wire:click="menuId({{ $menu->id }})" type="button" class="btn btn-warning btn-sm btn-block text-white" data-toggle="modal" data-target="#modalEdit">Update</button>
                                        <button wire:click="destroy({{ $menu->id }})" type="button" class="btn btn-danger btn-sm btn-block">Delete</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{$menus->links()}}
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>Nama Menu</label>
                            <input wire:model="nama_menu" type="text" class="form-control @error('nama_menu') is-invalid @enderror">
                            @error('nama_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Harga Menu</label>
                            <input wire:model="harga_menu" type="text" class="form-control @error('harga_menu') is-invalid @enderror">
                            @error('harga_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Deskripsi Menu</label>
                            <textarea wire:model="deskripsi_menu" class="form-control @error('deskripsi_menu') is-invalid @enderror">
                        </textarea>
                            @error('deskripsi_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Gambar Menu</label>
                            <input type="file" wire:model="gambar_menu" class="form-control @error('gambar_menu') is-invalid @enderror">
                            @error('gambar_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            @if($gambar_menu)
                            <label for="">
                                <img src="{{ $gambar_menu->temporaryUrl() }}" width="200px">
                            </label>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                            <button type="submit" wire:click.prevent="store()" class="btn btn-success close-modal" data-dismiss="modal">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="update" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>Nama Menu</label>
                            <input wire:model="nama_menu" type="text" class="form-control @error('nama_menu') is-invalid @enderror">
                            @error('nama_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Harga Menu</label>
                            <input wire:model="harga_menu" type="text" class="form-control @error('harga_menu') is-invalid @enderror">
                            @error('harga_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Deskripsi Menu</label>
                            <textarea wire:model="deskripsi_menu" class="form-control @error('deskripsi_menu') is-invalid @enderror">
                        </textarea>
                            @error('deskripsi_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>Gambar Menu</label>
                            <input type="file" wire:model="gambar_menu" class="form-control @error('gambar_menu') is-invalid @enderror">
                            <small class="text-muted">*Kosongkan jika tidak ingin mengubah gambar.</small>
                            @error('gambar_menu')<div class="invalid-feedback">{{ $message }}
                            </div>@enderror
                        </div>
                        <div class="form-group mb-2">
                            @if($gambar_menu)
                            <label for="">
                                <img src="{{ $gambar_menu->temporaryUrl() }}" width="200px">
                            </label>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                            <button type="submit" wire:click.prevent="update()" class="btn btn-primary close-modal" data-dismiss="modal">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
