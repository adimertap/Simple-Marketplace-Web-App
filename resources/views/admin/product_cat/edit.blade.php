@extends('backEnd.layouts.master')
@section('title','Edit Category')
@section('content')
        <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                        <h5>Edit Category</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form class="form-horizontal" action="/admin/product_cat/{{$test->id}}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="control-group{{$errors->has('nama_kategori')?' has-error':''}}">
                                <label class="control-label">Category Name :</label>
                                <div class="controls">
                                    <input type="text" name="nama_kategori" value="{{$test->category_name}}" required="">
                                    <span class="text-danger" style="color: red;">{{$errors->first('name')}}</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label for="control-label"></label>
                                <div class="controls">
                                    <input type="submit" name="submit" value="update" class="btn btn-success">
                                </div>
                            </div>
                        </form>
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
@endsection