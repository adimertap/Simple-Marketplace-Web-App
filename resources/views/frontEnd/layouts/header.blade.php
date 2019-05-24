<header id="header" ><!--header-->
    <div class="header_top" ><!--header_top-->
        <div class="container">
            <div class="row">
                {{-- <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> 010 010010</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@nodomain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </div>
                </div> --}}
            </div>
        </div>

    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{url('/')}}"><img src="{{asset('frontEnd/images/home/logo2.png')}}" alt="" width="180"; /></a>
                    </div>
                    <div class="btn-group pull-right">
{{--                         <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                USA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">UK</a></li>
                            </ul>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                DOLLAR
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Canadian Dollar</a></li>
                                <li><a href="#">Pound</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{url('/viewcart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>

                            @if(Auth::check())
                            @php
                                $id = Auth::id();
                                $jum = auth()->user()->unreadNotifications->count();
                                $notif = DB::table('admin_notifications')->where('notifiable_id',$id)->get();

                            @endphp
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-bell"></i> Notification
                                @if($jum != 0)<span class="badge" style="background-color: red;">1</span>@endif <span class="caret"></span></a>

                                <ul class="dropdown-menu">
                                    <li ><button id="readnotif" ><a style="color: green;" >Mark All As Read</a></button></li><br>
                                    @foreach(auth()->user()->unreadNotifications as $notif)
                                        <li><a href="#">{!!$notif->data!!}</a></li><br>
                                    @endforeach

                                  
                                </ul>

                            </li>

                                
                                <li><a href="{{url('/myaccount')}}"><i class="fa fa-user"></i> My Account</a></li>
                                {{-- <li><a href="{{ route('logout') }}"><i class="fa fa-lock"></i> Logout </a></li> --}}
                                <li><a href="{{ route('user.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <i class="fa fa-lock"></i>Logout
                                </a></li>    
                                <form id="frm-logout" action="{{ route('user.logout') }}"{{--  method="POST" --}} style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div><!--/header-middle-->
        <div class="container">
            <div class="row">

                    <div class="col-sm-12">
                    <div class="mainmenu">
                        <ul class="navbar navbar-light" style="background-color: #e3f2fd;">
                            <li><a href="{{url('/')}}" class="active">Home</a></li>
                            <li class="dropdown"><a href="">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('/list-products')}}">Products</a></li>
                                    {{-- <li><a href="{{url('/myaccount')}}">Account</a></li> --}}
                                    <li><a href="{{url('/viewcart')}}">Cart</a></li>
                                </ul>
                            </li>
                            <li><a href="/transaction">Transactions</a></li>
                            {{-- <li><a href="https://www.youtube.com/channel/UCH2Ir7rPaRN8ZPL9mSpclhw" target="_blank">Contact</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
                <div class="col-sm-3">
                    {{-- <div class="search_box pull-right">
                        <input type="text" placeholder="Search"/>
                    </div> --}}
                </div>  
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
<script src="{{asset('frontEnd/js/jquery.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#readnotif').click(function(){
            console.log("terklik");
            var baseUrl = window.location.protocol+"//"+window.location.host;
            $.ajax({
                  url: baseUrl+'/markRead',  
                  type : 'post',
                  dataType: 'JSON',
                  data: {
                    "_token": "{{ csrf_token() }}",
                    
                    },
                  success:function(response){
                        location.reload();
                  },
                  error:function(){
                    alert("GAGAL");
                  }

              });
        });
    });
</script>