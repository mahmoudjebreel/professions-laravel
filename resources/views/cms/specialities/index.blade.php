@extends('cms.parent')

@section('style')

@endsection

@section('title','Specialities')
@section('page-title','Index Specialities')
@section('small-title','Specialities')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Specialities</h3>

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
                  <th>Professions</th>
                  <th>Status</th>
                  <th>Create At</th>
                  <th>Updated At</th>
                  <th>Settings</th>
                </tr>
              </thead>
              <tbody>
                <span hidden>{{$counter = 0}}</span>
                @foreach ($specialities as $speciality)
                <tr>
                  <td><span class="badge bg-info">#{{++$counter}}</span></td>
                  <td>{{$speciality->id}}</td>
                  <td>{{$speciality->title_en}}</td>
                  <td>{{$speciality->title_ar}}</td>
                  <td><span class="badge bg-info">{{$speciality->professions_count}} Profession/s</span></td>
                  <td>
                    @if($speciality->active)
                    <span class="badge bg-success">{{$speciality->activity_status}}</span>
                    @else
                    <span class="badge bg-danger">{{$speciality->activity_status}}</span>
                    @endif
                  </td>
                  <td>{{$speciality->created_at}}</td>
                  <td>{{$speciality->updated_at}}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{route('specialities.edit',$speciality->id)}}" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                      </a>
                      {{-- <form method="POST" action="{{route('specialities.destroy',$speciality->id)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                      </form> --}}
                      <a href="#" onclick="confirmDestroy({{$speciality->id}}, this)" class="btn btn-danger">
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
  function confirmDestroy(id, ref){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        destroy(id, ref);
        // showSuccessMessage();
      }
    });
  }

  function destroy(id, ref){
    axios.delete('/cms/admin/specialities/'+id)
    .then(function (response) {
    // handle success 2xx - 3xx
      console.log(response);
      ref.closest('tr').remove();
      showMessage(response.data);
    })
    .catch(function (error) {
    // handle error 4xx - 5xx
      console.log(error);
      showMessage(error.response.data);
    })
    .then(function () {
    // always executed
    });
  }

  function showMessage(data){
    Swal.fire({
      // position: 'top-end',
      icon: data.icon,
      title: data.title,
      showConfirmButton: false,
      timer: 1500
    });
  }
</script>
@endsection