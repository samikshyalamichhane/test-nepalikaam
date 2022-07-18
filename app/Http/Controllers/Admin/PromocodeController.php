<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\Promocode\PromocodeRepository;
use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
   private $promocode;
   private $user;
   private $dashboard;

   public function __construct(PromocodeRepository $promocode, UserRepository $user, DashboardRepository $dashboard)
   {
      $this->promocode = $promocode;
      $this->user = $user;
      $this->dashboard = $dashboard;
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $datas['details'] = $this->promocode->orderBy('created_at', 'DESC')->get();
      return view('admin.promocode.list', $datas);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
      $datas['users'] = $this->user->where('role', 'client')->get();
      return view('admin.promocode.create', $datas);
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $dashboard_composer = $this->dashboard->first();

      $request->validate([
         'promo_code' => 'required|string|unique:promocodes,promo_code',
         'discounted_amount' => 'nullable|numeric|lte:' . $dashboard_composer->service_charge . '|gt: 1',
      ]);
      try {

         $formData = $request->except('users', 'publish');
         $formData['publish'] = is_null($request->publish) ? 0 : 1;
         $promocode = $this->promocode->create($formData);

         $id = $promocode->id;

         if ($request->has('users')) {
            $this->promocode->store__promocode_user_table($id, $request->users);
         }

         return redirect()->route('promocode.index')->with('message', 'promocode Added Successfully');
      } catch (\Exception $e) {
         return redirect()->back()->with('message', $e->getMessage());
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
      $datas['users'] = $this->user->where('role', 'client')->get();
      $datas['detail'] = $this->promocode->find($id);
      return view('admin.promocode.edit', $datas);
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
      $dashboard_composer = $this->dashboard->first();
      $request->validate([
         'promo_code' => 'required|string|unique:promocodes,promo_code,' . $id,
         'discounted_amount' => 'nullable|numeric|lte:' . $dashboard_composer->service_charge . '|gt: 1',
      ]);
      try {

         $formData = $request->except('users', 'publish');
         $formData['publish'] = is_null($request->publish) ? 0 : 1;
         $this->promocode->update($formData, $id);

         if ($request->has('users')) {
            $this->promocode->update__promocode_user_table($id, $request->users);
         }

         return redirect()->route('promocode.index')->with('message', 'promocode updated Successfully');
      } catch (\Exception $e) {
         return redirect()->back()->with('message', $e->getMessage());
      }
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      $this->promocode->findOrFail($id)->delete();
      return redirect()->route('promocode.index')->with('message', 'promocode deleted successfully');
   }
}
