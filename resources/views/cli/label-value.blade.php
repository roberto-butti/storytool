@props([
    'label',
    'sublabel' => '',
    'value' => '',
])

<div class="flex space-x-1">
    <span class="font-bold">{{ $label }}</span>
    <i class="text-gray">{{ $sublabel }}</i>
    <span class="flex-1 content-repeat-[.] text-gray"></span>
    <span class="font-bold text-green">{{ $value }}</span>
</div>
