@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Furniture</h1>
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
            <form
                action="/furnitures/{{ $furniture->id }}{{ str_replace('/furnitures/' . $furniture->id . '/edit', '', request()->getRequestUri()) }}"
                method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="bg-dark card-header">
                        <h3 class="card-title">Form Edit Furniture</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama furniture<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="nama" value="{{ $furniture->name }}" autofocus autocomplete="off" required>
                                @error('name')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="stock" class="col-sm-2 col-form-label">Stock furniture</label>
                            <div class="col-sm-10">
                                <input type="text" name="stock"
                                    class="form-control @error('stock') is-invalid @enderror" id="stock"
                                    placeholder="stock" value="{{ $furniture->stock }}" autofocus autocomplete="off"
                                    required>
                                @error('stock')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <!-- form start -->
                    <div class="card-body">

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ukuran<span class="font-weight-light">(cm)</span><span
                                    class="text-danger">*</span></label>
                            <div class="col-sm pb-2">
                                <input type="number" name="length"
                                    class="form-control @error('length') is-invalid @enderror" id="length"
                                    placeholder="panjang" value="{{ $furniture->length }}"autocomplete="off" required
                                    min="0">
                                @error('length')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm pb-2">
                                <input type="number" name="width"
                                    class="form-control @error('width') is-invalid @enderror" id="width"
                                    placeholder="lebar" value="{{ $furniture->width }}"autocomplete="off" required
                                    min="0">
                                @error('width')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm">
                                <input type="number" name="height"
                                    class="form-control @error('height') is-invalid @enderror" id="height"
                                    placeholder="tinggi" value="{{ $furniture->height }}"autocomplete="off" required
                                    min="0">
                                @error('height')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Harga satuan <span
                                    class="font-weight-bold text-success">$</span></label>
                            <div class="col-sm-10">
                                <input type="number" name="price"
                                    class="form-control @error('price') is-invalid @enderror" id="price"
                                    placeholder="harga satuan" value="{{ $furniture->price }}" step="0.01"
                                    min="0" max="999999" autocomplete="off">
                                @error('price')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/furnitures/{{ $furniture->id . str_replace('/furnitures/' . $furniture->id . '/edit', '', request()->getRequestUri()) }}"
                                class="btn btn-sm btn-danger mr-1">Batal</a>
                            <button type="submit" class="btn btn-sm btn-info">Simpan Perubahan</button>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script>
        const imageInput = document.getElementById('image');
        const imagePreviews = document.getElementById('imagePreviews');

        imageInput.addEventListener('change', function() {
            imagePreviews.innerHTML = '';

            for (const file of this.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.height = '150px';
                    img.classList.add('rounded', 'shadow-sm', 'border', 'm-1')
                    imagePreviews.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
