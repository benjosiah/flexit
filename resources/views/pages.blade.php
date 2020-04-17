@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            @if($page->user_id==Auth::user()->id)
                <div class="panel-heading">
                    <div>
                        <h3>Post something</h3>
                        <form class="form-horizontal" method="POST" action="{{ route('page.post') }}" enctype="multipart/form-data" >
                        {{ csrf_field() }}
                        <input type="hidden" name="page_id" value="{{$page->id}}">
                        <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">Post</label>
                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control" name="text" value="" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Image</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" name="image">
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
                                    Submit Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
                </div>
                    @foreach($page_posts as $post)
                    <div>
                        <h5>{{$post->page->name}}</h5> 
                        <a href="{{route('post',['post_id'=>$post->id])}}">
                        <div class='post' >
                            <div>
                                <img src="{{route('image',['image_name'=>$post->image])}}" width='200px' height='200px'>
                            </div>
                            {{$post->post}}
                            </div>
                            <div>
                                @if($page->user_id==Auth::user()->id)
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
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
