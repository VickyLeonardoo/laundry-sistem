@extends('partials.admin.header')
@section('title','Tambah Orderan')
@section('content')

<section class="row">
    @if (session('success'))
        <div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
            Data Order Item Berhasil Ditambahkan
        </div>
    @endif
    <div class="card">
        <div class="card-header text-end">
            <a href="{{ route('admin.order.menunggu.transaction.edit',$transactionNo) }}" class="btn btn-primary ">Back</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-end">
        </div>
        <div class="card-body">
            <form action="{{ route('admin.order.menunggu.transaction.store',$id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Jenis Barang:</label>
                    <select name="jenis_barang_id" class="form-control" id="jenis_barang">
                        @forelse ($jenis as $jenisItem)
                            <option value="{{ $jenisItem->id }}" data-satuan="{{ $jenisItem->satuan }}" data-harga="{{ $jenisItem->harga }}">{{ $jenisItem->nama }}</option>
                        @empty
                            <option value="">No Data Found</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label id="label_berat">Berat</label>
                    <input type="text" class="form-control" name="berat" placeholder="Masukkan Berat" value="{{ old('berat') }}">
                </div>
                <div class="form-group">
                    <label id="label_jmlItem" style="display: none;">Jumlah Item</label>
                    <input type="text" class="form-control" name="jmlItem" placeholder="Masukkan Jumlah Item" value="{{ old('jmlItem') }}" style="display: none;">
                </div>
                <div class="form-group">
                    <label>Tanggal Diantar</label>
                    <input type="datetime-local" class="form-control {{ $errors->has('tglDiantar') ? 'is-invalid':'' }}" name="tglDiantar">
                    @error('tglDiantar')
                        <h6 class="text-danger">{{ $message }}</h6>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" readonly>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
