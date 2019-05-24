@extends('backEnd.layouts.master')
@section('title','Add Products Page')
@section('content')

    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('product.index')}}" class="current">Products</a></div>
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
                <form action="{{route('product.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="control-group">
                        <label for="p_name" class="control-label">Nama</label>
                        <div class="controls">
                            <input type="text" name="nama_produk" class="form-control" value="" title="" required="required" style="width: 400px;">                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">Harga</label>
                        <div class="controls">
                            <div class="input-prepend">
                            <input type="number" name="harga" class="form-control" value="" title="" required="required" style="width: 400px;">
                            </div>                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">Stok</label>
                        <div class="controls">
                            <input type="number" name="stok" class="form-control" value="" title="" required="required" style="width: 400px;">                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="description" class="control-label">Deskripsi</label>
                        <div class="controls">
                            <textarea class="textarea_editor span12" name="deskripsi" rows="6" placeholder="Product Description" style="width: 580px;"></textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Select Category</label>
                        <div class="controls">
                            
                                @foreach($category as $category)
                                    <input type="checkbox" name="kategori[]" value="{{$category->id}}">{{$category->category_name}}
                                @endforeach
                            
                        </div>
                    </div>
                    <div class="control-group" >
                        <label for="price" class="control-label">Diskon</label>
                        <div class="controls">
                            <input type="checkbox" id="myCheck" name="dis" onclick="myFunction()">
                            
                            </div>
                    </div>
                    
                    <div style="display: none" id="text">
                            <div class="control-group">
                                <label class="control-label">Persentase</label>
                                <div class="controls">
                                    <input type="text" name="persentase" placeholder="Persentase diskon"><br>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Tanggal Mulai</label>
                                <div class="controls">
                                    <input type="date" name="tanggal_mulai" placeholder="tanggal mulai" ><br>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Tanggal Akhir</label>
                                <div class="controls">
                                    <input type="date" name="tanggal_akhir" placeholder="tanggal akhir" ><br>
                                </div>
                            </div>

                    </div>
                    <div class="control-group" >
                        <label for="Foto" class="control-label">Foto</label>
                            <div class="controls">
                                <input type="file" name="filename[]" multiple="multiple" id="gallery-photo-add">
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
    <script type="text/javascript">
    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      if (checkBox.checked == true){
        text.style.display = "block";
        
      } else {
        text.style.display = "none";
        
      }

    // $(function() {
    // Multiple images preview in browser
    // var imagesPreview = function(input, placeToInsertImagePreview) {

    //     if (input.files) {
    //         var filesAmount = input.files.length;

    //         for (i = 0; i < filesAmount; i++) {
    //              var reader = new FileReader();

    //              reader.onload = function(event) {
    //                  $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
    //                 }

    //                 reader.readAsDataURL(input.files[i]);
    //             }
    //         }

    //     };

    //     $('#gallery-photo-add').on('change', function() {
            
    //         imagesPreview(this, 'div.gallery');
    //     });
    // });

   
    }
    </script>
@endsection
@section('jsblock')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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