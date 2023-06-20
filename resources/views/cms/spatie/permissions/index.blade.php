@extends('cms.parent')

@section('style')

@endsection

@section('title','permissions')
@section('page-title','Index')
@section('small-title','permissions Index')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">permissions</h3>

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
                  <th>Name</th>
                  <th>Guard</th>
                  <th>Create At</th>
                  <th>Updated At</th>
                  <th>Settings</th>
                </tr>
              </thead>
              <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($permissions as $permission)
                <tr>
                  <td><span class="badge bg-info">#{{++$counter}}</span></td>
                  <td>{{$permission->id}}</td>
                  <td>{{$permission->name}}</td>
                  <td><span class="badge bg-success">{{$permission->guard_name}}</span></td>
                  <td>{{$permission->created_at}}</td>
                  <td>{{$permission->updated_at}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      {{-- <form method="POST" action="{{route('permissions.destroy',$permission->id)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                      </form> --}}
                      <a href="#" onclick="performDestroy({{$permission->id}}, this)" class="btn btn-danger">
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
  function performDestroy(id, ref){
    confirmDestroy('/cms/admin/permissions/'+id, ref);
  }
</script>
@endsection