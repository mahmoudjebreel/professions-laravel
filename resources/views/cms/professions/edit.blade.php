@extends('cms.parent')

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('title','Professions')
@section('page-title','Edit Profession')
@section('small-title','Professions')

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
                        <h3 class="card-title">Edit Profession</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create_form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Speciality</label>
                                <select class="form-control specialities" id="specialities" style="width: 100%;">
                                    @foreach ($specialities as $speciality)
                                    <option value="{{$speciality->id}}" @if($speciality->id ==
                                        $profession->speciality_id) selected @endif>
                                        {{$speciality->title_en}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title_en">Title En</label>
                                <input type="text" name="title_en" class="form-control" id="title_en"
                                    placeholder="Enter english title" value="{{$profession->title_en}}">
                            </div>
                            <div class="form-group">
                                <label for="title_ar">Title Ar</label>
                                <input type="text" name="title_ar" class="form-control" id="title_ar"
                                    placeholder="Enter arabic title" value="{{$profession->title_ar}}">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="active" class="form-check-input" id="active">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate({{$profession->id}})"
                                class="btn btn-primary">Update</button>
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
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    //Initialize Select2 Elements
    $('.specialities').select2({
        theme: 'bootstrap4'
    })

    function performUpdate(id){
        let data = {
            title_en: document.getElementById('title_en').value,
            title_ar: document.getElementById('title_ar').value,
            speciality_id: document.getElementById('specialities').value,
        } 
        let redirectUrl = '/cms/admin/professions'
        update('/cms/admin/professions/'+id,data,redirectUrl);
    }
</script>
@endsection