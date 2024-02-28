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
            <div class="form-horizontal">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Gambar furniture</h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            @foreach ($furniture->furniture_images as $data)
                                <a href="#" class="my_image" data-toggle="modal"
                                    data-target="#delete-image{{ $data->id }}">
                                    <img src="{{ $data->url }}" alt="..."
                                        class="carousel-image rounded shadow-sm m-1 border border-gray"
                                        style="height:100px">
                                </a>
                            @endforeach
                        </div>
                        <form action="/images" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="furniture_id" value="{{ $furniture->id }}">
                            <div class="form-group row mt-3">
                                <div class="col-sm-10">
                                    <button class="btn btn-info btn-sm" id="add-image">Tambah gambar</button>
                                    <input type="file" name="image[]" id="image" multiple required class="d-none">
                                    @error('image')
                                        <small class="text-danger font-italic">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div id="imagePreviews" class="d-flex justify-content-start flex-wrap">

                                </div>
                            </div>
                            <button type="reset" id="reset" class="btn btn-sm btn-dark d-none">Batal</button>
                            <button type="submit" id="submit" class="btn btn-sm btn-info d-none">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Detail Furniture</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">SKU</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->sku }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-capitalize">{{ $furniture->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="stock" class="col-sm-2 col-form-label">Stock</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray text-capitalize">{{ $furniture->stock }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="btn btn-xs btn-outline-dark  mr-1">{{ $furniture->category->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Material 1</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="btn btn-xs btn-outline-dark  mr-1">{{ $furniture->material1->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Material 2</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="btn btn-xs btn-outline-dark  mr-1">{{ $furniture->material2->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Material 3</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="btn btn-xs btn-outline-dark  mr-1">{{ $furniture->material3->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Material 4</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="btn btn-xs btn-outline-dark  mr-1">{{ $furniture->material4->name }}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Ukuran</label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray">{{ $furniture->size }}</div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card">
                <!-- form start -->
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Price <span
                                class="font-weight-bold text-success">$</span></label>
                        <div class="col-sm-10 d-flex align-items-center">
                            <div class="text-gray"><span
                                    class="font-weight-bold text-success">$</span>{{ number_format($furniture->price, 2) }}
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/furnitures{{ str_replace('/furnitures/' . $furniture->id, '', request()->getRequestUri()) }}"
                            class="btn btn-sm btn-dark mr-1">Kembali</a>
                        <a href="/furnitures/{{ $furniture->id }}/edit{{ str_replace('/furnitures/' . $furniture->id, '', request()->getRequestUri()) }}"
                            class="btn btn-sm btn-info mr-1">Ubah Detail</a>
                        <form
                            action="/furnitures/{{ $furniture->id . str_replace('/furnitures/' . $furniture->id, '', request()->getRequestUri()) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button
                                onclick="return confirm('PERHATIAN!!!\nFurniture {{ $furniture->name }}({{ $furniture->sku }}) akan dihapus secara permanen!')"
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

    <script>
        const imageInput = document.getElementById('image');
        const imagePreviews = document.getElementById('imagePreviews');
        const reset = document.getElementById('reset');
        const submit = document.getElementById('submit');
        const add_image = document.getElementById('add-image');
        const image = document.getElementById('image');

        add_image.addEventListener('click', function() {
            image.click();
        })

        reset.addEventListener('click', function() {
            imagePreviews.innerHTML = '';
            reset.classList.toggle('d-none')
            submit.classList.toggle('d-none')
            add_image.classList.toggle('d-none')
        })

        imageInput.addEventListener('change', function() {
            imagePreviews.innerHTML = '';

            for (const file of this.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.height = '100px';
                    img.classList.add('rounded', 'shadow-sm', 'border', 'm-1')
                    imagePreviews.appendChild(img);
                };
                reader.readAsDataURL(file);
            }

            reset.classList.toggle('d-none')
            submit.classList.toggle('d-none')
            add_image.classList.toggle('d-none')
        });
    </script>

    @foreach ($furniture->furniture_images as $data)
        <div class="modal fade" id="delete-image{{ $data->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center mt-5">
                        <img src="{{ $data->url }}" alt="..."
                            class="carousel-image rounded shadow-sm m-1 border border-danger" style="height:200px">
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Batal</button>
                        <form action="/images/{{ $data->id }}" method="post">
                            @csrf
                            @method('delete')
                            <button onclick="return confirm('Hapus gambar!')" type="submit"
                                class="btn btn-sm btn-danger">Hapus
                                gambar</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    @endforeach
@endsection
