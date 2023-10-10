@extends('partials.admin.header')

@section('title','Discount List')

@section('content')
@if (session('success'))
<div class="alert alert-light-success color-success"><i class="bi bi-check-circle"></i>
    Data Discount Dihapus
</div>
@endif
<form action="{{ route('admin.update.discount.status') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-lg-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Simpan">
                        </div>
                </div>
                <div class="col-12 col-lg-6 text-end">
                    <a href="{{ route('admin.discount.create') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th> <!-- Tambahkan checkbox di sini -->
                            <th>Nomor</th>
                            <th>Nama</th>
                            <th>Tipe</th>
                            <th>Nominal</th>
                            <th>Persyaratan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($discounts as $discount)
                        <tr>
                            <td><input type="checkbox" name="discounts[]" value="{{ $discount->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $discount->nama }}</td>
                            <td>{{ $discount->tipeDiscount }}</td>
                            <td>{{ $discount->nominal }}</td>
                            <td>{{ $discount->persyaratan }}</td>
                            <td>
                                @if ($discount->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.discount.edit',$discount->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ route('admin.discount.destroy',$discount->id) }}" onclick="return confirm('Ingin Hapus Data?')" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen checkbox "Select All"
        var selectAllCheckbox = document.getElementById('select-all');

        // Ambil semua checkbox dalam tabel
        var checkboxes = document.querySelectorAll('input[name="discounts[]"]');

        // Tambahkan event listener ke checkbox "Select All"
        selectAllCheckbox.addEventListener('click', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    });
</script>
