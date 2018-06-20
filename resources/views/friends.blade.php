@extends('layouts.layout')

@section('content')
    <a href="{{ url('/friends') }}">Ma liste d'amis</a>
    <a href="{{ url('/addedFriends') }}">Mes demandes en attentes</a>
    @if(isset($friends))
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Accepter</th>
            </tr>
            </thead>
            <tbody>
            @foreach($friends as $key=>$friend)
                <tr>
                    <th scope="row">{{ $key +1}}</th>
                    <td>{{$friend->name}}</td>
                    <td><a href="{{ url('sendMessage/'.$friend->id) }}">Envoyez un message</a></td>
                </tr>
            @endforeach
            <tbody>
        </table>
    @endif


    @if(isset($error))
        <p><{{ $error }}</p>
    @endif
@endsection