@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-blue-600 dark:border-white text-base font-medium leading-5 text-gray-100 dark:text-gray-100 focus:outline-none focus:border-blue-600 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base font-medium leading-5 text-gray-300 dark:text-gray-300 hover:text-white dark:hover:text-white hover:border-blue-600 dark:hover:border-white focus:outline-none focus:text-white dark:focus:text-white focus:border-blue-600 dark:focus:border-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
