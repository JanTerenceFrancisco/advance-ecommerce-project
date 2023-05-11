@extends('admin.admin_master')
@section('admin')
    <div class="col-12">

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Sub Category</h3>
                <a class="btn btn-danger float-right" href="{{ route('all.subcategory') }}">Back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <form method="POST" action="{{ route('subcategory.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $subcategory->id }}">
                        <div class="form-group">
                            <h5>Category Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" class="form-control">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"{{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <h5> Sub Category Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subcategory_name" value="{{ $subcategory->subcategory_name }}"
                                    class="form-control">
                                @error('subcategory_name')
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
