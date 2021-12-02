<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Company;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);

    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
           1. DB에서 리스트를 가져온다.
           2. 그 리스트를 블레이드 컴포넌트에게 전달한다.
        */

        // $cars = Car::all();

        $cars = Car::latest()->paginate(5);

        return view('components.cars.index', ['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('components.cars.register-car', ['companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $now = now();
        $now->year;

        // 자동차 정보 저장에 필요한 데이터가 모두, 적절한 형태로 왔는지 정당성 검사 수행
       $data =  $request->validate([
            'image'=>'required|image',
            'name'=>'required',
            'company_id'=>'required',
            'year'=>'required|numeric|min:1800|max:'.($now->year+1),
            'price'=>'required|numeric|min:1',
            'type'=>'required',
            'style'=>'required'
        ]);

        // 이미지를 파일 시스템의 특정 위치에 저장
        $path = $request->image->store('images', 'public');

        // 요청정보에서($request) 필요한 데이터를 꺼내 DB에 저장
        $data = array_merge($data, ['image'=>$path]);

        Car::create($data);


        // 리다이렉션(서버에 데이터 변경한뒤 요청을 보낼 때 쓰는 것)해서 index를 보여준다.
        return redirect()->route('cars.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        // 상세보기 페이지
        // compact는 ['car'=>$car]
        return view('components.cars.car-show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $companies =Company::all();

        return view('components.cars.car-edit',
        compact(['car', 'companies']) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $now = now();
        $now->year;

        // 자동차 정보 저장에 필요한 데이터가 모두, 적절한 형태로 왔는지 정당성 검사 수행
       $data =  $request->validate([
            'image'=>'image',
            'name'=>'required',
            'company_id'=>'required',
            'year'=>'required|numeric|min:1800|max:'.($now->year+1),
            'price'=>'required|numeric|min:1',
            'type'=>'required',
            'style'=>'required'
        ]);

        $path=null;

        if($request->image){ // 기존 이미지를 변경하고자 하는 경우
            // 기존파일 삭제
            Storage::delete($car->image);

            // 이미지를 파일 시스템의 특정 위치에 저장
            $path = $request->image->store('images', 'public');

        }

        if($path != null){

        // 요청정보에서($request) 필요한 데이터를 꺼내 DB에 저장
        $data = array_merge($data, ['image'=>$path]);

        }
        // update set name=?, style=?, ...
        // from cars where id = ?
        $car->update($data);


        // 리다이렉션(서버에 데이터 변경한뒤 요청을 보낼 때 쓰는 것)해서 index를 보여준다.
        return redirect()->route('cars.show');

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

}
