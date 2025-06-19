@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-black focus:ring-black focus:ring-1 rounded-md shadow-sm']) }}>
