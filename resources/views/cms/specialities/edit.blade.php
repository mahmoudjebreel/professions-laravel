@extends('cms.parent')

@section('style')

@endsection

@section('title','Title')
@section('page-title','Title')
@section('small-title','Title')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{route('specialities.update',$speciality->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                {{session('message')}}
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="title_en">Title En</label>
                                <input type="text" name="title_en" class="form-control" id="title_en"
                                    placeholder="Enter english title" value="{{$speciality->title_en}}">
                            </div>
                            <div class="form-group">
                                <label for="title_ar">Title Ar</label>
                                <input type="text" name="title_ar" class="form-control" id="title_ar"
                                    placeholder="Enter arabic title" value="{{$speciality->title_ar}}">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="active" class="form-check-input" id="active"
                                    @if($speciality->active) checked @endif>
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Store</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

@section('scripts')

@endsection