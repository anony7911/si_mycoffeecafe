<div>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <div class="row">
                <div class="col-md-10 col-sm-7">
                    <h3>Data Meja</h3>
                </div>
                <div class="col-md-2 col-sm-5 align-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus-circle" aria-hidden="true" data-toggle="toltipe" title="Tambah"></i> Data Meja</button>
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

            <div class="row">
                @forelse ($mejas as $meja)
                <div class="col-md-3 col-sm-4">
                    <div class="card">
                        <div class="card-header text-center text-dark font-weight-bold" style="background-image: linear-gradient(to bottom,  #FFEE82, #F9EBC8)">No {{ Str::upper($meja->no_meja) }}</div>
                        <div class="card-body text-center">
                            <p>
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($meja->link)) !!} "> <br>
                            </p>
                            <p class="mb-2 text-dark font-weight-bold">
                                MEJA {{ Str::upper($meja->nama_meja) }}
                            </p>
                            <button wire:click="qrImage({{ $meja->id }})" type="button" class="btn btn-info btn-sm btn-block text-white">Download</button>
                            <button wire:click="mejaId({{ $meja->id }})" type="button" class="btn btn-warning btn-sm btn-block text-white" data-toggle="modal" data-target="#modalEdit">Update</button>
                            <button wire:click="destroy({{ $meja->id }})" type="button" class="btn btn-danger btn-sm btn-block">Delete</button>

                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <h5>Tidak ada data.</h5>
                    </div>
                </div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="float-center mt-2">
                        {{ $mejas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Meja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nomor Meja</label>
                        <input wire:model="no_meja" type="number" class="form-control @error('no_meja') is-invalid @enderror">
                        @error('no_meja')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Nama Meja</label>
                        <input wire:model="nama_meja" type="text" class="form-control @error('nama_meja') is-invalid @enderror">
                        @error('nama_meja')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="store()" class="btn btn-success close-modal" data-dismiss="modal">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data Meja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nomor Meja</label>
                        <input wire:model="no_meja" type="number" class="form-control @error('no_meja') is-invalid @enderror">
                        @error('no_meja')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Nama Meja</label>
                        <input wire:model="nama_meja" type="text" class="form-control @error('nama_meja') is-invalid @enderror">
                        @error('nama_meja')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                        <button type="submit" wire:click.prevent="update()" class="btn btn-primary close-modal" data-dismiss="modal">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
