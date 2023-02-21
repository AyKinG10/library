
@extends('layouts.adm')

@section('title', 'Comments Page ')

@section('content')
    <h1>Comments Page</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('adm.name')}}</th>
            <th scope="col">{{__('adm.content')}}</th>
            <th scope="col">{{__('adm.edit')}}</th>
        </tr>
        </thead>
        @foreach($comments as $comment)
            <tr>
                <th scope="row">{{$comment->id}}</th>
                <td>{{$comment->user->name}}</td>
                <td>{{$comment->content}}</td>
                <td>
                    <form action="{{route('adm.comments.destroy', $comment->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary btn-lg">{{__('adm.delete')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
