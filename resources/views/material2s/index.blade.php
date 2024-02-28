@extends('layouts.table') @section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Material 1</h1>
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
                            <form action="/material2s">
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
                                <a href="/material2s/create{{ str_replace('/material2s', '', request()->getRequestUri()) }}"
                                    class="btn btn-sm btn-success">Add material</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr class="bg-dark">
                                        <th>Nama</th>
                                        <th class="text-right">SKU</th>
                                        <th class="text-right">Jumlah furniture</th>
                                        <th class="text-right">Tanggal ditambahkan</th>
                                        <th class="text-right"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($material2s as $data)
                                        @continue($data['sku'] == 0)
                                        <tr>
                                            <td>{{ $data->name }}</td>
                                            <td class="text-right">{{ $data->sku }}</td>
                                            <td class="text-right">{{ count($data->furnitures) }}<a
                                                    href="/furnitures?material2={{ $data->name }}"
                                                    class="btn btn-xs btn-info {{ !count($data->furnitures) ? 'd-none' : '' }}">Lihat
                                                    semua</a></td>
                                            <td class="text-right">{{ $data->created_at->format('d/m/Y') }}</td>
                                            <td class="project-actions text-right">
                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-info btn-sm mr-1"
                                                        href="/material2s/{{ $data->id }}/edit{{ str_replace('/material2s', '', request()->getRequestUri()) }}">
                                                        <i class="fas fa-pencil-alt"> </i>
                                                        Ubah
                                                    </a>
                                                    <form
                                                        action="/material2s/{{ $data->id . str_replace('/material2s', '', request()->getRequestUri()) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button
                                                            onclick="return confirm('PERHATIAN!!!\nSemua furniture yang menggunakan material 1 {{ $data->name }} juga akan terhapus.')"
                                                            type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            {{ $material2s->links() }}
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
                <form action="/material2s" method="get">
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
