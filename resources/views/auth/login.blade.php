<x-layout>
    <h1 class="title"> Welcome Back</h1>
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
            <div class="mb-4 flex">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember">Remember Me</label>
            </div>

            @error('failed')
            <p class="error"> {{ $message }}</p>
            @enderror

            {{-- Submit --}}
            <button class="primary-btn">Login</button>
        </form>
    </div>
</x-layout>
