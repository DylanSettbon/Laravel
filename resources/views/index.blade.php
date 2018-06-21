@extends('layouts.template')

@section('contenu')
    <br>
    <div class="col-md-offset-1 col-md-10">
    	@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
		@endif
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des Groupes</h3>
				
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>Titre</th>
						<th></th>
						<th></th>
						<th><a href="/" class="btn btn-primary" style="float: right;">
					<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
				</a></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($groups as $group)
						<tr>
							<td class="text-primary"><strong>{!! $group->title !!}</strong></td>
							<td>{!! link_to_route('group.show', 'Voir', [$group->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! link_to_route('editGroup', 'Modifier', [$group->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								{!! Form::open(['method' => 'DELETE', 'route' => ['group.destroy', $group->id]]) !!}
									{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer ce groupe ?\')']) !!}
								{!! Form::close() !!}
							</td>
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		{!! link_to_route('group.create', 'Ajouter un groupe', [], ['class' => 'btn btn-info pull-right']) !!}
		{!! $links !!}

	</div>
@stop