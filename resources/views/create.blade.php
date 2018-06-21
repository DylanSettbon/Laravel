@extends('layouts.template')

@section('contenu')
    <div class="col-md-offset-1 col-md-10">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Création d'un groupe</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['url' => 'group', 'method' => 'post', 'class' => 'form-horizontal panel']) !!}	
					<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
					  	{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'titre']) !!}
					  	{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
						<table class="table">
							<thead>
								<th class="text-center">Sélectionner un ami</th>
								<th></th>
							</thead>
							@foreach($friends as $friend)
							<tbody>
								<td>{{$friend->name}}</td>
								<td>{!! Form::checkbox('friends[]', $friend->id)!!}</td>
							</tbody>
							@endforeach
						</table>
					</div>
					</div>
					{!! Form::submit('Envoyer', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
					<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
				


@stop