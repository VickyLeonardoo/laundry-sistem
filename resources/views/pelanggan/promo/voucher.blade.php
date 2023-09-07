@extends('partials.pelanggan.header')
@section('title','Voucher Saya')
@section('content')
<section class="row">
@forelse (auth()->user()->voucher as $item)
    @if ($item->jumlah > 0)
    <div class="col-6 col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body px-4 py-4-5">
                <h5>{{ $item->discount->nama }}</h5>
                <div class="row">
                    <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                        <div class="stats-icon blue mb-2">
                            <i class="fas fa-percent"></i>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                        <h6 class="text-muted font-semibold">Jumlah Voucher</h6>
                        <h6 class="font-extrabold mb-0">{{ $item->jumlah }}</h6>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Claim</button> --}}
                </div>
            </div>
        </div>
    </div>
    @endif
@empty
<h5>Kamu Tidak Memiliki Voucher Apapun</h5>
@endforelse
</section>
@endsection
