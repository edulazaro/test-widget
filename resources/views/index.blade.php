@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row pt-4">
        <div class="col-md-12 text-center">
			<h1>Weather Widget</h1>
			Demo with many instances of the same component
	  </div>
	</div>
	<div class="row pt-5">
	    <div class="col-md-4">
            @widget('Weather', ['id' => 'weather'])
		</div>
	    <div class="col-md-4">
            @widget('Weather', ['id' => 'weather2'])
		</div>
	    <div class="col-md-4">
            @widget('Weather', ['id' => 'weather3'])
        </div>
	  </div>
	</div>
</div>
@endsection