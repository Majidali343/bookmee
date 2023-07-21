<?php

namespace App\Http\Controllers;

use App\Country;
use App\Helpers\FlashMsg;
use App\ProductCategory;
use App\Products;
use App\ServiceArea;
use App\ServiceCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ImportCsvController extends Controller
{
//    country import
    public function import_settings(Request $request)
    {
        return view('backend.pages.location.country_import');
    }

    public function update_import_settings(Request $request)
    {
        $this->validate($request, [
            'csv_file' => 'required|file|mimes:csv,txt|max:150000'
        ]);

        // TODO:: work on file mapping
        if ($request->hasFile('csv_file')) {
            $file = $request->csv_file;
            $extenstion = $file->getClientOriginalExtension();
            if ($extenstion == 'csv') {
                //copy file to temp folder

                $old_file = Session::get('import_csv_file_name');
                if (file_exists('assets/uploads/import/' . $old_file)) {
                    @unlink('assets/uploads/import/' . $old_file);
                }
                $file_name_with_ext = $file->getClientOriginalName();

                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_tmp_name = $file_name . time() . '.' . $extenstion;
                $file->move('assets/uploads/import', $file_tmp_name);

                $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));
                $csv_data = array_slice($data, 0, 1);

                Session::put('import_csv_file_name', $file_tmp_name);

                return view('backend.pages.location.country_import', [
                    'import_data' => $csv_data,
                ]);
            }

        }
        return back()->with(['msg' => __('something went wrong try again!'), 'type' => 'danger']);
    }

    public function import_to_database_settings(Request $request)
    {
        $file_tmp_name = Session::get('import_csv_file_name');
        $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));

        $csv_data = current(array_slice($data, 0, 1));
        $csv_data = array_map(function ($item) {
            return trim($item);
        }, $csv_data);

        $imported_countries = 0;
        $x = 0;
        $country = array_search($request->country, $csv_data, true);

        foreach ($data as $index => $item) {
            if($x == 0){
                $x++;
                continue ;
            }
            $find_country = Country::where('country', $item[$country] )->count();

            if ($find_country < 1) {
                $country_data = [
                    'country' => $item[$country] ?? '',
                    'status' => $request->status,
                ];
            }
            if ($find_country < 1) {
                Country::create($country_data);
                $imported_countries++;
            }
        }
        return redirect()->route('admin.import.csv.settings')->with(FlashMsg::item_new($imported_countries.' '. __('Countries imported successfully')));
    }

