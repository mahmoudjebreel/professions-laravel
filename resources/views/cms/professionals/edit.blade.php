t @extends('cms.parent')

@section('style')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('cms/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('title','Professionals')
@section('page-title','Edit Professional')
@section('small-title','Professionals')

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
                        <h3 class="card-title">Edit Professional</h3>
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
                                    <option value="{{$city->id}}" @if($city->id ==
                                        $professional->user->city_id) selected @endif>{{$city->name_en}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Profession</label>
                                <select class="form-control professions" id="professions" style="width: 100%;">
                                    @foreach ($professions as $profession)
                                    <option value="{{$profession->id}}" @if($profession->id ==
                                        $professional->profession_id) selected @endif>{{$profession->title_en}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="first_name"
                                            placeholder="Enter first name" value="{{$professional->user->first_name}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="last_name"
                                            placeholder="Enter last name" value="{{$professional->user->last_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Mobile</label>
                                        <input type="tel" name="mobile" class="form-control" id="mobile"
                                            placeholder="Enter mobile" value="{{$professional->user->mobile}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Enter email" value="{{$professional->email}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_number">ID Number</label>
                                        <input type="number" name="id_number" class="form-control" id="id_number"
                                            placeholder="Enter id number" value="{{$professional->id_number}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="experience_years">Experience Years</label>
                                        <input type="number" name="experience_years" class="form-control"
                                            id="experience_years" placeholder="Enter experience years"
                                            value="{{$professional->experience_years}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="Enter address" value="{{$professional->address}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_date">Birth Date</label>
                                        <input id="birth_date" type="text" class="form-control"
                                            placeholder="Enter birth date" value="{{$professional->user->birth_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea class="form-control" style="resize: none;" id="bio" name="bio" rows="4"
                                    placeholder="Enter bio" cols="50">{{$professional->bio}}</textarea>
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
                            <button type="button" onclick="performUpdate({{$professional->id}})"
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
<script src="{{ asset('cms/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    //Initialize Select2 Elements
    $('.cities').select2({
        theme: 'bootstrap4'
    })
    $('.professions').select2({
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

    function performUpdate(id){
        let data = {
            city_id: document.getElementById('cities').value,
            profession_id: document.getElementById('professions').value,
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            mobile: document.getElementById('mobile').value,
            email: document.getElementById('email').value,
            birth_date: document.getElementById('birth_date').value,
            id_number: document.getElementById('id_number').value,
            bio: document.getElementById('bio').value,
            experience_years: document.getElementById('experience_years').value,
            address: document.getElementById('address').value,
            gender: document.getElementById('male').checked ? "M" : "F",
        } 
        let redirectUrl = '/cms/admin/professionals'
        update('/cms/admin/professionals/'+id,data,redirectUrl);
    }
</script>
@endsection