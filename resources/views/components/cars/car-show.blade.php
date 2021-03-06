<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CarShow') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-red-100">
        <div class="g-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <label for="image">자동차 이미지:</label>
                <img src="{{ $car->image }}">
                    <br/>

                    <label for="company">제조회사:</label>
                    <label for="company">{{ $car->company->name }}</label>
                    <br/>

                    <label for="name">자동차 명:</label>
                    <label for="name">{{ $car->name }}</label>
                    <br/>

                    <label for="year">제조년도:</label>
                    <label for="year">{{ $car->year }}</label>
                    <br/>

                    <label for="price">가격:</label>
                    <label for="price">{{ $car->price }}</label>
                    <br/>

                    <label for="type">차종:</label>
                    <label for="type">{{ $car->type }}</label>
                    <br/>

                    <label for="style">외형:</label>
                    <label for="style">{{ $car->style }}</label>
                    <br/>

                    <div class="flex justify-end">
                        <button onclick=location.href="{{ route('cars.index') }}" type="submit" class="bg-blue-400 rounded py-2 px-2 text-white mx-2">
                                목록보기
                        </button>

                        <button onclick=location.href="{{ route('cars.edit', ['car'=>$car->id]) }}" type="submit" class="bg-yellow-400 rounded py-2 px-2 text-white mx-2">
                            수정하기
                        </button>

                        <button onclick=location.href="{{ route('cars.destroy', ['car'=>$car->id]) }}" type="submit" class="bg-red-400 rounded py-2 px-2 text-white mx-2">
                            삭제하기
                        </button>

                    </div>

                </div>
            </div>
        </div>

    </x-guest-layout>