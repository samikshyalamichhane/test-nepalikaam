<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Receiver;
use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $details = User::findOrFail(auth()->user()->id)->transactions()->get();
        // $datas = $details->unique('full_name');
        // $datas = $details->unique('account_holder_name');
        // $details = $datas->values()->all();
        // return view('front.receiver.list', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
        $data = Receiver::findOrFail($id);
        return view('front.receiver.edit', compact('data'));
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
        // dd($request->all());
        $request->validate([
            'contact_number' => 'required',
        ]);

        if ($request->type == 'Bank-Deposit') {
            $request->validate([
                'account_number' => 'required',
                'account_holder_name' => 'required',
                'bank_name' => 'required',
                'bank_branch' => 'required',
            ]);
        } else {
            $request->validate([
                'pick_up_district' => 'required',
                'full_name' => 'required',
            ]);
        }
        $oldRecord = Receiver::findOrFail($id);
        $formInput = $request->all();
        $oldRecord->update($formInput);
        return redirect()->route('receiver.index')->with('message', 'Receiver info updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Receiver::findOrFail($id)->delete();
        return redirect()->back()->with('message', 'Receiver deleted succesfully');
    }
}
