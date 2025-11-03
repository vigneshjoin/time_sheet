@include('admin.layouts.header')


    <div id="app">
    
    <input type="hidden" name="home_url" id="home_url" value="{{ url('/') }}">
        <div class="main-wrapper main-wrapper-1">
            @include('admin.layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">      
                @yield('contents')                              
            </div>
        </div>
    </div>

@include('admin.layouts.footer') 