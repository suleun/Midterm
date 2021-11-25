<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Company;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

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

        // dd($data);

        // 요청정보에서($request) 필요한 데이터를 꺼내 DB에 저장
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
        //
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
