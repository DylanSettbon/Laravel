@extends('layouts.template')

@section('contenu')
    <div class="col-md-offset-1 col-md-10">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Modification d'un groupe</div>
			<div class="panel-body"> 
				<div class="col-sm-12">
					{!! Form::open(['url' => 'update',  'class' => 'form-horizontal panel']) !!}
					<div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
					  	{!! Form::text('title', $group->title, ['class' => 'form-control', 'placeholder' => 'Titre']) !!}
					  	{!! Form::hidden('id', $group->id, ['class' => 'form-control'] ) !!}
					  	{!! $errors->first('title', '<small class="help-block">:message</small>') !!}
					</div>
				
					</div>
						{!! Form::submit('Sauvegarder', ['class' => 'btn btn-primary pull-right']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@stop


