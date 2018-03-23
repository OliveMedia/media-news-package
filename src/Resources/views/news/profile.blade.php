@extends('backend.layouts.master')
@section('title')
    User Profile
@endsection
@section('breadcrumb')
    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('news') }}">Users</a> </li>
        <li class="breadcrumb-item active"> User Profile</li>
    </ul>
@endsection
@section('search_box')
    {{--<input type="text" id="search" name="search" class="form-control search"  autocomplete="off" onkeyup="search()" placeholder="Search News...">--}}
@endsection
    @section('content')
        <div class="border-bottom white-bg dashboard-header">
            <div class="row">
                <div class="col-lg-12">
                    @include('usermodule::includes.error')
                    @include('usermodule::includes.success')

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-lg-pull-6 col-md-6 col-sm-6">
                                <section class="box-typical">
                                    <div class="profile-card">
                                        <div class="profile-card-photo">
                                            <img src="{{ asset('backend_theme/img/avatar-1.jpg') }}" alt="">
                                        </div>
                                        <div class="profile-card-name">Sajan Gurung</div>
                                        <div class="profile-card-status">Web Developer</div>
                                        <div class="profile-card-location">Batisputali, KTM</div>
                                        <button type="button" class="btn btn-rounded">Follow</button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-rounded btn-primary-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Connect
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-home"></span>Olive Safety</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-cart"></span>GTPR</a>
                                                <a class="dropdown-item" href="#"><span class="font-icon font-icon-speed"></span>Olive Showcase</a>
                                            </div>
                                        </div>
                                    </div><!--.profile-card-->

                                    <div class="profile-statistic tbl">
                                        <div class="tbl-row">
                                            <div class="tbl-cell">
                                                <b>200</b>
                                                Connections
                                            </div>
                                            <div class="tbl-cell">
                                                <b>1.9M</b>
                                                Followers
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="profile-links-list">
                                        <li class="nowrap">
                                            <i class="fa fa-globe"></i>  <a href="#"> example.com</a>
                                        </li>
                                        <li class="nowrap">
                                            <i class="fa fa-envelope"></i>  <a href="#">email@example.com</a>
                                        </li>
                                        <li class="nowrap">
                                            <i class="fa fa-facebook"></i>  <a href="#">sajan@facebook.com</a>
                                        </li>
                                        <li class="nowrap">
                                            <i class="fa fa-linkedin"></i>  <a href="#">sajan@linkedin.com</a>
                                        </li>
                                    </ul>
                                </section><!--.box-typical-->
                            </div><!--.col- -->

                            <div class="col-lg-9 col-lg-push-3 col-md-12">
                                <form class="form-horizontal ng-pristine ng-valid" method="POST" action="{{ route('user.profile')}}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="id" value="{{$user->id}}">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{$user->name }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Address</label>

                                        <div class="col-md-6">
                                            <input id="address" type="text" class="form-control" name="address" value="{{$user->address }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div><!--.col- -->

                        </div><!--.row-->
                    </div>


                </div>
            </div>
        </div>
    @endsection
