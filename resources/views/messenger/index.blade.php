@extends('layouts.layout')

@section('content')
    @include('messenger.partials.flash')

    @each('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads')

    <div class="media alert">
        <a>Créer une nouvelle conversation</a>
    </div>
@stop