<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="coffee">
    <meta name="author" content="my coffee caffee">
    <title>{{ config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
</head>

<body>
    <div class="container-fluid mt-4 mb-4">
        <div class="card">
            <div class="card-header text-center align-center bg-dark text-light font-weight-bold">
                <strong>Laporan </strong>
                <br>
                <strong class="text-right align-right">{{ \Carbon\Carbon::now()->format('l, d/m/Y') }}</strong>
            </div>
            <div class="card-body bg-secondary">
                <div class="row mb-4">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered bg-light" style="border-width:1px;border-color:black">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Label Meja</th>
                                    <th>Nama Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1;
                                $total = 0;
                                @endphp
                                @foreach ($laporans as $item)
                                <tr>
                                    <td class="center">{{ $no++ }}</td>
                                    <td class="left">{{ $item->nama_pelanggan }}</td>
                                    <td class="left">{{ $item->no_meja }}</td>
                                    <td class="left">{{ $item->nama_menu }}</td>
                                    <td class="left">@currency($item->harga_menu)</td>
                                    <td class="text-center">{{ $item->jumlah }}</td>
                                    <td class="left">@currency($item->total)</td>
                                    @php
                                    $total += $item->total;
                                    @endphp
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-6 ml-auto">
                            <div class="alert alert-primary" role="alert">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <strong>Total:</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <strong>@currency($total)</strong> <br>
                                                <i>
                                                    *{{ ucfirst(Terbilang::make($total)) }} rupiah.
                                                </i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
