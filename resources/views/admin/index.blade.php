@extends('layouts.master')

@section('content')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <a href="{{ route('admin.create') }}" class="btn btn-success">Create Post</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Post Name</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>
                            <strong>{{ $post->title }}</strong>
                        </td>
                        <td>
                            <span class="label {{ $post->is_active === 1 ? 'label-success' : 'label-default'  }}">{{ $post->is_active === 1 ? 'yes' : 'no'  }}</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal_{{ $post->id }}">View</button>
                            <a class="btn btn-primary" href="{{ route('admin.edit', ['id' => $post->id]) }}">Edit</a>

                            <div class="modal fade" id="myModal_{{ $post->id }}" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{ $post->title }}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>@parsedown($post->content)</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection