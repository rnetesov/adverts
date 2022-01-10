<h2>{{ config('APP_NAME') }}</h2>
<p>To complete registration follow the link below</p>
<a href="{{ route('email.verify', $user->verify_code) }}">
    {{ route('email.verify', $user->verify_code) }}
</a>
