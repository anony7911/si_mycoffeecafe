@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center bg-dark text-white">{{ __('Dashboard') }}</div>
                <div class="card-body bg-secondary">
                    <div class="row">
                        <div class="col-md-3 mt-4">
                            <div class="card">
                                <div class="card-header text-center text-dark font-weight-bold" style="background-image: linear-gradient(to top,  #FFEE82, #F9EBC8)">
                                    {{ __('Total Meja') }}
                                </div>
                                <div class="card-body">
                                    <h4 class="text-center">
                                       {{ $mejas }} Buah
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mt-4">
                            <div class="card">
                                <div class="card-header text-center text-dark font-weight-bold" style="background-image: linear-gradient(to top,  #FFEE82, #F9EBC8)">{{ __('Total Menu') }}</div>
                                <div class="card-body">
                                    <h4 class="text-center">
                                        {{ $menus }} Jenis
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mt-4">
                            <div class="card">
                                <div class="card-header text-center text-dark font-weight-bold" style="background-image: linear-gradient(to top,  #FFEE82, #F9EBC8)">{{ __('Total Pemesan') }}</div>
                                <div class="card-body">
                                    <h4 class="text-center">
                                        {{ $pelanggans }} Orang
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mt-4">
                            <div class="card">
                                <div class="card-header text-center text-dark font-weight-bold" style="background-image: linear-gradient(to top,  #FFEE82, #F9EBC8)">{{ __('Total Pesanan') }}</div>
                                <div class="card-body">
                                    <h4 class="text-center">
                                        {{ $pesanans }} Pesanan
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
