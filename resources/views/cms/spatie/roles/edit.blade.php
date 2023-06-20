@extends('cms.parent')

@section('style')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
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
                    <form id="create_form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Speciality</label>
                                <select class="form-control guards" style="width: 100%;" id="guards">
                                    <option value="web" @if($role->guard_name == 'web') selected @endif>User</option>
                                    <option value="professional" @if($role->guard_name == 'professional') selected
                                        @endif>Professional</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="Name" class="form-control" id="name"
                                    placeholder="Enter role name" value="{{$role->name}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate({{$role->id}})"
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
<!-- Select2 -->
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    //Initialize Select2 Elements
    $('.specialities').select2({
        theme: 'bootstrap4'
    })
    function performUpdate(id){
        let data = {
            name: document.getElementById('name').value,
            guard_name: document.getElementById('guards').value
        };

        let redirectUrl = '/cms/admin/roles'
        update('/cms/admin/roles/'+id,data,redirectUrl);
    }
</script>
@endsection