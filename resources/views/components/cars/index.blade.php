<x-guest-layout>
  
<div>
    <a href="{{ route('cars.create') }}">자동차 등록</a>
</div>


<div class="flex flex-col justify-items-center">
    <div>
        <table>
        
            <tr>
                <th>제조회사</th>
                <th>자동차명</th>
                <th>제조연도</th>
            </tr>

            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->company->name }}</td>
                    <td>{{ $car->name }}</td>
                    <td>{{ $car->year }}</td>
                </tr>                
            @endforeach

        </table> 
    </div>

    <div>
        {{ $cars->links() }}
    </div>
</div>

</x-guest-layout>