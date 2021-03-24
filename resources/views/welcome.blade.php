<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Sykes Holiday Search</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       </head>
    <body class="antialiased">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Sykes Holiday Search</div>
        
                        <form action="{{ route('filter') }}" method="GET" style="margin-top: 20px;">
                        
                        <div class="form-group">
                            <input type="text" name="location" id="location" class="form-control" placeholder="Holiday Location" />
                        </div>
                        <select name="beach" id="input">
                            <option selected value="0" selected="selected">Near Beachfront</option>
                            <option  {{ 1 == $selected_id['beach'] ? 'selected' : '' }}>
                            Yes
                            </option>
                            <option  {{ 0 == $selected_id['beach'] ? 'selected' : '' }}>
                            No
                            </option>
                        </select>
                        <select name="pets" id="input">
                            <option selected value="0" selected="selected">Dogs</option>
                            <option {{ 1 == $selected_id['pets'] ? 'selected' : '' }}>
                            Yes
                            </option>
                            <option {{ 0 == $selected_id['pets'] ? 'selected' : '' }}>
                            No
                            </option>
                        </select>
                        <select name="sleeps" id="input">
                            <option value="0">Sleeps</option>
                            @foreach (\App\Models\Property::select('__pk','sleeps')->get() as $property)
                            <option value="{{ $property->sleeps }}" {{ $property->sleeps == $selected_id['sleeps'] ? 'selected' : '' }}>
                            {{ $property['sleeps'] }}
                            </option>
                            @endforeach
                        </select>
                        <select name="beds" id="input">
                            <option value="0">Beds</option>
                            @foreach (\App\Models\Property::select('__pk','beds')->get() as $property)
                            <option value="{{ $property->beds }}" {{ $property->beds == $selected_id['beds'] ? 'selected' : '' }}>
                            {{ $property['beds'] }}
                            </option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-danger btn-sm" value="Filter">
                        </form>
                    
                    
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Sleeps</th>
                                    <th>Beds</th>
                                    <th>Pets</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($product as $p )
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $p->property_name }}</td>
                                    <td>{{ $p->sleeps }}</td>
                                    <td>{{ $p->beds }}</td>
                                    <td>{{ $p->accepts_pets }}</td>
                                </tr>
                                @empty
                                <p> No data Found </p>
                                @endforelse
        
                            </tbody>
                        </table>
                        {{ $product->links() }}
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>