<x-mail::layout>
    {{-- Header --}}
    <x-slot:header>
        <x-mail::header :url="config('app.url')" style="background-color: #f8fafc; padding: 20px;">
            <h1 style="margin: 0; font-size: 24px; color: #333;">{{ config('app.name') }}</h1>
        </x-mail::header>
    </x-slot:header>

    {{-- Body --}}
    <div
        style="padding: 20px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
        <h2 style="color: #333; font-size: 20px;">Hello!</h2>
        <p style="line-height: 1.6; color: #555;">{{ $slot }}</p>
    </div>

    {{-- Subcopy --}}
    @isset($subcopy)
        <x-slot:subcopy>
            <x-mail::subcopy
                style="margin-top: 20px; padding: 20px; background-color: #f9fafb; border-left: 4px solid #4A90E2;">
                {{ $subcopy }}
            </x-mail::subcopy>
        </x-slot:subcopy>
    @endisset

    {{-- Footer --}}
    <x-slot:footer>
        <x-mail::footer style="background-color: #f8fafc; padding: 10px; text-align: center;">
            <p style="margin: 0; color: #777;">© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved. Tes ff')</p>
            <p style="margin: 0; font-size: 12px; color: #aaa;">
                {{ __('This email was sent to you because you requested it.') }}</p>
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
