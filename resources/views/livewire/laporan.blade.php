<div>
    <div class="row p-2 m-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white text-center font-weight-bold">
                    Laporan
                </div>
                <div class="card-body bg-secondary text-white">
                    <div class="row mb-2 mt-2">
                        <div class="col-md-1 col-sm-4 align-self-end">
                            PerPage: <select wire:model="perPage" class="form-control" id="selectpagination">
                                {{-- <option value="5">5</option> --}}
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        {{-- cetak --}}
                        <div class="col-md-4 col-sm-8 align-self-end">
                            <a href="{{ url('/cetak_laporan') }}" type="button" class="btn btn-md btn-warning text-light"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                        </div>
                        <div class="col align-self-center">
                        </div>
                        {{-- <div class="col-md-4 align-self-end mt-2">
                            <input wire:model.debounce.500ms="search" type="text" class="form-control" id="cari" placeholder="Cari...">
                        </div> --}}
                        <div class="col-md-4 align-self-end mt-2">
                            <div wire:ignore>
                                Pilih Pelanggan: <select id="select2ID" wire:model="pelanggan" class="form-control js-example-basic-single" name="pelanggan">
                                    <option value="">Pilih...</option>
                                    @foreach ($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama_pelanggan }} | {{ $pelanggan->telp_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered bg-white">
                            <thead>
                                <tr style="background-image: linear-gradient(to bottom, #FFEE82, #F9EBC8)">
                                    <th>No</th>
                                    <th>Tgl Beli</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                @forelse ($laporans as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($item->updateat)->isoFormat('dddd, DD-MM-YYYY') }}
                                    </td>
                                    <td>{{ $item['nama_pelanggan'] }}</td>
                                    <td>{{{ $item['nama_menu']  }}}</td>
                                    <td>@currency($item['harga_menu'])</td>
                                    <td>{{ $item['jumlah'] }}</td>
                                    <td>@currency($item['harga_menu'] * $item['jumlah'])</td>
                                    @php
                                    $totalBayar += $item['harga_menu'] * $item['jumlah']
                                    @endphp
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Belum ada pesanan yang dikonfirmasi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- total bayar --}}
                        <div class="text-right">
                            <input class="form-control text-right font-weight-bold" value="@currency($totalBayar),-" />
                            <span class="text-light font-weight-bold">
                                <i>* {{ ucfirst(Terbilang::make($totalBayar)) }} rupiah.</i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // select2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    $(document).ready(function() {
        $('#select2ID').on('change', function(e) {
            @var data = $('#select2ID').select2("val");
            @this.set('pelanggan', data);
        });
    });

    document.addEventListener("livewire:load", function(event) {
        window.livewire.hook('afterDomUpdate', () => {
            $('#select2ID').select2({
                placeholder: 'Select an option'
            , });
        });
    });

</script>
@endpush
