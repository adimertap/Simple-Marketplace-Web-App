@extends('backEnd.layouts.master')
@section('title','Add Products Page')
@section('content')

    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('product.index')}}">Products</a> <a href="{{route('product.create')}}" class="current">Add New Product</a> </div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Add New Products</h5>
            </div>
            <div class="widget-content nopadding">
                <form method="post" action="/admin/product" class="form-horizontal" enctype="multipart/form-data">
                  @csrf
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="control-group">
                        <label class="control-label">Select Category</label>
                        <div class="controls">
                                @foreach($category as $category)
                                    <input type="checkbox" name="kategori[]" value="{{$category->id}}">{{$category->category_name}}
                                    @foreach ($cat as $cat1)  
                                      @if ($category->id == $cat1['category_id'])
                                        checked=""
                                      @endif
                                    @endforeach>
                                      {{$category->category_name}}  
                                  @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">Nama</label>
                        <div class="controls">
                            <input type="text" name="nama_produk" class="form-control" value="{{$test->product_name}}" title="" required="required" style="width: 400px;">                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">Harga</label>
                        <div class="controls">
                            <input type="number" name="harga" class="form-control" value="{{$test->price}}" title="" required="required" style="width: 400px;">                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">Stok</label>
                        <div class="controls">
                            <input type="number" name="stok" class="form-control" value="{{$test->stock}}" title="" required="required" style="width: 400px;">                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">Berat</label>
                        <div class="controls">
                            <input type="number" name="stok" class="form-control" value="{{$test->weight}}" title="" required="required" style="width: 400px;">                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="description" class="control-label">Deskripsi</label>
                        <div class="controls">
                            <textarea class="textarea_editor span12" name="deskripsi" rows="6" placeholder="Product Description" value="{{$test->description}}" style="width: 580px;"></textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="price" class="control-label">Diskon</label>
                        <div class="controls">
                            <input type="checkbox" id="myCheck" name="dis" onclick="myFunction()">
                            <div style="display: none" id="text">
                              <input type="text" name="persentase" placeholder="Persentase diskon"><br>
                              <input type="date" name="tanggal_mulai" placeholder="tanggal mulai" ><br>
                              <input type="date" name="tanggal_akhir" placeholder="tanggal akhir" ><br>
                            </div>
                        </div>
                    </div>
                    <div class="control-group" >
                      <label for="price" class="control-label">Foto</label>
                        <div class="controls">
                      <input type="file" name="filename[]" class="form-control">
                      <div class="input-group-btn"> 
                        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                      </div>
                    </div>
                    <div class="clone hide">
                      <div class="control-group input-group" style="margin-top:10px">
                        <input type="file" name="filename[]" class="form-control">
                        <div class="input-group-btn"> 
                          <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                      </div>
                </div>
              <div class="control-group" >
              <label for="price" class="control-label"></label>
              <input type="file" name="filename[]" class="form-control" >
              <div class="input-group-btn"> 
                <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
              </div>
            </div>
            <div class="clone hide">
              <div class="control-group input-group" style="margin-top:10px">
                <input type="file" name="filename[]" class="form-control">
                <div class="input-group-btn"> 
                  <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                </div>
              </div>
                </div>
                    <div class="control-group">
                        <label for="" class="control-label"></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-success">Add New Product</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('jsblock')
<script type="text/javascript">


    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

    
    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      if (checkBox.checked == true){
        text.style.display = "block";
        
      } else {
        text.style.display = "none";
        
      }
    }

    function preview_image(event) 
    {
      var reader = new FileReader();
      reader.onload = function()
      {
        var output = document.getElementById('output_image');
        output.src = reader.result;
      }
     reader.readAsDataURL(event.target.files[0]);
    }
    $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('height',100).attr('widht',300).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
</script>
<script type="text/javascript">


    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

    
    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      var text1 = document.getElementById("text1");
      var text2 = document.getElementById("text2");
      if (checkBox.checked == true){
        text.style.display = "block";
        text1.style.display = "block";
        
        text2.style.display = "block";
      } else {
        text.style.display = "none";
        text1.style.display = "none";
        text2.style.display = "none";
        
      }
    }

</script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
    <script>
        $('.textarea_editor').wysihtml5();
    </script>
@endsection



<html lang="en">
<head>
  <title></title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
  <div class="container">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif

    <h3 class="jumbotron">Laravel Multiple File Upload</h3>
<form method="post" action="/admin/product" enctype="multipart/form-data">
  @csrf
  Nama :<input type="text" name="nama_produk" value="{{$test->product_name}}" required=""><br>
  Harga : <input type="number" name="harga" value="{{$test->price}}" required=""><br>
  Stok : <input type="number" name="stok" value="{{$test->stock}}" required=""><br>
  Berat : <input type="number" name="berat" value="{{$test->weight}}" required=""><br>
  kategori : 
    @foreach ($category as $category)
      <input type="checkbox" name="kategori[]" value="{{$category->id}}" 
      @foreach ($cat as $cat1)  
        @if ($category->id == $cat1['category_id'])
          checked=""
        @endif
      @endforeach>
        {{$category->category_name}}  
    @endforeach
    <br><br>
  Foto:
        <div class="input-group control-group increment" >
          <input type="file" name="filename[]" class="form-control" >
          <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
        </div>
        <div class="clone hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="file" name="filename[]" class="form-control">
            <div class="input-group-btn"> 
              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
    </div>
    Deskripsi : <br><textarea type="text" name="deskripsi" rows="5" required="">{{$test->description}}</textarea><br>
    
    Diskon: 
    <input type="checkbox" id="myCheck" name="dis"value="1" onclick="myFunction()">
    
    <input id="text" type="text" name="persentase" style="display:none" placeholder="Persentase diskon"><br>
    <input id="text1" type="date" name="tanggal_mulai" style="display:none" placeholder="tanggal mulai" ><br>
    <input id="text2" type="date" name="tanggal_akhir" style="display:none" placeholder="tanggal akhir" ><br>
    <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

  </form>        
  </div>

  
<script type="text/javascript">


    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

    
    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      var text1 = document.getElementById("text1");
      var text2 = document.getElementById("text2");
      if (checkBox.checked == true){
        text.style.display = "block";
        text1.style.display = "block";
        
        text2.style.display = "block";
      } else {
        text.style.display = "none";
        text1.style.display = "none";
        text2.style.display = "none";
        
      }
    }

</script>
</body>
</html>