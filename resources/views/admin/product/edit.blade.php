@extends('backEnd.layouts.master')
@section('title','Add Products Page')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div id="breadcrumb"> <a href="{{url('/admin')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{route('product.index')}}">Products</a> <a href="{{route('product.create')}}" class="current">Edit Products</a> </div>
    <div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5>Edit Products</h5>
            </div>
            <div class="widget-content nopadding">
                <form action="{{route('product.update',$test->id)}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    @method("PUT")
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
                        <label for="description" class="control-label">Deskripsi</label>
                        <div class="controls">
                            <textarea class="textarea_editor span12"  name="deskripsi" rows="6" placeholder="Product Description" style="width: 580px;">{{$test->description}}</textarea>
                            <span class="text-danger"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Select Category</label>
                        <div class="controls">
                            
                                @foreach($category as $category)
                                    <input type="checkbox" name="kategori[]" value="{{$category->id}}"
                                      @foreach ($cat as $cat1)  
                                      @if ($category->id == $cat1['category_id'])
                                        checked=""
                                      @endif
                                    @endforeach
                                    >{{$category->category_name}}
                                @endforeach
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="price" class="control-label">Diskon</label>
                        <div class="controls">
                            <input type="checkbox" id="myCheck" name="dis" onclick="myFunction()"
                            @if(!empty($diskon))
                                checked="" 
                            @endif
                            >
                            
                        </div>
                    </div>

                    <div @if(empty($diskon)) style="display: none" @endif id="text">
                        <div class="control-group">
                            <label class="control-label">Persentase</label>
                                <div class="controls">
                                    <input type="text" name="persentase" 
                                    @if(!empty($diskon))
                                        value="{{$diskon->percentage}}"
                                    @endif  placeholder="Persentase diskon">
                                </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Tanggal Mulai</label>
                                <div class="controls">
                            
                                  <input type="date" name="tanggal_mulai" 
                                  @if(!empty($diskon))
                                    value="{{$diskon->start}}"
                                  @endif placeholder="tanggal mulai" >
                                </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Tanggal Akhir</label>
                            <div class="controls">
                                <input type="date" name="tanggal_akhir" 
                                      @if(!empty($diskon))
                                        value="{{$diskon->end}}"
                                @endif placeholder="tanggal akhir" >
                            </div>
                        </div>

                    </div>

                <div class="control-group">    
                <div class="span6 controls">
                    <div class="widget-box">
                    <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                        <h5>List Images Galleries</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; ?>
                                @foreach($img as $imageGallery)
                                    <tr>
                                        <td class="taskDesc" style="text-align: center;vertical-align: middle;">{{$i++}}</td>
                                        <td class="taskOptions" style="text-align: center;vertical-align: middle;"><img src="{{asset('images/small/'.$imageGallery['image_name']) }}" class="img-responsive" alt="Image" width="60"></td>
                                        <td style="text-align: center;vertical-align: middle;"><a href="javascript:" rel="{{$imageGallery->id}}" rel1="product_img" class="btn btn-danger btn-mini deleteRecord">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
            </div>

                    <div class="control-group" >
                        <label for="Foto" class="control-label">Foto</label>
                            <div class="controls">
                                <input type="file" name="filename[]" class="form-control" multiple="multiple" id="gallery-photo-add">
                            </div>
                        <div class="gallery"></div>
                    </div>
  
                    <div class="control-group">
                        <label for="" class="control-label"></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-warning">Edit Product</button>
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

//     $(function() {
//     // Multiple images preview in browser
//     var imagesPreview = function(input, placeToInsertImagePreview) {

//         if (input.files) {
//             var filesAmount = input.files.length;

//             for (i = 0; i < filesAmount; i++) {
//                 var reader = new FileReader();

//                 reader.onload = function(event) {
//                     $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
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
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.ui.custom.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-colorpicker.js')}}"></script>
    <script src="{{asset('js/jquery.toggle.buttons.js')}}"></script>
    <script src="{{asset('js/masked.js')}}"></script>s
    <script src="{{asset('js/jquery.uniform.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/matrix.js')}}"></script>
    <script src="{{asset('js/matrix.form_common.js')}}"></script>
    <script src="{{asset('js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-wysihtml5.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $('.textarea_editor').wysihtml5();
         
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