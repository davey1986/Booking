@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card mt-2">
                <div class="card-header">
                    <h3> {{$guest->title}} {{$guest->name}} {{$guest->surname}}<a href="/dashboard" style="float:right;">Back</a> </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p>Email: {{$guest->email}}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p>Mobile: {{$guest->cell}}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p>Breakfast: {{$guest->breakfast ? 'Yes' : 'No' }}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p>Dinner: {{$guest->supper  ? 'Yes' : 'No' }}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p>Check-in: {{$guest->check_in}}</p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <p>Check-out: {{$guest->check_out}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
