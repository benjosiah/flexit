@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>Posts</h3>
                    @foreach($pages_post as $post)
                   <div>
                       <a href="{{route('page',['page_id'=>$post->page->id])}}">  
                       <h5>{{$post->page->name}}</h5> 
                       </a>
                        <div class='post' >
                            <div>
                                <img src="{{route('image',['image_name'=>$post->image])}}" width='200px' height='200px'>
                            </div>
                            {{$post->post}}
                        </div>
                        <div>
                            @if($post->page->user_id==Auth::user()->id)
                            <a href="">
                                |Delete
                            </a>
                            <a href="">
                                |Edit
                            </a>
                            @endif
                            <a href="">
                                |Rate
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
