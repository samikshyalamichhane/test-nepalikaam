<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use App\Models\Rate;
use App\Repositories\Dashboard\DashboardRepository;
use Illuminate\Http\Request;
use Image;

class DashboardController extends Controller
{
    public function __construct(DashboardRepository $dashboard)
    {
        $this->dashboard = $dashboard;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = $this->dashboard->first();
        return view('admin.dashboard', compact('detail'));
    }

    public function changeRate(){
        $detail = $this->dashboard->first();
        return view('admin.rate', compact('detail'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $request->validate([
            'discounted_amount' => 'nullable|lte:service_charge'
        ]);

        $data = $request->except('image');
        if ($request->image) {
            $image = $this->imageProcessing($request->file('image'));
            $data['image'] = $image;
        }
        $this->dashboard->update($data, $id);
        // $dashboard = Dashboard::first();
        // $data = [
        //     'rate' => $dashboard->rate,
        //     'created_at' => $dashboard->created_at,
        //     'updated_at' => $dashboard->updated_at,
        // ];
        // Rate::create($data);
        return redirect()->back()->with('message', 'Dashboard Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function imageProcessing($image)
    {
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
        $thumbPath = public_path('images/thumbnail');
        $listingPath = public_path('images/listing');
        $mainPath = public_path('images/main');

        $img = Image::make($image->getRealPath());
        $img->fit(290, 225)->save($listingPath . '/' . $input['imagename']);

        $img = Image::make($image->getRealPath());
        $image->move($mainPath, $input['imagename']);
        $destinationPath = public_path('/images');
        return $input['imagename'];
    }
    public function storechangerate(Request $request)
    {
        $request->validate([
            'rate'=>'required',
            'offerprice'=>'required|required_with:offerrate',
            'offerrate'=>'required|required_with:offerprice',
        ]);
        $data = [
            'rate' => $request->rate,
            'offer_rate'=>$request->offerrate??0,
            'offer_price'=>$request->offerprice??0,
        ];
        Rate::create($data);
        return redirect()->back()->with('message', 'Rate Updated Successfully');
    }

    public function updateTransactionStatus(Request $request)
    {
        $data = $request->except('submit__transaction');
        $data['submit__transaction'] = is_null($request->submit__transaction) ? 0 : 1;
        $this->dashboard->update($data, $request->id);
        return redirect()->back()->with('message', 'TransactionStatus Updated Successfully');
    }
}
