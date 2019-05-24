@extends('backEnd.layouts.master')
@section('title','Add Category')
@section('content')
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                    <h5>Add New Category</h5>
                </div>
                <div class="widget-content nopadding">
                    <form class="form-horizontal" method="post" action="/admin/product_cat">
                    @csrf
                        
                        <div class="control-group">
                            <label class="control-label">Parent Category :</label>
                            <div class="controls">
                                    <select class="form-control" name="parent_id" id="parent_id" onclick="myFunction()" >
                                        <option value="0">Parent Category</option>
                                        <option value="1" id="id1">Child Category</option>
                                  </select>
                         
                            </div>
                        </div>

                        

                        <div class="control-group" id="show" style="display: none">
                            <label class="control-label">Child Category :</label>
                            <div class="controls">
                                    <select class="form-control" id="parent_id1" name="parent_id1">
                                        @foreach($index as $index)
                                            <option value="{{$index->id}}">{{$index->category_name}}</option>
                                        @endforeach
                                  </select>            
                            </div>
                        </div>

                        

                        <div class="control-group{{$errors->has('nama_kategori')?' has-error':''}}">
                        
                            <label class="control-label">Category Name :</label>
                            <div class="controls">
                                <input id="name" type="text" class="form-control{{ $errors->has('nama_kategori') ? ' is-invalid' : '' }}" name="nama_kategori" value="{{ old('nama_kategori') }}" required="" autofocus>

                                @if ($errors->has('nama_kategori'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_kategori') }}</strong>
                                    </span>
                                @endif
                                <span class="text-danger" id="chCategory_name" style="color: red;">{{$errors->first('name')}}</span>
                            </div>
                        </div>
                         <div class="control-group">
                            <label for="control-label"></label>
                            <div class="controls">
                                <input type="submit" name="submit" value="Tambahkan" class="btn btn-success">
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    
@endsection
@section('jsblock')
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('js/jquery.toggle.buttons.js')}}"></script>
    <script src="{{asset('js/masked.js')}}"></script>
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.form_common.js')}}"></script>
    <script src="{{asset('js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-wysihtml5.js')}}"></script>

    <script type="text/javascript">
        function myFunction() {
        var select = document.getElementById("id1");
        if (select.selected == true){
            show.style.display = "block";
          } else {
            show.style.display = "none";
            
          }
        }
    </script>
@endsection
