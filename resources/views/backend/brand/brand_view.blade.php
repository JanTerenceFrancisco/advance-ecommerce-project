@extends('admin.admin_master')
@section('admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="container-full">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Brands</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Brand Name</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $item)
                                            <tr class="text-center">
                                                <td>{{ $item->brand_name }}</td>
                                                <td>
                                                    <img src="{{ asset($item->brand_image) }}"
                                                        style="width: 70px; height:70px;">
                                                </td>
                                                <td>
                                                    <a href="{{ route('brand.edit', $item->id) }}" class="btn btn-info">
                                                        <i class="fa fa-pencil" title="Edit Data"></i></a>
                                                    <a href="{{ route('brand.delete', $item->id) }}" id="delete"
                                                        class="btn btn-danger" title="Delete Data">
                                                        <i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->

                {{-- Add Brands --}}

                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Brand</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <h5> Brand Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="brand_name" class="form-control">
                                            @error('brand_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5> Brand Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="brand_image" class="form-control">
                                            @error('brand_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Brand">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>

            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection
