<x-guest-layout>
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $note->title }}
        </h2>
    </div>

    <p class="mt-2 text-xs">{{ $note->body }}</p>

    <div>
        <p class="mt-2 text-xs">{{ $note->recipient }}</p>

        <p class="mt-2 text-xs">{{ $note->send_date }}</p>

        <p class="mt-2 text-xs">{{ $note->is_published ? '已发布' : '未发布' }}</p>

        <div class="flex justify-center">
            <x-button href="{{ route('notes.index') }}" icon="arrow-left" outline></x-button>
        </div>
    </div>
</x-guest-layout>
