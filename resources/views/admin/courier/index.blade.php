@extends('backEnd.layouts.master')
@section('title','List Categories')
@section('content')
    
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>List Categories</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kurir</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($index as $index)
                    
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$index['courier']}}</td>
                        <td style="text-align: center; width: 13%;">
                          {{-- <div class="btn-group"> --}}
                            <a href="/admin/courier/{{$index->id}}/edit">
                                <button style="float: left;" class="btn btn-warning">Edit</button>
                            </a>
                            
                            <form action="/admin/courier/{{$index->id}}" method="POST">
                                @method("DELETE")
                                @csrf
                                
                                <button type="submit" style="float: right;" class="btn btn-danger">
                                    Delete
                                </button>
                              
                            </form>
                            {{-- </div> --}}
                        </td> 
                    </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('jsblock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
      $(document).on('click', '.deleteRecord', function (e) {
          e.preventDefault();
          var id = $(this).data('id');
          swal({
            title: "Are you sure!",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
           },
           function () {
              $.ajax({
                type: "POST",
                url: "admin/courier/"+id,
                data: {id:id},
                success: function (data) {
                              //
                    }         
            });
           });
        });
    </script>
@endsection

