@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create User</div>

                <div class="panel-body">

                    {{--<user-form></user-form>--}}



                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection