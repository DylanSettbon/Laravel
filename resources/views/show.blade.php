@extends('layouts.template')

@section('contenu')
   <div class="col-md-offset-1 col-md-10">
    	<br>
		<div class="panel panel-primary">	
			<div class="panel-heading">Fiche de groupe</div>
			<div class="panel-body"> 
				<p>Titre : {{ $group->title }}</p>
				<table class="table">
							<thead>
								
								<th class="text-center">Amis dans le groupe</th>
								<th></th>
							</thead>
							@foreach($friends as $friend)
							<tbody>
								<td>{{$friend->name}}</td>
								<td></td>
							</tbody>
							@endforeach
						</table>
			</div>
		</div>				
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span> Retour
		</a>
	</div>
@stop