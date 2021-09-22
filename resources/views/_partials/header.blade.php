<!-- Desktop Header -->
<header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
    <div class="w-1/2"></div>
    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">

        <span class="mr-2 pt-2">{{ auth()->user()->name }}</span>

        <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
            <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
        </button>
        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
        <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
            <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
            <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
            <a href="#"
               class="block px-4 py-2 account-link hover:text-white"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >Sign Out</a>
        </div>
    </div>
</header>

<!-- Mobile Header & Nav -->
<header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
    <div class="flex items-center justify-between">
        <div class="text-white text-3xl font-semibold hover:text-gray-300">
            myPanel
        </div>
        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
            <i x-show="!isOpen" class="fas fa-bars"></i>
            <i x-show="isOpen" class="fas fa-times"></i>
        </button>
    </div>

    <!-- Dropdown Nav -->
    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('/') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-2 pl-4 nav-item"
        >
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-2 pl-4 nav-item"
        >
            <i class="fas fa-sticky-note mr-3"></i>
            Todo
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-2 pl-4 nav-item"
        >
            <i class="fas fa-table mr-3"></i>
            Actions/Notes
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-2 pl-4 nav-item"
        >
            <i class="fas fa-align-left mr-3"></i>
            Questionnaire
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-2 pl-4 nav-item"
        >
            <i class="fas fa-tablet-alt mr-3"></i>
            Messeges
        </a>
        <a href="#"
           class="flex items-center text-white
                {{ request()->is('#') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }}
               py-2 pl-4 nav-item"
        >
            <i class="fas fa-calendar mr-3"></i>
            Calendar
        </a>
        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-cogs mr-3"></i>
            Support
        </a>
        <a href="#" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
            <i class="fas fa-user mr-3"></i>
            My Account
        </a>
        <a href="#"
           class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            <i class="fas fa-sign-out-alt mr-3"></i>
            Sign Out
        </a>
    </nav>

    <form action="{{ route('logout') }}" method="post" style="display: none" id="logout-form">
        @csrf
    </form>
</header>
