t @extends('cms.parent')

@section('style')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('cms/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('title','Admins')
@section('page-title','Create Admin')
@section('small-title','Admins')

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
                        <h3 class="card-title">Create Admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>City</label>
                                <select class="form-control cities" id="cities" style="width: 100%;">
                                    @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name"
                                    placeholder="Enter first name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name"
                                    placeholder="Enter last name">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Mobile</label>
                                <input type="tel" name="mobile" class="form-control" id="mobile"
                                    placeholder="Enter mobile">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Birth Date</label>
                                <input id="birth_date" type="text" class="form-control" placeholder="Enter birth date">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Gender</label>
                                <!-- radio -->
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="male" name="gender" checked>
                                        <label for="male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="female" name="gender">
                                        <label for="female">
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
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
<script src="{{ asset('cms/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    //Initialize Select2 Elements
    $('.cities').select2({
        theme: 'bootstrap4'
    })

    $('#birth_date').datepicker({
        orientation: "auto left",
        maxViewMode: 2,
        todayBtn: "linked",
        clearBtn: true,
        language: "ar",
        daysOfWeekDisabled: "5",
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd"
        // startDate: "today",
    });

    function performStore(){
        let data = {
            city_id: document.getElementById('cities').value,
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            mobile: document.getElementById('mobile').value,
            email: document.getElementById('email').value,
            birth_date: document.getElementById('birth_date').value,
            gender: document.getElementById('male').checked ? "M" : "F",
        } 
        store('/cms/admin/customers',data);
    }
</script>
@endsection