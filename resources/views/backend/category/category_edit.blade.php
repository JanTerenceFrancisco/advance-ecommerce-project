@extends('admin.admin_master')
@section('admin')
    <div class="col-12">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Category</h3>
                <a class="btn btn-danger float-right" href="{{ route('all.category') }}">Back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <form method="POST" action="{{ route('category.update', $category->id) }}">
                        @csrf

                        <input type="hidden" name="id" value="{{ $category->id }}">

                        <div class="form-group">
                            <h5> Category Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="category_name" value="{{ $category->category_name }}"
                                    class="form-control">
                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <h5> Category Icon <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="category_icon" value="{{ $category->category_icon }}"
                                    class="form-control">
                                @error('category_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
@endsection
