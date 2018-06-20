@extends('layouts.layout')

@section('content')
    <a href="{{ url('/friends') }}">Ma liste d'amis</a>
    <a href="{{ url('/addedFriends') }}">Mes demandes en attentes</a>

    @if(isset($users))
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Accepter</th>
                    <th scope="col">Refuser</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                    <tr>
                        <th scope="row">{{ $key +1}}</th>
                        <td>{{$user->name}}</td>
                        <td><a href="{{ url('acceptFriend/'.$user->id) }}">Accept</a></td>
                    </tr>
                @endforeach
                <tbody>
            </table>
    @else
        <p>Aucune demande en attente</p>
    @endif


    @if(isset($error))
        <p><{{ $error }}</p>
    @endif
@endsection