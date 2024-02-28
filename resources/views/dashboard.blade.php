@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Furnitures</span>
                            <span class="info-box-number">{{ count($furnitures) }}</span>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-lg-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Suppliers</span>
                            <span class="info-box-number">{{ count($suppliers) }}</span>
                        </div>
                    </div>
                </div><!-- /.col -->
                <div class="col-lg-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">P.O</span>
                            <span class="info-box-number">{{ count($orders) }}</span>
                        </div>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
