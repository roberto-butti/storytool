@props([
    'spaces',
    'currentuserid' => ''
])

<div class="m-1">
    <div class="text-right mb-1 w-full">
        <span class="text-indigo-500">Found [<b>{{ $spaces->count() }}</b>] users</span>
    </div>
 
    @foreach($spaces as $space)
        <div>
            <div class="flex space-x-1">
                <span class="font-bold">{{ $space->name() }}</span>
                <span class="text-gray">[{{ $space->id() }}]</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="text-gray">{{ $space->updatedAt("YYYY-MM-dd") }}</span>
                <span class="text-gray">Owner:</span>
 
                @if($space->get('owner_id') == $currentuserid)
                    <span class="font-bold text-green">YOU</span>
                @else
                    <span class="font-bold text-red">NO.</span>
                @endif
            </div>
        </div>
    @endforeach
</div>