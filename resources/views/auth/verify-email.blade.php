<x-layout>
    <h1 class="mb-4">
        Please verify your email address
    </h1>
    <p>Did not get the email?</p>
    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <button class="btn">Resend verification email</button>
    </form>
</x-layout>