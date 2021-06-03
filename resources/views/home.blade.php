@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                      @if($days==-3)
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">No elections</h1>
                            <p class="lead">There are no elections that are going to be conducted in near future</p>
                          </div>
                        </div>
                      @endif
                      @if($days==-1)
                          <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                              <h1 class="display-4">Too late!!</h1>
                              <p class="lead">Elections for this year passed away</p>
                            </div>
                          </div>
                      @endif
                      @if($days==-2)
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Too Early!!</h1>
                            <p class="lead">Elections are not going to happen in this month</p>
                          </div>
                        </div>
                      @endif
                      @if($days==-4)
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Early!!</h1>
                            <p class="lead">Elections are going to happen in this month</p>
                          </div>
                        </div>
                      @endif
                      @if($days==100)
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Elections {{$elections[0]->year}}</h1>
                            <p class="lead">Elections are open</p>
                            <a href='{{route('elections.vote',$elections[0]->id)}}'><button class="btn btn-primary btn-lg">Vote Now</button></a>
                          </div>
                        </div>
                      @endif
                      @if($days>=0 && $days<=10)
                        <div class="jumbotron jumbotron-fluid">
                          <div class="container">
                            <h1 class="display-4">Elections {{$elections[0]->year}}</h1>
                            <p class="lead">There is election which is going to happen in {{$days-1}} days</p>
                            <a href='{{route('candidates.create')}}'><button class="btn btn-primary btn-lg">Register</button></a>
                            <a href='{{route('candidates.index')}}'><button class="btn btn-warning btn-lg">See Candidates</button></a>
                          </div>
                        </div>
                      @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
