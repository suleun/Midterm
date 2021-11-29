<x-guest-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cars') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4 bg-gray-300">
        <div class="g-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">

                <div>
                    <a href="{{ route('cars.create') }}">자동차 등록</a>
                </div>

                <div class="flex flex-col justify-items-center">
                    <div>
                        <table class="border-b border-gray-200">

                            <tr class="border-b border-green-400">
                                <th>제조회사</th>
                                <th>자동차명</th>
                                <th>제조연도</th>
                            </tr>

                            @foreach ($cars as $car)
                            <tr class="border-green-400">
                                <td>{{ $car->company->name }}</td>
                                <td>
                                    <a href="{{ route('cars.show', ['car'=>$car->id]) }}">{{ $car->name }}</a>
                                    </td>
                                <td>{{ $car->year }}</td>
                            </tr>
                            @endforeach

                        </table>
                    </div>

                    <div>
                        {{ $cars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>