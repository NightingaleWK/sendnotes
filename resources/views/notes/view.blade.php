<x-guest-layout>
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $note->title }}
        </h2>
    </div>

    <p class="mt-4 mb-12">{{ $note->body }}</p>

    <div class="flex items-center justify-end mt-12 space-y-2">
        {{-- <p class="mt-2 text-xs">{{ $note->recipient }}</p>

        <p class="mt-2 text-xs">{{ $note->send_date }}</p>

        <p class="mt-2 text-xs">{{ $note->is_published ? '已发布' : '未发布' }}</p>

        <div class="flex justify-center">
            <x-button href="{{ route('notes.index') }}" icon="arrow-left" outline></x-button>
        </div> --}}

        <div class="flex items-center space-x-2">
            <h3 class="text-sm">发送自：{{ $user->name }}</h3>
            <livewire:likereact :note="$note"></livewire:likereact>
        </div>
    </div>
</x-guest-layout>