//    city import
    public function city_import_settings(Request $request)
    {
        return view('backend.pages.location.city_import');
    }

    public function city_update_import_settings(Request $request)
    {
        $this->validate($request, [
            'csv_file' => 'required|file|mimes:csv,txt|max:150000'
        ]);

        // TODO:: work on file mapping
        if ($request->hasFile('csv_file')) {
            $file = $request->csv_file;
            $extenstion = $file->getClientOriginalExtension();
            if ($extenstion == 'csv') {
                //copy file to temp folder

                $old_file = Session::get('import_csv_file_name');
                if (file_exists('assets/uploads/import/' . $old_file)) {
                    @unlink('assets/uploads/import/' . $old_file);
                }
                $file_name_with_ext = $file->getClientOriginalName();

                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_tmp_name = $file_name . time() . '.' . $extenstion;
                $file->move('assets/uploads/import', $file_tmp_name);

                $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));
                $csv_data = array_slice($data, 0, 1);

                Session::put('import_csv_file_name', $file_tmp_name);

                return view('backend.pages.location.city_import', [
                    'import_data' => $csv_data,
                ]);
            }

        }
        return back()->with(['msg' => __('something went wrong try again!'), 'type' => 'danger']);
    }

    public function city_import_to_database_settings(Request $request)
    {
        $file_tmp_name = Session::get('import_csv_file_name');
        $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));

        $csv_data = current(array_slice($data, 0, 1));
        $csv_data = array_map(function ($item) {
            return trim($item);
        }, $csv_data);

        $imported_cities = 0;
        $x = 0;
        $city = array_search($request->city, $csv_data, true);

        foreach ($data as $index => $item) {
            if($x == 0){
                $x++;
                continue ;
            }
            if ($index === 0) {
                continue;
            }
            if (empty($item[$city])){
                continue;
            }

            $find_city = ServiceCity::where('service_city', $item[$city])->where('country_id', $request->country_id)->count();

            if ($find_city < 1) {
                $city_data = [
                    'service_city' => $item[$city] ?? '',
                    'country_id' => $request->country_id,
                    'status' => $request->status,
                ];
            }
            if ($find_city < 1) {
                ServiceCity::create($city_data);
                $imported_cities++;
            }
        }
        return redirect()->route('admin.import.city.csv.settings')->with(FlashMsg::item_new($imported_cities.' '. __('Cities imported successfully')));
    }

    //    area import
    public function area_import_settings(Request $request)
    {
        return view('backend.pages.location.area_import');
    }

    public function area_update_import_settings(Request $request)
    {
        $this->validate($request, [
            'csv_file' => 'required|file|mimes:csv,txt|max:150000'
        ]);

        // TODO:: work on file mapping
        if ($request->hasFile('csv_file')) {
            $file = $request->csv_file;
            $extenstion = $file->getClientOriginalExtension();
            if ($extenstion == 'csv') {
                //copy file to temp folder

                $old_file = Session::get('import_csv_file_name');
                if (file_exists('assets/uploads/import/' . $old_file)) {
                    @unlink('assets/uploads/import/' . $old_file);
                }
                $file_name_with_ext = $file->getClientOriginalName();

                $file_name = pathinfo($file_name_with_ext, PATHINFO_FILENAME);
                $file_name = strtolower(Str::slug($file_name));

                $file_tmp_name = $file_name . time() . '.' . $extenstion;
                $file->move('assets/uploads/import', $file_tmp_name);

                $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));
                $csv_data = array_slice($data, 0, 1);

                Session::put('import_csv_file_name', $file_tmp_name);

                return view('backend.pages.location.area_import', [
                    'import_data' => $csv_data,
                ]);
            }

        }
        return back()->with(['msg' => __('something went wrong try again!'), 'type' => 'danger']);
    }

    public function area_import_to_database_settings(Request $request)
    {
        $file_tmp_name = Session::get('import_csv_file_name');
        $data = array_map('str_getcsv', file('assets/uploads/import/' . $file_tmp_name));

        $csv_data = current(array_slice($data, 0, 1));
        $csv_data = array_map(function ($item) {
            return trim($item);
        }, $csv_data);

        $imported_areas = 0;
        $x = 0;
        $area = array_search($request->area, $csv_data, true);

        foreach ($data as $index => $item) {
            if($x == 0){
                $x++;
                continue ;
            }
            if ($index === 0) {
                continue;
            }
            if (empty($item[$area])){
                continue;
            }

            $find_area = ServiceArea::where('service_area', $item[$area])
                ->where('country_id', $request->country_id)
                ->where('service_city_id', $request->service_city_id)
                ->count();

            if ($find_area < 1) {
                $area_data = [
                    'service_area' => $item[$area] ?? '',
                    'country_id' => $request->country_id,
                    'service_city_id' => $request->service_city_id,
                    'status' => $request->status,
                ];
            }
            if ($find_area < 1) {
                ServiceArea::create($area_data);
                $imported_areas++;
            }
        }
        return redirect()->route('admin.import.area.csv.settings')->with(FlashMsg::item_new($imported_areas.' '. __('Areas imported successfully')));
    }

    // get city by country
    public function area_import_country_by_city(Request $request)
    {
        $cities = ServiceCity::where('country_id', $request->country_id)->where('status', 1)->get();
        return response()->json([
            'status' => 'success',
            'cities' => $cities,
        ]);
    }
}
