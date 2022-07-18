<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\Repositories\Slider\SliderRepository;


class SliderController extends Controller
{
    private $slider;
    public function __construct(SliderRepository $slider){
        $this->slider=$slider;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->slider->orderBy('created_at','desc')->get();
        
        return view('admin.slider.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, $this->rules());
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish)? 0 : 1;
        $this->slider->create($value);
        return redirect()->route('slider.index')->with('message','slider Added Successfully');
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
        $detail=$this->slider->find($id);
        return view('admin.slider.edit',compact('detail'));
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image=$this->slider->find($id);
        if($image->image){
            $mainPath=public_path('images/main');
            $thumbPath=public_path('images/thumbnail');
            $sizePath=public_path('images/size');
            $smallPath=public_path('images');
            if((file_exists($mainPath.'/'.$image->image)) &&(file_exists($thumbPath.'/'.$image->image)) &&(file_exists($sizePath.'/'.$image->image)) &&(file_exists($smallPath.'/'.$image->image)))
            {
                unlink($mainPath.'/'.$image->image);
                unlink($thumbPath.'/'.$image->image);
                unlink($sizePath.'/'.$image->image);
                unlink($smallPath.'/'.$image->image);
            }
        }
        $this->slider->destroy($id);
        return redirect()->route('slider.index')->with('message','Slider Deleted Successfully');
    }
    public function sliderProcess(Request $request){
        $message=['filename.dimensions'=>'image must be less than 2500*1800'];
        $validator = \Validator::make($request->all(), [
            'filename' => 'dimensions:max_width=2500,max_height=1800',
        
        ],$message);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $image=$request->file('filename');

        $data = getImageSize($image);
        $width = $data[0];
        $height = $data[1];

        $filename=time().'.'.$image->getClientOriginalName();
        $temp = public_path('images/main');
        $thumbImagePath = public_path('images/thumbnail/');
        $smallImagePath = public_path('images');
        $newPath=public_path('images/size');
        $image->move($temp, $filename);
        copy($temp . '/' . $filename, 'images' . '/thumbnail/' . $filename);

        $img=Image::make('images/main/' . $filename);
        $img1=Image::make('images/main/' . $filename);
        $img2=Image::make('images/main/' . $filename);

        $img->fit('1349', '451');
        $img->save($thumbImagePath . '/' . $filename);

        $img1->resize($width/2,$height/2);
        $img1->save($newPath . '/' . $filename);

        $img->fit('200', '100');
        $img->save($smallImagePath . '/' . $filename);

        $path=asset('images/main').'/'.$filename;

        $detail['name'] = $filename;
        $detail['success'] = 'success';
        $detail['path'] = asset('images' . '/main');
        
        return response()->json($detail);
    }
    public function cropmodal(Request $request){
        return view('admin.slider.jcrop')->with('image',$request->name);
    }
    public function cropprocess(Request $request){
        $image = $request->image;
        $thumbImagePath = public_path('images/thumbnail/');
        $x = $request->x*2;
        $y = $request->y*2;
        $w = $request->w*2;
        $h = $request->h*2;
        $img = Image::make('images/main/' . $image);

        $img->crop((int) $w, (int) $h, (int) $x, (int) $y);
        $img->save($thumbImagePath . '/' . $image);
        // $finalImage='images/temp/thumb'.$image;
        $finalImage = asset('images/thumbnail/' . $image);
        $image = '';

        return $finalImage;
    }
    public function updateSlider(Request $request,$id){
        // $this->validate($request, $this->rules());
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish) ? 0 : 1;
        $this->slider->update($value,$id);
        return redirect()->route('slider.index')->with('message','Slider Updated SuccessFully');
    }
    public function rules($oldId = null, $sameSlugVal=false){

        $rules =  [
            'title' => 'required',
        
        ];
        return $rules;
    }
}
