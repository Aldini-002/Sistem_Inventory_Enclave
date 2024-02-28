@extends('layouts.table') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Order</h1>
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
                            <form action="/orders">
                                <input type="hidden" name="show" value="{{ request('show') ?? 5 }}">
                                <input type="hidden" name="status" value="{{ request('status') ?? '' }}">
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

                            <div class="card-tools">
                                <a href="/order_selects" class="btn btn-sm btn-success">Add order</a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="bg-dark">
                                        <th>Pemasok</th>
                                        <th class="text-right">Pemesan</th>
                                        <th class="text-right">Tanggal dipesan</th>
                                        <th class="text-right">Maksimal pengiriman</th>
                                        <th class="text-right">Status</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $data)
                                        <tr class="bg-light">
                                            <td>{{ $data->supplier->name }}</td>
                                            <td class="text-right">{{ $data->orderer }}</td>
                                            <td class="text-right">{{ $data->created_at->format('d/m/Y') }}</td>
                                            <td class="text-right">{{ date('d/m/Y', strtotime($data->deadline)) }}</td>
                                            <td class="text-right"><span
                                                    class="btn btn-xs btn-{{ $data->status == 'Finished' ? 'success' : '' }}{{ $data->status == 'in Progress' ? 'warning' : '' }}{{ $data->status == 'Cancelled' ? 'danger' : '' }} font-weight-normal">{{ $data->status }}</span>
                                            </td>
                                            <td class="project-actions text-right">
                                                <button class="btn btn-sm btn-dark" data-toggle="modal"
                                                    data-target="#status-{{ $data->id }}">Ubah status</button>
                                                <a class="btn btn-info btn-sm"
                                                    href="/orders/{{ $data->id }}{{ str_replace('/orders', '', request()->getRequestUri()) }}">
                                                    Lihat
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="bg-light">
                                            <th class="text-sm" colspan="3">Furniture</th>
                                            <th class="text-right text-sm">Jumlah dipesan</th>
                                            <th class="text-right text-sm"><span
                                                    class="text-success text-xs text-bold">$</span>Harga satuan</th>
                                            <th class="text-right text-sm"><span
                                                    class="text-success text-xs text-bold">$</span>Total</th>
                                        </tr>
                                        @foreach ($data->order_furnitures as $data)
                                            <tr>
                                                <td colspan="3">
                                                    <div class="d-flex">
                                                        <div class="rounded-lg"
                                                            style="background-position: center;background-size: cover; background-image: url({{ $data->furniture->furniture_images[0]->url }}); width: 32px; height: 32px" />
                                                    </div>
                                                    <div class="ml-2">
                                                        {{ $data->furniture->name }}
                                                        <div class="text-sm text-gray">{{ $data->furniture->sku }}</div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $data->qty }}</td>
                                                <td class="text-right"><span
                                                        class="text-success text-bold">$</span>{{ $data->price }}</td>
                                                <td class="text-right"><span
                                                        class="text-success text-bold">$</span>{{ $data->total }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            {{ $orders->links() }}
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
                <form action="/orders" method="get">
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
                            <div class="col-3">Status</div>
                            <div class="col-9">
                                <select name="status" class="form-control form-control-sm">
                                    <option value="">
                                        Semua
                                    </option>
                                    <option value="finished" {{ request('status') == 'finished' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        Batal
                                    </option>
                                    <option value="in Progress"
                                        {{ request('status') == 'in Progress' ? 'selected' : '' }}>
                                        Proses
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">order by</div>
                            <div class="col-9">
                                <select name="orderBy" class="form-control form-control-sm">
                                    {{-- <option value="nameAsc" {{ request('orderBy') == 'nameAsc' ? 'selected' : '' }}>
                                        A - Z
                                    </option>
                                    <option value="nameDesc" {{ request('orderBy') == 'nameDesc' ? 'selected' : '' }}>
                                        Z - A
                                    </option> --}}
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

    @foreach ($orders as $data)
        <div class="modal fade" id="status-{{ $data->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form action="/orders/{{ $data->id }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body mt-5">
                            {{-- <div>
                                <button class="btn btn-sm btn-success">selesai</button>
                                <button class="btn btn-sm btn-danger">batal</button>
                            </div> --}}
                            <div class="row mb-2">
                                <div class="col-3">Status</div>
                                <div class="col-9">
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="finished" {{ $data->status == 'finished' ? 'selected' : '' }}>
                                            Selesai
                                        </option>
                                        <option value="cancelled" {{ $data->status == 'cancelled' ? 'selected' : '' }}>
                                            Batal
                                        </option>
                                        <option value="in Progress"
                                            {{ $data->status == 'in Progress' ? 'selected' : '' }}>
                                            Proses
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info btn-sm">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection
