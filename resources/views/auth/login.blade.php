<x-layout>
    <h1 class="title"> Welcome Back</h1>

    @if (session('status'))
        <x-flashMsg msg="{{ session('status') }}" />
    @endif

    <div class="mx-auto max-w-screen-sm card">
        <form action="{{ route('login') }}" method="post">
            @csrf
            {{-- Email --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                class="input @error('email') ring-red-500 @enderror">
                @error('email')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>
            {{-- Password --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="input
                @error('password') ring-red-500 @enderror">
                @error('password')
                <p class="error"> {{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="mb-4 flex justify-between items-center">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm font-medium text-slate-900">Remember Me</label>
                </div>
                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:text-blue-600">Forgot your password?</a>
            </div>

            @error('failed')
            <p class="error"> {{ $message }}</p>
            @enderror

            {{-- Submit --}}
            <button class="btn">Login</button>
        </form>
    </div>
</x-layout>
