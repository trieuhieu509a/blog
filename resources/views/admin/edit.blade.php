@extends('layouts.master')

@section('content')
    @include('partials.errors')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.update') }}" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="{{ $post->title }}">
                </div>
                @if(Auth::user()->role === 1)
                <div class="form-group">
                    <label for="content">Status</label>
                    <div class="custom-control custom-checkbox">
                        <input name="is_active"{{ $post->is_active === 1 ? ' checked="checked"' : ''  }} type="checkbox" value="1" class="custom-control-input" id="is_active">
                        <label class="custom-control-label" for="is_active">Active posts</label>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea
                            name="content"
                            id="content"
                            class="form-control"
                            cols="50" rows="10">{{ $post->content }}</textarea>
                </div>
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $post->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection