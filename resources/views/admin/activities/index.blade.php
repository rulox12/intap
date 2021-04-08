<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <button onclick="openModal(true)"
                    class="border-2 border-transparent bg-blue-400 ml-3 py-1 px-4 font-bold text-white rounded transition-all hover:border-blue-500 hover:bg-transparent hover:text-blue-500">
                {{ __('Create new activity') }}
            </button>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table class="min-w-max w-full table-auto">
                <thead>
                <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Id</th>
                    <th class="py-3 px-6 text-left">{{__('Description')}}</th>
                    <th class="py-3 px-6 text-center">{{__('Created ago')}}</th>
                    <th class="py-3 px-6 text-center">{{__('Actions')}}</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @foreach($activities as $activity)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium">{{$activity->id}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <div class="flex items-center">
                                <span>{{$activity->description}}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">{{ $activity->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{route('activities.show', $activity->id)}}"
                                class="px-5 py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">
                                {{ __('View Details') }}
                            </a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $activities->links() }}
        </div>
    </div>
</x-app-layout>

<div id="modal_overlay"
     class="hidden absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0">

    <!-- modal -->
    <div id="modal"
         class="pacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-1/2 h-1/2 md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

        <!-- button close -->
        <button
            onclick="openModal(false)"
            class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
            &cross;
        </button>

        <!-- header -->
        <div class="px-4 py-3 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-600">{{__('Create new activity')}}</h2>
        </div>

        <!-- body -->
        <form method="post" action="{{route('activities.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="p-2">
                <div class="mb-4 mt-6">
                    <label
                        class="block text-gray-700 text-sm font-semibold mb-2"
                        htmlFor="description"
                    >
                        {{__('Description')}}
                    </label>
                    <input
                        class="text-sm appearance-none rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline h-10"
                        id="description"
                        name="description"
                        type="text"
                        required
                    />
                </div>
            </div>

            <!-- footer -->
            <div
                class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                <button type="submit"
                        class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">
                    {{__('Save')}}
                </button>
                <button
                    onclick="openModal(false)"
                    class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none">
                    {{__('Close')}}
                </button>
            </div>

        </form>
    </div>

</div>

<script>
    const modal_overlay = document.querySelector('#modal_overlay');
    const modal = document.querySelector('#modal');

    function openModal(value) {
        const modalCl = modal.classList
        const overlayCl = modal_overlay

        if (value) {
            overlayCl.classList.remove('hidden')
            setTimeout(() => {
                modalCl.remove('opacity-0')
                modalCl.remove('-translate-y-full')
                modalCl.remove('scale-150')
            }, 100);
        } else {
            modalCl.add('-translate-y-full')
            setTimeout(() => {
                modalCl.add('opacity-0')
                modalCl.add('scale-150')
            }, 100);
            setTimeout(() => overlayCl.classList.add('hidden'), 300);
        }
    }

    openModal(false)
</script>
