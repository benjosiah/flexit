@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            @if(Session::has('responsemessage'))
                {{Session::Get('responsemessage')}}
            @endif

                {{$flwRef?$flwRef :' '}}
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                   <form action="{{route('pay')}}" method="post">
                   {{ csrf_field() }}
                    <input type="text" name='otp'>
                    <input type="submit" value="pay">
                        <input type="hidden" name="txRef" value="{{$flwRef?$flwRef : ' '}}">
                    
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
