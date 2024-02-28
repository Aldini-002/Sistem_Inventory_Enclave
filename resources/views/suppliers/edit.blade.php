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
            <form
                action="/suppliers/{{ $supplier->id }}{{ str_replace('/suppliers/' . $supplier->id . '/edit', '', request()->getRequestUri()) }}"
                method="post" class="form-horizontal">
                @csrf
                @method('put')
                <div class="card">
                    <div class="bg-dark card-header">
                        <h3 class="card-title">Form Edit Supplier</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Nama supplier<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="nama" value="{{ $supplier->name }}" autofocus autocomplete="off" required>
                                @error('name')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Telepon<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="number" min="0" name="phone"
                                    class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="nama" value="{{ $supplier->phone }}" autofocus autocomplete="off" required>
                                @error('phone')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company" class="col-sm-2 col-form-label">Perusahaan</label>
                            <div class="col-sm-10">
                                <input type="text" name="company"
                                    class="form-control @error('company') is-invalid @enderror" id="company"
                                    placeholder="company" value="{{ $supplier->company }}" autofocus autocomplete="off"
                                    required>
                                @error('company')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" name="address"
                                    class="form-control @error('address') is-invalid @enderror" id="address"
                                    placeholder="address" value="{{ $supplier->address }}" autofocus autocomplete="off"
                                    required>
                                @error('address')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="skill" class="col-sm-2 col-form-label">Keahlian</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('skill') is-invalid @enderror" rows="3" name="skill" id="skill"
                                    placeholder="skill...">{{ $supplier->skill }}</textarea>
                                @error('skill')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <a href="/suppliers/{{ $supplier->id . str_replace('/suppliers/' . $supplier->id . '/edit', '', request()->getRequestUri()) }}"
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
