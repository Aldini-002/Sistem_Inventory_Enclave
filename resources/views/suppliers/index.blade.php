@extends('layouts.table') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar supplier</h1>
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
                            <form action="/suppliers">
                                <input type="hidden" name="show" value="{{ request('show') ?? 5 }}">
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
                                <a href="/suppliers/create{{ str_replace('/suppliers', '', request()->getRequestUri()) }}"
                                    class="btn btn-sm btn-success">Add supplier</a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="bg-dark">
                                        {{-- <th colspan="2"></th> --}}
                                        <th>Nama</th>
                                        <th class="text-right">PO Aktif</th>
                                        <th class="text-right">Telepon</th>
                                        <th class="text-right">Perusahaan</th>
                                        <th class="text-right">Alamat</th>
                                        {{-- <th class="text-right">Keahlian</th> --}}
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $data)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td class="text-right">
                                                {{ count($data->orders) ? count($data->orders) : 'Tidak ada' }} <a
                                                    href="/orders?search={{ $data->phone }}"
                                                    class="btn btn-xs btn-info {{ !count($data->orders) ? 'd-none' : '' }}">Lihat</a>
                                            </td>
                                            <td class="text-right">{{ $data->phone }}</td>
                                            <td class="text-right">{{ $data->company }}</td>
                                            <td class="text-right">{{ $data->address }}</td>
                                            {{-- <td class="text-right">{{ $data->skill }}</td> --}}
                                            <td class="project-actions text-right">
                                                <a class="btn btn-info btn-sm"
                                                    href="/suppliers/{{ $data->id }}{{ str_replace('/suppliers', '', request()->getRequestUri()) }}">
                                                    Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            {{ $suppliers->links() }}
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
                <form action="/suppliers" method="get">
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
