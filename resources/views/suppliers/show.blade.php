@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Supplier</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Simple Tables</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Horizontal Form -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Supplier</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $supplier->name }}</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $supplier->phone }}</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company" class="col-sm-2 col-form-label">Perusahaan</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $supplier->company }}</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $supplier->address }}</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skill" class="col-sm-2 col-form-label">Keahlian</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $supplier->skill }}</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skill" class="col-sm-2 col-form-label">Riwayat PO</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $supplier->orders->count() }} <a
                                    href="/orders?search={{ $supplier->phone }}"
                                    class="btn btn-xs btn-info {{ !$supplier->orders->count() ? 'd-none' : '' }}">Lihat
                                    semua</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/suppliers{{ str_replace('/suppliers/' . $supplier->id, '', request()->getRequestUri()) }}"
                            class="btn btn-sm btn-dark mr-1">Kembali</a>
                        <a href="/suppliers/{{ $supplier->id }}/edit{{ str_replace('/suppliers/' . $supplier->id, '', request()->getRequestUri()) }}"
                            class="btn btn-sm btn-info mr-1">Ubah Detail</a>
                        <form
                            action="/suppliers/{{ $supplier->id . str_replace('/suppliers/' . $supplier->id, '', request()->getRequestUri()) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button
                                onclick="return confirm('PERHATIAN!!!\nSupplier {{ $supplier->name }} akan dihapus secara permanen!')"
                                type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
                <!-- /.card-footer -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
