# News Publishing Package

# Requirement 
1 AWS Configuration
* Aws storage is used here so install aws package. Update composer.json file with:
  
  "league/flysystem-aws-s3-v3": "^1.0",
  
  And setup the aws configuration variables in your .env file of project root
  
  AWS_ACCESS_KEY_ID=xxxxxxxxxxxxxxx
  AWS_SECRET_ACCESS_KEY=xxxxxxxxxxxx
  AWS_BUCKET=xxxxxxxxxxxxxxxxxxxxx
  AWS_DEFAULT_REGION=xxxxxxxxxxxxx
     
2 Parent blade template
* views/layouts/app.blade.php
    
    The typical structure of app.blade.php should be like below:
    
    ---------------------------------------------------
    <!DOCTYPE html>
    <html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'Laravel') }}:@yield('title')</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    
        <!-- ckeditor CDN -->
        <script src="https://cdn.ckeditor.com/4.9.0/standard/ckeditor.js"></script>
        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/ionicons.min.css') }}" rel="stylesheet">
        @yield('page-css')
    </head>
    <body>
        <div id="app">
            <header class="header">
                <!-- Sidebar navigation -->
                @guest
    
                @else
                <div id="slide-out" class="side-nav">
                    <ul class="custom-scrollbar list-unstyled">
                        <!-- Logo -->
                        <li>
                            <div class="logo-wrapper">
                                <a href="{{ url('/') }}"><img src="/images/logo-v1.png" class="img-fluid"></a>
                            </div>
                        </li>
                        <li>
                            <div class="admin dropdown show">
                                <a class="dropdown-toggle" href="#" id="DropdownMenuLink1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="admin-image" src="/images/man2.png" alt="">{{Auth::user()->name}}</a>
                                    <div class="dropdown-menu profile-dropdown" aria-labelledby="DropdownMenuLink1">
                                        <a class="dropdown-item" href="/user_management/{{Auth::user()->user_id}}">Profile</a>
    
                                        <a class="dropdown-item" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Logout</a>
                                    </div>
                                </div>
                            </li>
                            <!-- Side navigation links -->
                            <li>
                                <ul class="list-unstyled dashboard-nav">
                                    <li><a class="">Dashboard</a></li>
                                    <li><a class="">Users</a></li>
                                    <li><a class="">Emails</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @endguest
                    <!-- main navigation -->
                    <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav">
                        <div class="float-left">
                            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav nav-flex-icons ml-auto">
                            @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="admin-image" src="/images/man2.png" alt="">{{ Auth::user()->name }}</a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/user_management/{{Auth::user()->user_id}}">Profile</a>
                                    <a class="dropdown-item"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('departure') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </nav>
            </header>
    
            @yield('content')
    
        </div>
    
        <!-- Scripts -->
        {{-- <script src="jquery-3.3.1.min.js"></script> --}}
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/mdb.min.js') }}"></script>
    
        @yield('page-script')
    </body>
    </html>

    ---------------------------------------------------
    
3) users table must have unique user_id field of type string ie uuid

    
# Installation 
* No need to add providers in config/app.php since laravel auto package discovery feature is added
	
1. Directly require the repository ie update your composer.json with below lines
*    "require": {
        "league/flysystem-aws-s3-v3": "^1.0",
        "OliveMedia/media-news-package": "dev-master"
    },

*    "repositories": [
        {
            "type": "git",
            "url":  "https://github.com/OliveMedia/media-news-package.git"
        }
    ]
    
    
# Usage
* The resource url for news is news which prefixed by console
ie https://yourdomain.com/console/news

* The news table contains following fields:
'news_id',
'user_id',
'title',
'description'
'image',
'video',
'attachment'

* You can either publish the migration or simply migrate it
php artisan vendor:publish --provider="OliveMedia\OliveMediaNews\OliveMediaNewsServiceProvider" --tag=migrations --force
* If you want to modify views you can either publish views too
php artisan vendor:publish --provider="OliveMedia\OliveMediaNews\OliveMediaNewsServiceProvider" --tag=views --force

* Alternatively you can publish all the config, views and migration at the same time using below command
 php artisan vendor:publish --provider="OliveMedia\OliveMediaNews\OliveMediaNewsServiceProvider"
 
 
 ### Using Alias to control news
 
 * OliveMediaNews is default alias
 
 
 * usage example (user_id, title, and description are required field)
 
 * Route::get('create-news', function () {
 
     $news = OliveMediaNews::createNews([
         'user_id' => "8a9e1be6-6959-46fd-a61a-4b76daabf604",
         'title' => "TITLE",
         'description' => "DESCRIPTION",
         'image' => "image.jpg",
         'video' => "image.jpg",
         'attachment' => "image.jpg",
     ]);
 
     return $news;
 });
 
 * Route::get('get-news-by-id', function () {
 
     $news = OliveMediaNews::getNewsById('8a9e88e5-8669-4248-9e7f-1ebf8ab5b78a');
 
     return $news;
 });
 * Route::get('get-users-news', function () {
 
     $news = OliveMediaNews::getUserNews('8a9e1be6-6959-46fd-a61a-4b76daabf604');
 
     return $news;
 });
 * Route::get('get-all-news', function () {
 
     $news = OliveMediaNews::getAllNews();
 
     return $news;
 });
 
 
 