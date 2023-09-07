@extends('partials.pelanggan.header')
@section('title','Promo List')
@section('content')
<section class="row">
    <div class="col-lg-3">
        <span class="badge bg-success">Poin Dimiliki: {{ $poin }}</span>
    </div>
    <div class="col-12 col-lg-12 mt-5">
        <div class="row">
            @foreach ($promos as $promo)
                @if ($poin > $promo->persyaratan)
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-4 py-4-5">
                                <h5 class="text-center">{{ $promo->nama }}</h5>
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Point Persyaratan</h6>
                                        <h6 class="font-extrabold mb-0">{{ $promo->persyaratan }}</h6>
                                    </div>
                                    <a href="" class="btn btn-primary">Claim</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card ">
                            <div class="card-body px-4 py-4-5">
                                <h5 class="text-center">{{ $promo->nama }}</h5>
                                <div class="row">
                                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                        <div class="stats-icon blue mb-2">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                        <h6 class="text-muted font-semibold">Point Persyaratan</h6>
                                        <h6 class="font-extrabold mb-0">{{ $promo->persyaratan }}</h6>
                                    </div>
                                    <a href="#" class="btn btn-danger">Point Tidak Cukup!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div>
            {{ $promos->links() }}
        </div>
    </div>

</section>
@endsection
