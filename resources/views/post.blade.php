@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>Posts</h3>
                   <div>
                       <h5>{{$post->page->name}}</h5> 
                        <div class='post' >
                            <div>
                                <img src="{{route('image',['image_name'=>$post->image])}}" width='200px' height='200px'>
                            </div>
                            {{$post->post}}
                        </div>
                        <div>
                            <a href="">
                                |Delete
                            </a>
                            <a href="">
                                |Edit
                            </a>
                            <a href="">
                                |Rate
                            </a>
                        </div>
                    </div>
                
                    <div class="panel-heading">
                        <div>
                            <h3>Make Payment</h3>
                            @if(Session::has('message'))
                            <div class='row'>
                                    <div class='col-md-6'>
                                        <ul>
                                            {{Session::Get('message')}}
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <form class="form-horizontal" method="POST" action="{{route('card')}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input type="hidden" name="page_id" value="">
                            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="text" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="text" type="text" class="form-control" name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">card number</label>
                                <div class="col-md-6">
                                    <input id="card" type="text" class="form-control" name="card" value=''>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">CVV</label>
                                <div class="col-md-6">
                                    <input id="cvv" type="password" class="form-control" name="cvv" value=''>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">expire month</label>
                                <div class="col-md-6"> 
                                    <input id="" type="integer" class="form-control" name="month" value=''>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">expire year</label>
                                <div class="col-md-6"> 
                                    <input id="" type="integer" class="form-control" name="year" value=''>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Pay
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
