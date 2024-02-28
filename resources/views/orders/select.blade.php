@extends('layouts.table') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Furniture</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <div class="card-tools">
                                <a href="/orders" class="btn btn-danger btn-sm">Batal</a>
                                <a href="/orders/create" class="btn btn-sm btn-success ml-1">Lanjut</a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="bg-dark">
                                        {{-- <th colspan="2"></th> --}}
                                        <th>Nama</th>
                                        <th class="text-right">Tanggal ditambahkan</th>
                                        <th class="text-right">Kategori</th>
                                        <th class="text-right">Ukuran</th>
                                        {{-- <th class="text-right">Stok</th> --}}
                                        {{-- <th class="text-right">Harga Satuan</th> --}}
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_selects as $data)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="rounded-lg"
                                                        style="background-position: center;background-size: cover; background-image: url({{ $data->furniture->furniture_images[0]->url }}); width: 32px; height: 32px" />
                                                </div>
                                                <div class="ml-2">
                                                    {{ $data->furniture->name }}
                                                    <div class="text-sm text-gray">{{ $data->furniture->sku }}</div>
                                                </div>
                                            </td>
                                            <td class="text-right">{{ $data->furniture->created_at->format('d/m/Y') }}</td>
                                            <td class="text-right">{{ $data->furniture->category->name }}</td>
                                            <td class="text-right">{{ $data->furniture->size }}</td>
                                            {{-- <td class="text-right">{{ $data->furniture->stock }}</td> --}}
                                            {{-- <td class="text-right">${{ number_format($data->furniture->price, 2) }}</td> --}}
                                            <td class="project-actions text-right">
                                                <form
                                                    action="/order_selects/{{ $data->id }}{{ str_replace('/order_selects', '', request()->getRequestUri()) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Batal
                                                        pilih</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <form action="/order_selects">
                                <input type="hidden" name="show" value="{{ request('show') ?? 5 }}">
                                <input type="hidden" name="category" value="{{ request('category') ?? '' }}">
                                <input type="hidden" name="material1" value="{{ request('material1') ?? '' }}">
                                <input type="hidden" name="material2" value="{{ request('material2') ?? '' }}">
                                <input type="hidden" name="material3" value="{{ request('material3') ?? '' }}">
                                <input type="hidden" name="material4" value="{{ request('material4') ?? '' }}">
                                <input type="hidden" name="orderBy" value="{{ request('orderBy') ?? '' }}">

                                <div class="card-title d-flex">
                                    <div class="input-group input-group-sm" style="width: 300px">
                                        <input type="text" name="search" class="form-control float-right"
                                            placeholder="Cari nama/sku" value="{{ request('search') }}"
                                            autocomplete="off" />

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-info">
                                                <i class="fas fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>

                                    <a href="#" class="btn btn-sm btn-warning ml-1" data-toggle="modal"
                                        data-target="#all-filter">All
                                        filter</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="bg-dark">
                                        {{-- <th colspan="2"></th> --}}
                                        <th>Nama</th>
                                        <th class="text-right">Tanggal ditambahkan</th>
                                        <th class="text-right">Kategori</th>
                                        <th class="text-right">Ukuran</th>
                                        {{-- <th class="text-right">Stok</th> --}}
                                        {{-- <th class="text-right">Harga Satuan</th> --}}
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($furnitures as $data)
                                        @continue($data->order_select)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="rounded-lg"
                                                        style="background-position: center;background-size: cover; background-image: url({{ $data->furniture_images[0]->url }}); width: 32px; height: 32px" />
                                                </div>
                                                <div class="ml-2">
                                                    {{ $data->name }}
                                                    <div class="text-sm text-gray">{{ $data->sku }}</div>
                                                </div>
                                            </td>
                                            <td class="text-right">{{ $data->created_at->format('d/m/Y') }}</td>
                                            <td class="text-right">{{ $data->category->name }}</td>
                                            <td class="text-right">{{ $data->size }}</td>
                                            {{-- <td class="text-right">{{ $data->stock }}</td> --}}
                                            {{-- <td class="text-right">${{ number_format($data->price, 2) }}</td> --}}
                                            <td class="project-actions text-right">
                                                <form
                                                    action="/order_selects{{ str_replace('/order_selects', '', request()->getRequestUri()) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="furniture_id" value="{{ $data->id }}">
                                                    <button type="submit" class="btn btn-info btn-sm">Pilih</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            {{ $furnitures->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>

    <div class="modal fade" id="all-filter">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="/order_selects" method="get">
                    <input type="hidden" name="search" value="{{ request('search') ?? '' }}">
                    <div class="modal-body mt-5">
                        <div class="row mb-2">
                            <div class="col-3">Show</div>
                            <div class="col-9">
                                <input type="number" min="1" class="form-control form-control-sm" name="show"
                                    value="{{ request('show') ?? 5 }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">Category</div>
                            <div class="col-9">
                                <select name="category" class="form-control form-control-sm">
                                    <option value="">Semua</option>
                                    @foreach ($categories as $data)
                                        <option value="{{ $data->name }}"
                                            {{ request('category') == $data->name ? 'selected' : '' }}>
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">Material 1</div>
                            <div class="col-9">
                                <select name="material1" class="form-control form-control-sm">
                                    <option value="">Semua</option>
                                    @foreach ($material1s as $data)
                                        <option value="{{ $data->name }}"
                                            {{ request('material1') == $data->name ? 'selected' : '' }}>
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">Material 2</div>
                            <div class="col-9">
                                <select name="material2s" class="form-control form-control-sm">
                                    <option value="">Semua</option>
                                    @foreach ($material2s as $data)
                                        <option value="{{ $data->name }}"
                                            {{ request('material2s') == $data->name ? 'selected' : '' }}>
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">Material 3</div>
                            <div class="col-9">
                                <select name="material3s" class="form-control form-control-sm">
                                    <option value="">Semua</option>
                                    @foreach ($material3s as $data)
                                        <option value="{{ $data->name }}"
                                            {{ request('material3s') == $data->name ? 'selected' : '' }}>
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">Material 4</div>
                            <div class="col-9">
                                <select name="material4s" class="form-control form-control-sm">
                                    <option value="">Semua</option>
                                    @foreach ($material4s as $data)
                                        <option value="{{ $data->name }}"
                                            {{ request('material4s') == $data->name ? 'selected' : '' }}>
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">order by</div>
                            <div class="col-9">
                                <select name="orderBy" class="form-control form-control-sm">
                                    <option value="nameAsc" {{ request('orderBy') == 'nameAsc' ? 'selected' : '' }}>
                                        A - Z
                                    </option>
                                    <option value="nameDesc" {{ request('orderBy') == 'nameDesc' ? 'selected' : '' }}>
                                        Z - A
                                    </option>
                                    <option value="newest" {{ request('orderBy') == 'newest' ? 'selected' : '' }}>
                                        Newest
                                    </option>
                                    <option value="oldest" {{ request('orderBy') == 'oldest' ? 'selected' : '' }}>
                                        Oldest
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info btn-sm">Filter</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
