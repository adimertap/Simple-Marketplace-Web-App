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
            <h1>Parent Kategori</h1>
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>List Categories</h5>
                </div>

                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($index as $i)
                        
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$i['category_name']}}</td>
                            <td style="width: 13%; text-align: center;">
                              {{-- <div class="btn-group"> --}}
                              <form action="/admin/product_cat/{{$i->id}}/edit" method="GET">
                                @csrf
                                <button style="float: left;" class="btn btn-warning">Edit</button>
                                </form>

                                <form  action="/admin/product_cat/{{$i->id}}/" method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button style="float: right;" type="submit" class="btn btn-danger">
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

        @foreach($index as $index)
            <?php
              $products_cat =DB::table('product_categories')->where('parent_id',$index->id)->where('deleted_at',NULL)->get();
            ?>
            
            <div class="widget-box">
              <h3>{{$index->category_name}}</h3>
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                    <h5>List Categories</h5>
                </div>

                <div class="widget-content nopadding">
                    <table class="table table-bordered data-table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products_cat as $cat)
                        
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$cat->category_name}}</td>
                            <td style="width: 13%; text-align: center; ">
                              
                              <form action="/admin/product_cat/{{$cat->id}}/edit" method="GET">
                                @csrf
                                <button style="float: left;" class="btn btn-warning">Edit</button>
                                </form>

                                <form action="/admin/product_cat/{{$cat->id}}/" method="POST">
                                    @method("DELETE")
                                    @csrf
                                    <button style="float: right;" type="submit" class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                                

                            </td> 
                        </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          @endforeach
    </div>
@endsection
@section('jsblock')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.tables.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $(".deleteRecord").click(function () {
           var id=$(this).attr('rel');
           var deleteFunction=$(this).attr('rel1');
           swal({
               title:'Are you sure?',
               text:"You won't be able to revert this!",
               type:'warning',
               showCancelButton:true,
               confirmButtonColor:'#3085d6',
               cancelButtonColor:'#d33',
               confirmButtonText:'Yes, delete it!',
               cancelButtonText:'No, cancel!',
               confirmButtonClass:'btn btn-success',
               cancelButtonClass:'btn btn-danger',
               buttonsStyling:false,
               reverseButtons:true
           },function () {
              window.location.href="/admin/"+deleteFunction+"/"+id;
           });
        });
    </script>
@endsection
