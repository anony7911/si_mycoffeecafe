<div>
    <div class="card">
        <div class="card-header bg-dark text-white text-center font-weight-bold">
            Data Pesanan
        </div>

        <div class="card-body bg-secondary">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive bg-light">
                        <table class="table table-striped table-hover table-bordered">
                            <thead style="background-image: linear-gradient(to bottom, #FFEE82, #F9EBC8)">
                                <tr>
                                    <th class="align-middle text-center">No</th>
                                    <th class="align-middle text-center">Nama Pemesan</th>
                                    <th class="align-middle text-center">Telp Pemesan</th>
                                    <th class="align-middle text-center">Label Meja</th>
                                    <th class="align-middle text-center">Nama Menu</th>
                                    <th class="align-middle text-center">Jumlah</th>
                                    <th class="align-middle text-center">Status Pesanan</th>
                                    <th class="align-middle text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesanans as $pesanan)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $pesanan->nama_pelanggan }}</td>
                                    <td class="align-middle">
                                        <a href="https://api.whatsapp.com/send?phone={{$pesanan->telp_pelanggan}}">{{ $pesanan->telp_pelanggan }}</a>
                                    </td>
                                    <td class="align-middle">{{ Str::upper($pesanan->no_meja) }}</td>
                                    <td class="align-middle">{{ Str::upper($pesanan->nama_menu) }}</td>
                                    <td class="align-middle text-center">{{ $pesanan->jumlah }}</td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-warning">Menunggu</span>
                                    </td>
                                    <td class="align-middle">
                                        <button wire:click="konfirmasi({{ $pesanan->id }})" class="btn btn-primary btn-md mb-1" data-toogle="tooltip" title="Konfirmasi Pesanan"><i class="fa fa-check-circle " aria-hidden="true" data-toogle="tooltip" tittle="Konfirmasi Pesanan"></i></button>
                                        <button wire:click="tolak({{ $pesanan->id }})" class="btn btn-danger btn-md mb-1" data-toogle="tooltip" title="Tolak Pesanan"><i class="fa fa-circle-xmark" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                                 @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada pesanan.</td>
                                    </tr>
                                 @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="float-right">
                                {{ $pesanans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
