@extends('layouts.adm')
@section('title', 'Categories Page')
@section('content')
    <h3>{{__('adm.Categories_page')}}</h3>
    <h3><a class=" btn btn-outline-dark" href="{{route('adm.categories.create')}}">{{__('adm.createCategory')}}</a></h3>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('adm.name')}}</th>
            <th scope="col">{{__('adm.code')}}</th>
            <th scope="col">{{__('adm.name_kz')}}</th>
            <th scope="col">{{__('adm.name_ru')}}</th>
            <th scope="col">{{__('adm.name_en')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $cat)
            <tr>
            <th scope="row">{{$cat->id}}</th>
            <td>{{$cat->name}}</td>
            <td>{{$cat->code}}</td>
            <td>{{$cat->name_kz}}</td>
            <td>{{$cat->name_ru}}</td>
            <td>{{$cat->name_en}}</td>
            <td>
                <form action="{{route('adm.categories.destroy', $cat->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary btn-lg">{{__('adm.delete')}}</button>
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
