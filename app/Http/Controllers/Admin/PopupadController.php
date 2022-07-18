<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Popupad;
use Illuminate\Http\Request;
use Image;

class PopupadController extends Controller
{
    protected $popupad;
    public function __construct(Popupad $popupad)
    {
        $this->popupad = $popupad;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = $this->popupad->orderBy('created_at', 'desc')->get();
        return view('admin.popupad.list', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.popupad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png,gif|max:3048|required',
        ]);
        $formInput = $request->except(['image', 'published']);
        if ($request->image) {
            $image = $this->imageProcessing($request->file('image'));
            $formInput['image'] = $image;
        }
        $formInput['published'] = is_null($request->published) ? 0 : 1;
        $success = $this->popupad->create($formInput);
        if ($success) {
            $request->session()->flash('message', 'Pop up image added successfully');
            return redirect()->route('popupad.index');
        } else {
            $request->session()->flash('error', 'There is something wrong');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail = $this->popupad->findOrFail($id);
        return view('admin.popupad.edit', compact('detail'));
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
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png,gif|max:3048',
        ]);
        $oldRecord = $this->popupad->findOrFail($id);
        $formInput = $request->except(['image', 'published']);
        $formInput['published'] = is_null($request->published) ? 0 : 1;
        if ($request->hasFile('image')) {
            if ($oldRecord->image) {
                $this->unlinkImage($oldRecord->image);
            }
            $formInput['image'] = $this->imageProcessing($request->image);
        }
        $success = $oldRecord->update($formInput);
        if ($success) {
            $request->session()->flash('message', 'Pop up image updated successfully');
            return redirect()->route('popupad.index');
        } else {
            $request->session()->flash('error', 'There is something wrong');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $oldRecord = $this->popupad->findOrFail($id);
        if ($oldRecord->image) {
            $this->unlinkImage($oldRecord->image);
        }
        $success = $oldRecord->delete();
        if ($success) {
            $request->session()->flash('success', 'Pop up image deleted successfully');
            return redirect()->route('popupad.index');
        } else {
            $request->session()->flash('error', 'There is something wrong');
            return redirect()->back();
        }
    }
    public function imageProcessing($image)
    {
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        $listingpath = public_path('images/listing');
        $mainpath = public_path('images/main');
        $img = Image::make($image->getRealPath());
        $img->fit(100, 100)->save($thumbPath . '/' . $input['imagename']);
        $img1 = Image::make($image->getRealPath());
        $img1->fit(252, 172)->save($listingpath . '/' . $input['imagename']);
        $img2 = Image::make($image->getRealPath());
        $img2->save($mainpath . '/' . $input['imagename']);
        return $input['imagename'];
    }
    public function unlinkImage($imagename)
    {
        $thumbPath = public_path('images/thumbnail/') . $imagename;
        $mainPath = public_path('images/main/') . $imagename;
        $listingPath = public_path('images/listing/') . $imagename;
        $images = public_path('images/') . $imagename;
        if (file_exists($thumbPath)) {
            unlink($thumbPath);
        }
        if (file_exists($images)) {
            unlink($images);
        }

        if (file_exists($mainPath)) {
            unlink($mainPath);
        }

        if (file_exists($listingPath)) {
            unlink($listingPath);
        }
        return;
    }
}
