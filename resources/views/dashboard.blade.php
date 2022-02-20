
@section('admin.navigation')
    @include('layouts.navigation-admin')

@endsection


<x-app-layout >

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1> </h1>
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
