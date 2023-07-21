<?php

namespace App\Http\Controllers;

use App\BlogCategory;
use App\Blog;
use App\Contribution;
use App\Counterup;
use App\Event;
use App\EventCategory;
use App\Gallery;
use App\GalleryCategory;
use App\HeaderSlider;
use App\KeyFeatures;
use App\Language;

use App\Newsletter;
use App\Page;
use App\StaticOption;
use App\Tag;
use App\Testimonial;
use App\TopbarInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:language-list|language-edit|language-create|language-delete', ['only' => ['index', 'make_default']]);
        $this->middleware('permission:language-create', ['only' => ['store']]);
        $this->middleware('permission:language-edit', ['only' => ['backend_edit_words', 'frontend_edit_words', 'update_words', 'update', 'add_new_string', 'clone']]);
        $this->middleware('permission:language-delete', ['only' => ['delete']]);
    }

    public function index()
    {
        $all_lang = Language::all();
        return view('backend.languages.index')->with([
            'all_lang' => $all_lang
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string:max:191',
            'direction' => 'required|string:max:191',
            'slug' => 'required|string:max:191|unique:languages,slug',
            'status' => 'required|string:max:191',
        ]);

        Language::create([
            'name' => $request->name,
            'direction' => $request->direction,
            'slug' => $request->slug,
            'status' => $request->status,
            'default' => 0
        ]);

        //generate admin panel string
        $backend_default_lang_data = file_get_contents(resource_path('lang/') . 'default.json');
        file_put_contents(resource_path('lang/') . $request->slug . '.json', $backend_default_lang_data);

        return redirect()->back()->with([
            'msg' => __('New Language Added Success...'),
            'type' => 'success'
        ]);
    }

    public function all_edit_words($slug)
    {
        $backend_lang_file_path = resource_path('lang/') . $slug . '.json';
        if (!file_exists($backend_lang_file_path) && !is_dir($backend_lang_file_path)) {
            file_put_contents(resource_path('lang/') . $slug . '.json', file_get_contents(resource_path('lang/') . 'default.json'));
        }

        $all_word = file_get_contents(resource_path('lang/') . $slug . '.json');

        return view('backend.languages.edit-words')->with([
            'all_word' => json_decode($all_word),
            'lang_slug' => $slug,
            'type' => 'backend',
            'language' => Language::where('slug',$slug)->first()
        ]);
    }

    public function update_words(Request $request, $slug)
    {
        $this->validate($request,[
           'string_key' => 'required',
           'translate_word' => 'required',
        ],[
            'string_key.required' => __('select source text'),
            'translate_word.required' => __('add translate text'),
        ]);
        //todo get text json file
        //todo get current key index and replace it in the json file
        if (file_exists(resource_path('lang/') . $slug . '.json')) {
            $default_lang_data = file_get_contents(resource_path('lang') . '/'.$slug.'.json');
            $default_lang_data = (array)json_decode($default_lang_data);
            $default_lang_data[$request->string_key] = $request->translate_word;
            $default_lang_data = (object)$default_lang_data;
            $default_lang_data = json_encode($default_lang_data);
            file_put_contents(resource_path('lang/') . $slug . '.json', $default_lang_data);
        }
        
        if($request->ajax()){
              return response()->json(['msg' => __('Words Change Success'), 'type' => 'success']);
        }
        
        return back()->with(['msg' => __('Words Change Success'), 'type' => 'success']);
        
        
        
    }
    public function regenerate_source_text(Request $request){
        //
        $this->validate($request,[
            'slug' => 'required'
        ]);
        if (file_exists(resource_path('lang/') . $request->slug . '.json')){
            @unlink(resource_path('lang/') . $request->slug . '.json');
        }
        Artisan::call('translatable:export '.$request->slug);
        return back()->with(['msg' => __('Source text generate success'), 'type' => 'success']);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string:max:191',
            'direction' => 'required|string:max:191',
            'status' => 'required|string:max:191',
            'slug' => 'required|string:max:191'
        ]);
        Language::where('id', $request->id)->update([
            'name' => $request->name,
            'direction' => $request->direction,
            'status' => $request->status,
            'slug' => $request->slug
        ]);
        $backend_lang_file_path = resource_path('lang/') . $request->slug . '.json';

        if (!file_exists($backend_lang_file_path) && !is_dir($backend_lang_file_path)) {
            file_put_contents(resource_path('lang/') . $request->slug . '.json', file_get_contents(resource_path('lang/') . 'default.json'));
        }


        return redirect()->back()->with([
            'msg' => __('Language Update Success...'),
            'type' => 'success'
        ]);
    }

    public function delete(Request $request, $id)
    {

        $lang = Language::find($id);
       
        $lang->delete();
        if (file_exists(resource_path('lang/') .'.json')) {
            unlink(resource_path('lang/') .'.json');
        }
        return redirect()->back()->with([
            'msg' => __('Language Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function make_default(Request $request, $id)
    {
        Language::where('default', 1)->update(['default' => 0]);
        Language::find($id)->update(['default' => 1]);
        $lang = Language::find($id);
        $lang->default = 1;
        $lang->save();
        session()->put('lang', $lang->slug);
        return redirect()->back()->with([
            'msg' => __('Default Language Set To') . ' ' . $lang->name,
            'type' => 'success'
        ]);
    }

    public function clone_languages(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|string',
            'direction' => 'required|string',
            'status' => 'required|string',
            'slug' => 'required|string',
        ]);

        $clone_lang = Language::find($request->id);
        Language::create([
            'name' => $request->name,
            'direction' => $request->direction,
            'slug' => $request->slug,
            'status' => $request->status,
            'default' => 0
        ]);

        $backend_default_lang_data = file_get_contents(resource_path('lang') . '/' . $clone_lang->slug . '.json');
        file_put_contents(resource_path('lang/') . $request->slug . '.json', $backend_default_lang_data);


        return redirect()->back()->with([
            'msg' => __('Language clone success with content...'),
            'type' => 'success'
        ]);
    }


    public function add_new_words(Request $request)
    {

        $this->validate($request, [
            'lang_slug' => 'required|string',
            'new_string' => 'required|string',
            'translate_string' => 'required|string',
        ]);
        if (file_exists(resource_path('lang/') . $request->lang_slug . '.json')) {
             $default_lang_data = file_get_contents(resource_path('lang') . '/'.$request->lang_slug.'.json');
            $default_lang_data = (array)json_decode($default_lang_data);
            $default_lang_data[$request->new_string] = $request->translate_string;
            $default_lang_data = (object)$default_lang_data;
            $default_lang_data = json_encode($default_lang_data);
            file_put_contents(resource_path('lang/') . $request->lang_slug . '.json', $default_lang_data);
        }
        return back()->with(['msg' => __('New Word Added'), 'type' => 'success']);
    }


}
