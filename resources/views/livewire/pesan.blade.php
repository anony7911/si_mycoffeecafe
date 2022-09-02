<div>
    <div class="row m-2 p-2 row-horizon">
        @if(session('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('pesan') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="col-md-8 mt-2 d-flex flex-row flex-nowrap row-horizon">
            <div class="card bg-secondary shadow-sm">
                <div class="card-header bg-dark text-center font-weight-bold text-light">
                    Daftar Menu
                </div>
                <div class="card-body">

                    <div class="card-columns border-bottom mb-2">
                        @foreach ($menus as $menu)
                        <div class="card" style="background-image: linear-gradient(to top, #FFEE82, #F9EBC8); border-color:#FFEE82">
                            <img class="card-img-top" src="{{ url('/') }}/{{ $menu->gambar_menu }}" alt="">
                            <div class="card-body text-center">
                                <h6 class="font-weight-bold"><u>{{ Str::upper($menu->nama_menu) }}</u></h6>
                                <p class="text-muted">{{ ucfirst($menu->deskripsi_menu) }}</p>
                                <h6 class="font-weight-bold">@currency($menu->harga_menu)</h6>
                                <button wire:click="addToCart({{ $menu->id }})" type="button" class="btn btn-primary btn-md btn-block text-white" data-toggle="toltipe" title="Add to Cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center float-right">
                        {{ $menus->links() }}
                    </div>
                </div>
            </div>
        </div>
        @if(session('pesan'))
        <div class="alert alert-success alert-dismissible fade show mb-2 mt-2" role="alert">
            {{ session('pesan') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="col-md-4 mt-2">
            <div class="card">
                <div class="card-header text-center font-weight-bold bg-dark text-light">
                    Keranjang Pesanan
                </div>
                <div class="card-body bg-secondary">
                    <label class="text-white" for="">Nama Anda</label>
                    @error('nama_pelanggan') <div class="text-danger">{{ $message }}</div> @enderror
                    <input wire:model="nama_pelanggan" type="text" class="form-control" placeholder="Nama Anda">
                    <label class="text-white mt-2" for="">No Telp.</label> <br>
                    @error('telp_pelanggan') <div class="text-danger">{{ $message }}</div> @enderror
                    <input wire:model="telp_pelanggan" type="text" class="form-control mb-4" placeholder="082222111111">
                    @if(session('keranjangmin'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('keranjangmin') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <div class="table-responsive bg-light">
                        <table class="table table-striped table-hover ">
                            <thead>
                                <tr style="background-image: linear-gradient(to bottom, #FFEE82, #F9EBC8)">
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Nama Menu</th>
                                    <th class="align-middle">Harga</th>
                                    <th class="align-middle">Jumlah</th>
                                    <th class="align-middle">Subtotal</th>
                                    <th class="align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($keranjang as $key => $item)
                                <tr class="align-self-center align-middle">
                                    <td class="align-middle">{{ $key + 1 }}</td>
                                    <td class="align-middle">{{ $item['nama_menu'] }}</td>
                                    <td class="align-middle">@currency($item['harga_menu'])</td>
                                    <td class="text-center align-middle">
                                        <button wire:click="increment({{ $key }})" type="button" class="btn btn-sm btn-dark"><i class="fa fa-plus-circle" aria-hidden="true"></i></button> <br>
                                        {{ $item['jumlah'] }} <br>
                                        <button wire:click="decrement({{ $key }})" type="button" class="btn btn-sm btn-secondary"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                    </td>
                                    <td class="align-middle">@currency($item['total'])
                                    </td>
                                    <td class="align-middle">
                                        <button wire:click="remove({{ $key }})" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                                <div class="" hidden>
                                    {{ $totalBeli += $item['total'] }}
                                </div>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <h5>Tidak ada data.</h5>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class=" mt-3">
                        <h5 class="text-white text-left">Total Bayar: </h5>
                        <input type="text" class="form-control text-center font-weight-bold" value="@currency($totalBeli)" readonly>
                        <span class="text-white text-right">
                           <i>* {{ ucfirst(Terbilang::make($totalBeli)) }} rupiah.</i>
                        </span>
                    </div>
                    <button wire:click.prevent="store()" type="button" class="btn btn-md btn-success btn-block text-white mt-3 shadow-md" data-toggle="toltipe" title="Checkout">Checkout</button>
                </div>
            </div>
        </div>
    </div>

</div>
