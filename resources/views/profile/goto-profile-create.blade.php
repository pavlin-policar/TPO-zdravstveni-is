@extends('layouts.master')

@section('content')
    <div class="page-title">
        <span class="title">You haven't completed registration yet</span>
        <div class="description">Complete the registration process to access the website.</div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="title">Complete registration</div>
                    </div>
                </div>
                <div class="card-body">
                    <p>To access and use the web application, you must complete the registration
                        process.</p>
                    <p>Complete the registration process by creating a profile for yourself and
                        filling out the required fields.</p>
                    <div class="text-right">
                        {!! link_to('/logout', 'Log out', ['class' => 'btn btn-default']) !!}
                        {!! link_to_route('profile.getCreate', 'Create profile', [], ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection