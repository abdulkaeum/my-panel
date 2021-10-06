<x-layout>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-1/2 my-6 pr-0 lg:pr-2 m-auto">
            <div class="text-3xl font-semibold hover:text-gray-300 mb-5">
                myPanel
            </div>
            <div class="leading-loose">
                <form method="post"
                      action="{{ route('register.store') }}"
                      class="p-10 bg-white rounded shadow-xl"
                >
                    @csrf

                    <x-forms.input name="name" required />

                    <x-forms.input name="username" required />

                    <x-forms.input name="email" type="email" required />

                    <x-forms.input name="password" type="password" autocomplete="new-password" required />

                    <x-forms.submit>Register</x-forms.submit>

                    <div class="mt-3">
                        <a href="{{ route('login.create') }}">Already registered?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
