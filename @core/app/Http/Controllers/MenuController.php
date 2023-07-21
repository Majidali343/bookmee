<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Contribution;
use App\Event;
use App\Language;
use App\Menu;
use App\Page;
use App\Knowledgebase;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:appearance-menu-list|appearance-menu-create|appearance-menu-edit|appearance-menu-delete',['only' => ['index']]);
        $this->middleware('permission:appearance-menu-create',['only' => ['store_new_menu']]);
        $this->middleware('permission:appearance-menu-edit',['only' => ['edit_menu','update_menu','set_default_menu']]);
        $this->middleware('permission:appearance-menu-delete',['only' => ['delete_menu']]);
    }

    public function index()
    {
        $all_menu = Menu::all();
        return view('backend.pages.menu.menu-index')->with([
            'all_menu' => $all_menu
        ]);
    }

    public function store_new_menu(Request $request)
    {
        $this->validate($request, [
            'content' => 'nullable',
            'title' => 'required',
        ]);

        Menu::create([
            'content' => $request->page_content,
            'title' => $request->title,
        ]);

        return redirect()->back()->with([
            'msg' => __('New Menu Created...'),
            'type' => 'success'
        ]);
    }
    public function edit_menu($id)
    {
        $page_post = Menu::find($id);

        return view('backend.pages.menu.menu-edit')->with([
            'page_post' => $page_post
        ]);

    }
    public function update_menu(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'nullable',
            'title' => 'required',
        ]);
        Menu::where('id', $id)->update([
            'content' => $request->menu_content,
            'title' => $request->title,
        ]);

        return redirect()->back()->with([
            'msg' => __('Menu updated...'),
            'type' => 'success'
        ]);
    }

    public function delete_menu(Request $request, $id)
    {
        Menu::find($id)->delete();
        return redirect()->back()->with([
            'msg' => __('Menu Delete Success...'),
            'type' => 'danger'
        ]);
    }

    public function set_default_menu(Request $request, $id)
    {
        $lang = Menu::find($id);
        Menu::where(['status' => 'default'])->update(['status' => '']);

        Menu::find($id)->update(['status' => 'default']);
        $lang->status = 'default';
        $lang->save();
        return redirect()->back()->with([
            'msg' => __('Default Menu Set To') .' '. purify_html($lang->title),
            'type' => 'success'
        ]);
    }
    public function mega_menu_item_select_markup(Request $request){

        return render_mega_menu_item_select_markup($request->type,$request->menu_id);
    }

}
