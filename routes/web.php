<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Location;
use App\Models\Property;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function (Request $request) {
                //adapted from Hasan, M., 2021. Advanced Search Filter using Dropdown in Laravel. [online] Code Cheef. Available at: <https://www.codecheef.org/article/advanced-search-filter-using-dropdown-in-laravel> [Accessed 23 March 2021].
                $product = Property::where(function($query) use($request){
                        $location = Location::where('location_name', 'like', "%$request->location%")->first(['__pk']);
                        return $request->location ?
                        $query->where('_fk_location', $location->__pk) : '';
                })->where(function($query) use($request){
                        return $request->pets ?
                            $query->where('accepts_pets',$request->pets) : '';
                })->where(function($query) use($request){
                    return $request->beach ?
                           $query->where('near_beach',$request->beach) : '';
               })->where(function($query) use($request){
                     return $request->sleeps ?
                            $query->where('sleeps',$request->sleeps) : '';
                })->where(function($query) use($request){
                    return $request->beds ?
                           $query->where('beds',$request->beds) : '';
               })->where(function($query) use($request){
                    //bookings check
                })
                ->paginate(3);
     dump($product);
     dump(Property::where(function($query) use($request){
        $location = Location::where('location_name', 'like', "%$request->location%")->first(['__pk']);
        return $request->location ?
        $query->where('_fk_location', $location->__pk) : '';
    })->get());

    $bookings = Booking::all();
    foreach($product as $key => $p){
        foreach($bookings as $book){
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));   
            $startDate = date('Y-m-d', strtotime($book->start_date));
            $endDate = date('Y-m-d', strtotime($book->end_date));   
            if (($currentDate >= $startDate) && ($currentDate <= $endDate)){   
                if($p->__pk === $book->_fk_property){
                    $product->forget($key);
                }
            }
        }
    }

    $selected_id = [];
    $selected_id['location'] = $request->location;
    $selected_id['beach'] = $request->beach;
    $selected_id['pets'] = $request->pets;
    $selected_id['sleeps'] = $request->sleeps;
    $selected_id['beds'] = $request->beds;

    return view('welcome',compact('product','selected_id'));

})->name('filter');