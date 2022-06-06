<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use DB, Session;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = CmsPage::orderBy('order')->get();
        return view('cms.index', compact('pages')); 
    }

    public function page($slug)
    {
        $title = CmsPage::where('slug',$slug)->value('title');
        $content1 = CmsPage::where('slug',$slug)->value('content1');
        $content2 = CmsPage::where('slug',$slug)->value('content2');
        return view('cms.page', compact('title','content1','content2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Conference::class);
        return view('cms.create')->with('create', true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $this->authorize('create',Conference::class);
        $v = [
            'title'        => 'required',
            'title_nav'    => 'required',
            'slug'         => 'required',
            'content1'     => 'required'
          ];
          $validated = $request->validate($v);
          
          CmsPage::create([
              'title'       => $request['title'],
              'title_nav'   => $request['title_nav'],
              'slug'        => $request['slug'],
              'content1'    => $request['content1'],
              'content2'    => null,
          ]);
          Session::flash('success', __('cms.saved'));
          return redirect('cms-pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pages = CmsPage::find($id);
        return view('cms.edit',compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $v = [
            'title'        => 'required',
            'title_nav'    => 'required',
            'slug'         => 'required',
            'content1'     => 'required',
            'status'       => 'nullable'
          ];
          $validated = $request->validate($v);
      
          $c = CmsPage::find($id);
          $c->title = $request->title;
          $c->title_nav = $request->title_nav;
          $c->slug = $request->slug;
          $c->content1 = $request->content1;
          $c->status = ($request->status == 1) ? 1 : 0;
      
          try {
            $c->save();
            Session::flash('success', __('cms.saved'));
            return redirect('cms-pages');
          } catch (\Exception $e) {
            Session::flash('failure', $e->getMessage());
            return redirect()->back()->withInput();
          }
    }

    public function sort(Request $request) 
    {
        $i = 1;
        foreach ($request['page_id'] as $key => $id)
        {
            CmsPage::where('id',$id)->update([
                'order'  => $i++,
                'status' => ($request['status'][$key] == 1) ? 1 : 0
            ]);
        }
        Session::flash('success', __('cms.order_created'));
        return redirect('cms-pages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CmsPage::find($id)->delete();
        Session::flash('success', __('cms.deleted'));
        return redirect('cms-pages');
    }
}
