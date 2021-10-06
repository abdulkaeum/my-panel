<x-layout>
    <h1 class="w-full text-3xl text-black pb-6">My Todo's</h1>

    <div class="w-full">
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6">Title</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6">Due Date</th>
                    <th class="py-3 px-6">Over due</th>
                    <th class="py-3 px-6">Action</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                @forelse ($todolists as $todolist)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">
                            <a href="{{ route('todolist.edit', $todolist) }}">
                                <i class="fas fa-pencil-alt"></i>
                                &nbsp;
                                {{ $todolist->title }}
                            </a>
                        </td>
                        <td class="py-3 px-6">
                            @if(is_null($todolist->complete))
                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                                    Pending
                                </span>
                            @else
                                <span
                                    class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">
                                    Completed {{ $todolist->complete->format('M d Y') }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-6">
                            @if(!is_null($todolist->due_date))
                                <span
                                    class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">
                                    Scheduled {{ $todolist->due_date->format('M d Y') }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-6">
                            @if(!is_null($todolist->due_date) && $todolist->due_date <= Date::now())
                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">
                                    {{ $todolist->due_date->diffForHumans() }}
                                </span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <div class="mr-5 transform hover:scale-110">
                                    <form action="{{ route('todolist.flag', $todolist) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <x-forms.submit>
                                            @if(!is_null($todolist->flag))
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        </x-forms.submit>
                                    </form>
                                </div>
                                <div class="mr-5 transform hover:scale-110">
                                    <form action="{{ route('todolist.destroy', $todolist) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-forms.submit>
                                            <i class="fas fa-trash-alt"></i>
                                        </x-forms.submit>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td colspan="5" class="py-3 px-6 text-center">
                            No Todo's created yet
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
