@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Furniture</h1>
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
            <form action="/furnitures" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="card">
                    <div class="bg-dark card-header">
                        <h3 class="card-title">Form Tambah Furniture</h3>
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
                                    placeholder="nama" value="{{ old('name') }}" autofocus autocomplete="off" required>
                                @error('name')
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
                            <label for="category_id" class="col-sm-2 col-form-label">Kategori<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="category_id" id="category_id"
                                    style="width: 100%;" required>
                                    @foreach ($categories as $data)
                                        <option value="{{ $data->id }}"
                                            {{ old('category_id') == $data->id ? 'selected' : '' }}>{{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="material1_id" class="col-sm-2 col-form-label">Materail 1</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="material1_id" id="material1_id"
                                    style="width: 100%;" required>
                                    @foreach ($material1s as $data)
                                        <option value="{{ $data->id }}"
                                            {{ old('material1_id') == $data->id ? 'selected' : '' }}>{{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('material1_id')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="material2_id" class="col-sm-2 col-form-label">Materail 2</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="material2_id" id="material2_id"
                                    style="width: 100%;" required>
                                    @foreach ($material2s as $data)
                                        <option value="{{ $data->id }}"
                                            {{ old('material2_id') == $data->id ? 'selected' : '' }}>{{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('material2_id')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="material3_id" class="col-sm-2 col-form-label">Materail 3</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="material3_id" id="material3_id"
                                    style="width: 100%;" required>
                                    @foreach ($material3s as $data)
                                        <option value="{{ $data->id }}"
                                            {{ old('material3_id') == $data->id ? 'selected' : '' }}>{{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('material3_id')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="material4_id" class="col-sm-2 col-form-label">Materail 4</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="material4_id" id="material4_id"
                                    style="width: 100%;" required>
                                    @foreach ($material4s as $data)
                                        <option value="{{ $data->id }}"
                                            {{ old('material4_id') == $data->id ? 'selected' : '' }}>{{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('material4_id')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ukuran<span
                                    class="font-weight-light text-gray font-italic">(
                                    cm)</span><span class="text-danger">*</span></label>
                            <div class="col-sm pb-2">
                                <input type="number" name="length"
                                    class="form-control @error('length') is-invalid @enderror" id="length"
                                    placeholder="panjang" value="{{ old('length') }}"autocomplete="off" required
                                    min="0">
                                @error('length')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm pb-2">
                                <input type="number" name="width"
                                    class="form-control @error('width') is-invalid @enderror" id="width"
                                    placeholder="lebar" value="{{ old('width') }}"autocomplete="off" required
                                    min="0">
                                @error('width')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-sm">
                                <input type="number" name="height"
                                    class="form-control @error('height') is-invalid @enderror" id="height"
                                    placeholder="tinggi" value="{{ old('height') }}"autocomplete="off" required
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
                                    placeholder="harga satuan" value="{{ old('price') }}" step="0.01"
                                    min="0" max="999999" autocomplete="off">
                                @error('price')
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
                            {{-- <div class="custom-file"> --}}
                            <label for="image" class="col-sm-2 col-form-label">Pilih gambar<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" name="image[]" id="image" multiple required>
                                @error('image')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- </div> --}}
                        </div>
                        <div class="form-group row">
                            <div id="imagePreviews" class="d-flex justify-content-start flex-wrap">

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/furnitures{{ str_replace('/furnitures/create', '', request()->getRequestUri()) }}"
                                class="btn btn-sm btn-danger mr-1">Batal</a>
                            <button type="submit" class="btn btn-sm btn-info">Tambah</button>
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
