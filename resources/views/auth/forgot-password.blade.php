<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi 
        melalui email yang memungkinkan Anda memilih kata sandi baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Tombol Kirim Email dan Kembali -->
        <div class="flex items-center justify-between mt-4">
            <!-- Tombol Kembali -->
            <a href="{{ route('login') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-700 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-700 transition ease-in-out duration-150">
                {{ __('Kembali') }}
            </a>

            <!-- Tombol Kirim -->
            <x-primary-button>
                {{ __('Kirim Email Reset Kata Sandi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
