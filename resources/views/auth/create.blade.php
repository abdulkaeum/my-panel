<x-layout>
    <div class="flex flex-wrap">

        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2 m-auto">
            <div class="text-3xl font-semibold hover:text-gray-300 mb-5">
                myPanel
            </div>
            <div class="leading-loose">
                <form method="post"
                      action="{{ route('login.store') }}"
                      class="p-10 bg-white rounded shadow-xl">
                    @csrf

                    <x-forms.input name="email" type="email" autoComplete="username" required/>

                    <x-forms.input name="password" type="password" autoComplete="current-password" required/>

                    <x-forms.submit>Login</x-forms.submit>

                    <x-forms.error name="authFail"/>

                    <div class="mt-3">
                        <a href="{{ route('register.create') }}">Not registered?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
