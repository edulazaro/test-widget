@push('scripts')
<script>
widget = new widgets.weatherWidget({ 
    id: '{{ $id }}',
});
</script>
@endpush

<div id="{{ $id }}" class="weather-widget container mx-auto w-100 p-3 mx-auto rounded">
    <div class="row">
        <div class="col-md-12" >
            <div class="form-group pt-2">
                <label for="{{ $id }}-city">City</label>
                <input  class="form-control" id="{{ $id }}-city" name="city" maxlength="400" placeholder="Type the city name here">
            </div>
        </div>
        <div class="col-md-12" >
            <div class="form-group pt-2">
                <label for="{{ $id }}-country">Country</label>
                <select class="form-control" id="{{ $id }}-country" name="country">
                    @foreach ($countries as $key => $country)
                        <option value="{{ $key }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>		
        </div>
        <div class="col-md-12" >
            <div class="form-group pt-2">
                <button type="button" class="btn btn-success" id="{{ $id }}-submit" name="button" >Submit</button>
                <img id="{{ $id }}-preloader" width="50px" class="preloader" src="img/preloader.gif" alt="Loading">
            </div>	
        </div>
    </div>
    <div class="row">
        <div id="{{ $id }}-results"  class="col-md-12">
        </div>
    </div>
</div>