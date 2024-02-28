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

                        {{-- <div class="form-group row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control @error('description') is-invalid @enderror" rows="3" name="description"
                                    id="description" placeholder="deskripsi...">{{ $furniture->description }}</textarea>
                                @error('description')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div> --}}

                        <div class="form-group row">
                            <label for="certification" class="col-sm-2 col-form-label">Sertifikat</label>
                            <div class="col-sm-10">
                                <input type="text" name="certification"
                                    class="form-control @error('certification') is-invalid @enderror" id="certification"
                                    placeholder="sertifikat"
                                    value="{{ $furniture->certification ?? 'V-Legal' }}"autocomplete="off">
                                @error('certification')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qty_per_month" class="col-sm-2 col-form-label">Qty/Month</label>
                            <div class="col-sm-10">
                                <input type="number" name="qty_per_month"
                                    class="form-control @error('qty_per_month') is-invalid @enderror" id="qty_per_month"
                                    placeholder="qty/month" value="{{ $furniture->qty_per_month }}"autocomplete="off"
                                    min="0">
                                @error('qty_per_month')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="moq" class="col-sm-2 col-form-label">MOQ</label>
                            <div class="col-sm-10">
                                <input type="number" name="moq" class="form-control @error('moq') is-invalid @enderror"
                                    id="moq" placeholder="moq" value="{{ $furniture->moq }}"autocomplete="off"
                                    min="0">
                                @error('moq')
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
                            <label for="keyword" class="col-sm-2 col-form-label">Kata kunci</label>
                            <div class="col-sm-10">
                                <input type="text" name="keyword"
                                    class="form-control @error('keyword') is-invalid @enderror" id="keyword"
                                    placeholder="kata kunci" value="{{ $furniture->keyword }}"autocomplete="off">
                                @error('keyword')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ukuran<span class="text-danger">*</span></label>
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

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fitur</label>
                            <div class="col-sm pb-2 d-flex align-items-center flex-wrap">
                                <div class="icheck-primary mr-5">
                                    <input type="checkbox" name="convertible" id="convertible" value="1"
                                        {{ $furniture->convertible ? 'checked' : '' }}>
                                    <label for="convertible">Convertible</label>
                                </div>
                                <div class="icheck-primary mr-5">
                                    <input type="checkbox" name="adjustable" id="adjustable" value="1"
                                        {{ $furniture->adjustable ? 'checked' : '' }}>
                                    <label for="adjustable">Adjustable</label>
                                </div>
                                <div class="icheck-primary mr-5">
                                    <input type="checkbox" name="extendable" id="extendable" value="1"
                                        {{ $furniture->extendable ? 'checked' : '' }}>
                                    <label for="extendable">Extendable</label>
                                </div>
                                <div class="icheck-primary mr-5">
                                    <input type="checkbox" name="Folded" id="Folded" value="1"
                                        {{ $furniture->Folded ? 'checked' : '' }}>
                                    <label for="Folded">Folded</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label">Harga satuan</label>
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

                        <div class="form-group row">
                            <label for="payment_options" class="col-sm-2 col-form-label">Opsi pembayaran</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="payment_options" id="payment_options"
                                    style="width: 100%;">
                                    <option value="dp" {{ $furniture->payment_options == 'dp' ? 'selected' : '' }}>DP
                                    </option>
                                    <option value="full" {{ $furniture->payment_options == 'full' ? 'selected' : '' }}>
                                        Full
                                        Payment
                                    </option>
                                </select>
                                @error('payment_options')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_terms" class="col-sm-2 col-form-label">Aturan pembayaran</label>
                            <div class="col-sm-10">
                                <input type="text" name="payment_terms"
                                    class="form-control @error('payment_terms') is-invalid @enderror" id="payment_terms"
                                    placeholder="aturan pembayaran"
                                    value="{{ $furniture->payment_terms ?? 'DP 50%' }}"autocomplete="off">
                                @error('payment_terms')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_options" class="col-sm-2 col-form-label">Opsi pengiriman</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="delivery_options" id="delivery_options"
                                    style="width: 100%;">
                                    <option value="fob" {{ $furniture->delivery_options == 'fob' ? 'selected' : '' }}>
                                        FOB
                                    </option>
                                    <option value="exw" {{ $furniture->delivery_options == 'exw' ? 'selected' : '' }}>
                                        EX
                                        WORK
                                    </option>
                                </select>
                                @error('delivery_options')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_time" class="col-sm-2 col-form-label">Waktu pengririman</label>
                            <div class="col-sm-10">
                                <input type="text" name="delivery_time"
                                    class="form-control @error('delivery_time') is-invalid @enderror" id="delivery_time"
                                    placeholder="waktu pengiriman"
                                    value="{{ $furniture->delivery_time }}"autocomplete="off">
                                @error('delivery_time')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lead_time" class="col-sm-2 col-form-label">Waktu pengerjaan</label>
                            <div class="col-sm-10">
                                <input type="text" name="lead_time"
                                    class="form-control @error('lead_time') is-invalid @enderror" id="lead_time"
                                    placeholder="waktu pengerjaan" value="{{ $furniture->lead_time }}"autocomplete="off">
                                @error('lead_time')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="package" class="col-sm-2 col-form-label">Packing</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="package" id="package" style="width: 100%;">
                                    <option value="box" {{ $furniture->package == 'box' ? 'selected' : '' }}>BOX
                                    </option>
                                    <option value="corrugated paper"
                                        {{ $furniture->package == 'corrugated paper' ? 'selected' : '' }}>Corrugated Paper
                                    </option>
                                </select>
                                @error('package')
                                    <small class="text-danger font-italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="port" class="col-sm-2 col-form-label">Port</label>
                            <div class="col-sm-10">
                                <select class="form-control select2" name="port" id="port" style="width: 100%;">
                                    <option value=' Tanjung Emas'
                                        {{ $furniture->port == 'Tanjung Emas' ? 'selected' : '' }}>
                                        Tanjung Emas</option>
                                    <option value='Franco port' {{ $furniture->port == 'Franco port' ? 'selected' : '' }}>
                                        Franco port</option>
                                </select>
                                @error('port')
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
