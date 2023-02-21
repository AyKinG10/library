
@extends('layouts.adm')

@section('title', 'Comments Page ')

@section('content')
    <h1>Role Page</h1>
    <h3><a class=" btn btn-outline-dark" href="{{route('adm.roles.create')}}">{{__('adm.Role_page')}}</a></h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('adm.name')}}</th>
        </tr>
        </thead>
        @foreach($roles as $role)
            <tr>
                <th scope="row">{{$role->id}}</th>
                <td>{{$role->name}}</td>
                <td>
                    <form action="{{route('adm.roles.destroy', $role->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary btn-lg">{{__('adm.delete')}}</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
