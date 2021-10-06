<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
    <div class="p-6">
        <div class="text-white text-3xl font-semibold hover:text-gray-300">
            myPanel
        </div>
        <div class="text-white mt-5">
            {{ Carbon\Carbon::now()->toFormattedDateString() }}
        </div>
    </div>
    <nav class="text-white text-base font-semibold pt-3">
        <a href="/"
           class="flex items-center text-white
                {{ request()->is('/') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-4 pl-6 nav-item"
        >
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <form action="{{ route('todolist.store') }}" method="POST" class="ml-6 mt-5 mb-4">
            @csrf
            <i class="fas fa-sticky-note mr-3"></i>
            <label for="todoname">
                <input type="text"
                       name="todoname"
                       placeholder="New Todo"
                       class="bg-sidebar focus:outline-none placeholder-white font-semibold"
                       size="10"
                       autocomplete="off"
                >
            </label>
            <button type="submit">+</button>
        </form>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-4 pl-6 nav-item"
        >
            <i class="fas fa-table mr-3"></i>
            Actions/Notes
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-4 pl-6 nav-item"
        >
            <i class="fas fa-align-left mr-3"></i>
            Questionnaire
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-4 pl-6 nav-item"
        >
            <i class="fas fa-tablet-alt mr-3"></i>
            Messeges
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-4 pl-6 nav-item"
        >
            <i class="fas fa-calendar mr-3"></i>
            Calendar
        </a>
    </nav>
</aside>
