@props([
    'label',
    'sublabel' => '',
    'value' => true,
    'truevalue' => 'YES',
    'falsevalue' => 'NO'
])

<div class="flex space-x-1">
    <span class="font-bold">{{ $label }}</span>
    <i class="text-gray">{{ $sublabel }}</i>
    <span class="flex-1 content-repeat-[.] text-gray"></span>
    @if($value)
        <span class="font-bold text-green">{{ $truevalue }}</span>
    @else
        <span class="font-bold text-red">{{ $falsevalue }}</span>
    @endif

</div>
