@extends('cms.parent')

@section('style')

@endsection

@section('title','Professionals')
@section('page-title','Index Professionals')
@section('small-title','Professionals')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Professionals</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered table-striped text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile</th>
                  <th>Email</th>
                  <th>Gender</th>
                  <th>Birth Date</th>
                  <th>Status</th>
                  <th>Create At</th>
                  <th>Updated At</th>
                  <th>Settings</th>
                </tr>
              </thead>
              <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($professionals as $professional)
                <tr>
                  <td><span class="badge bg-info">#{{++$counter}}</span></td>
                  <td>{{$professional->id}}</td>
                  <td>{{$professional->user->first_name}}</td>
                  <td>{{$professional->user->last_name}}</td>
                  <td>{{$professional->user->mobile}}</td>
                  <td>{{$professional->email}}</td>
                  <td><span class="badge bg-primary">{{$professional->user->gender_name}}</span></td>
                  <td>{{$professional->user->birth_date}}</td>
                  <td><span class="badge bg-info">{{$professional->user->active}}</span></td>
                  <td>{{$professional->created_at->format('Y-m-d H:i')}}</td>
                  <td>{{$professional->updated_at->format('Y-m-d H:i')}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{route('professionals.edit',$professional->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="#" onclick="performDestroy({{$professional->id}}, this)" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')

<script>
  function performDestroy(id, reference){
    let url = '/cms/admin/professionals/'+id;
    confirmDestroy(url, reference);
  }
</script>
@endsection