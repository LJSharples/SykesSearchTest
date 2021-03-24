<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    //

    public function search(Request $request){
        if($request->ajax()){
            $output = '';
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('locations')
                    ->where('location_name', 'like', '%'.$query.'%')
                    ->get();
            
            }else{
                $data = DB::table('locations')
                    ->orderBy('location_name', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if($total_row > 0){
                foreach($data as $row){
                    $output .= '
                    <tr>
                    <td>'.$row->location_name.'</td>
                    </tr>
                    ';
                }
            }else{
                $output = '
                <tr>
                    <td align="center" colspan="5">No Data Found</td>
                </tr>
                ';
            }
            $data = array(
            'table_data'  => $output,
            'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
}
