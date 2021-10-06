<x-layout>
    <h1 class="w-full text-3xl text-black pb-6">{{ $todo->title }}</h1>

    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Todo setup
            </p>
            <div class="leading-loose">
                <form method="POST" action="{{ route('todolist.update', ['todolist' => $todo->id]) }}"
                      class="p-10 bg-white rounded shadow-xl"
                      enctype="multipart/form-data"
                >
                    @csrf
                    @method('PATCH')

                    <x-forms.input name="title" :value="old('title', $todo->title)" required/>

                    <x-forms.checkbox name="complete" description="Mark complete"
                                      :isChecked="is_null($todo->complete) ? false : true"/>

                    <x-forms.checkbox name="flag" description="Mark important"
                                      :isChecked="is_null($todo->flag) ? false : true"/>

                    <x-forms.input name="due_date" type="date"
                                   :value="old('due_date', $todo->due_date?->toDateString())"
                                   min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}"/>

                    <x-forms.textarea
                        name="note" id="note" class="resize-y" rows="5"
                        cols="52">{{old('note', $todo->note)}}</x-forms.textarea>

                    <x-forms.input name="file" type="file"/>
                    @if(Storage::disk('public')->exists($todo->file))
                        <div class="mt-2 flex items-center">
                            <div class="mt-5 mr-5">
                                <a href="{{ asset('storage/'.$todo->file) }}" target="_blank">
                                    <i class="far fa-folder-open"></i> Open {{$todo->title}} file
                                </a>
                            </div>
                            <div>
                                <x-forms.checkbox type="checkbox"
                                                  name="fileRemove"
                                                  value="{{ $todo->file }}"
                                                  description="Mark to delet"
                                />
                            </div>
                        </div>
                    @endif

                    <x-forms.submit>
                        Save {{$todo->title}}
                    </x-forms.submit>
                </form>
            </div>
        </div>

        <div class="w-full lg:w-1/2 mt-6 pl-0 lg:pl-2">
            <p class="text-xl pb-6 flex items-center">
                <i class="fas fa-list mr-3"></i> Check list
            </p>
            <div class="leading-loose p-10 bg-white rounded shadow-xl">
                <form method="POST" action="{{ route('todotask.store', $todo) }}">
                    @csrf
                    <label for="task">
                        <x-forms.input type="text"
                                       name="task"
                                       placeholder="New task"
                                       size="10"
                                       maxlegnth="25"
                                       autocomplete="off"
                                       required
                        />
                    </label>
                    <x-forms.submit>
                        Add task
                    </x-forms.submit>
                </form>
            </div>
            <div class="leading-loose p-10 bg-white rounded shadow-xl mt-5" {{ $todo->tasks->count() > 0 ? '' :'hidden' }}>
                <form action="{{ route('todotask.update', $todo) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="bg-white shadow-md rounded my-6">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6">Task(s)</th>
                                <th class="py-3 px-6">Complete</th>
                                <th class="py-3 px-6">Remove</th>
                            </tr>
                            </thead>
                            @forelse ($todo->tasks as $task)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6">
                                        {{ $task->task }}
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <label for="complete-{{ $task->id }}">
                                            <input type="checkbox"
                                                   name="complete[]"
                                                   value="{{ $task->id }}"
                                                   id="complete-{{ $task->id }}"
                                                   {{ is_null($task->complete) ? '' : 'checked' }}
                                            />
                                        </label>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <label for="remove-{{ $task->id }}">
                                            <input type="checkbox"
                                                   name="remove[]"
                                                   value="{{ $task->id }}"
                                                   id="remove-{{ $task->id }}"
                                            />
                                        </label>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </table>
                    </div>
                    <x-forms.submit>Update task(s)</x-forms.submit>
                    @error('no-tasks')
                        <div class="text-red-500">
                            {{ $message }}
                        </div>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</x-layout>
