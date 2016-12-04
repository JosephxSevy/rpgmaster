@extends("layouts.page")

@section("content")

	<div class="content">
    	<h1>My Characters</h1>
			<table class="table table-stripped">
				<thead>
					<tr>
						<th> Name </th>
						<th> Race </th>
						<th> Class </th>
						<th> </th>
					</tr>
				</thead>
				@foreach($characters as $character)
					<tr>
						<td>{!! $character["name"] !!}</td>
						<td>{!! $character["race"] !!}</td>
						<td>{!! $character["class"] !!}</td>
						<td> <a href="{!! url("character/edit?character_id=".$character->character_id) !!}" class="btn btn-info">Edit</a> </td>
					</tr>
	      @endforeach
			</table>

			<a href="{!! url('character/new') !!}" class="btn btn-success">New Character</a>
	</div>
@endsection
