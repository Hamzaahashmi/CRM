<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts.includes.head')
   
<body>

    



    <div class="containter">
        <div class="row">
            <div class="col-md-12">
                @yield('content')
            </div>
        </div>
    </div>


</body>

@include('layouts.includes.footer')


@yield('footerJs')

</html>
