
@extends('layouts.adm')

@section('title', 'Users Page ')

@section('content')
    <br>
    <h1 style="text-align: center">{{__('adm.Users_page')}}</h1>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('adm.name')}}</th>
            <th scope="col">{{__('adm.email')}}</th>
            <th scope="col">{{__('adm.role')}}</th>
            <th scope="col">{{__('adm.status')}}</th>
            <th scope="col">{{__('adm.edit')}}</th>
        </tr>
        </thead>
        @for($i=0;$i<count($users);$i++)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$users[$i]->name}}</td>
                <td>{{$users[$i]->email}}</td>
                <td>{{$users[$i]->role->name}}</td>
                <td>
                    <form action="
                    @if($users[$i]->is_active)
                        {{route('adm.users.ban',$users[$i]->id)}}
                    @else
                         {{route('adm.users.unban',$users[$i]->id)}}
                    @endif
                    " method="post">
                        @csrf
                        @method('PUT')
                        <button class="btn {{$users[$i]->is_active ? 'btn-success': 'btn-danger '}}" type="submit">
                                @if($users[$i]->is_active)
                                {{__('adm.ban')}}
                                @else
                                {{__('adm.unban')}}
                            @endif
                        </button>
                    </form>
                </td>
                <td><a class="btn btn-success" href="{{route('adm.users.edit',$users[$i]->id)}}">{{__('adm.editRole')}}</a></td>
            </tr>
        @endfor
    </table>
@endsection
