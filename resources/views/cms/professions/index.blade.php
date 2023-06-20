@extends('cms.parent')

@section('style')

@endsection

@section('title','Professions')
@section('page-title','Index Professions')
@section('small-title','SpecialitProfessionsies')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Professions</h3>

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
                  <th>Title En</th>
                  <th>Title Ar</th>
                  <th>Speciality</th>
                  <th>Status</th>
                  <th>Create At</th>
                  <th>Updated At</th>
                  <th>Settings</th>
                </tr>
              </thead>
              <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($professions as $profession)
                <tr>
                  <td><span class="badge bg-info">#{{++$counter}}</span></td>
                  <td>{{$profession->id}}</td>
                  <td>{{$profession->title_en}}</td>
                  <td>{{$profession->title_ar}}</td>
                  <td><span class="badge bg-info">{{$profession->speciality->title_en}}</span></td>
                  <td>
                    @if($profession->active)
                    <span class="badge bg-success">{{$profession->activity_status}}</span>
                    @else
                    <span class="badge bg-danger">{{$profession->activity_status}}</span>
                    @endif
                  </td>
                  <td>{{$profession->created_at}}</td>
                  <td>{{$profession->updated_at}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{route('professions.edit',$profession->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      {{-- <form method="POST" action="{{route('professions.destroy',$profession->id)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                      </form> --}}
                      <a href="#" onclick="performDestroy({{$profession->id}}, this)" class="btn btn-danger">
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
    let url = '/cms/admin/professions/'+id;
    confirmDestroy(url, reference);
  }
</script>
@endsection