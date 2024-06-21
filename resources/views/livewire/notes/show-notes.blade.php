<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'desc')->get(),
        ];
    }
}; ?>

<div>
    @if ($notes->isEmpty())
        <div class="text-center">
            <p class="text-xl font-bold">还没有便条呢</p>
            <p class="text-sm">让我们创建你的第一篇便条吧！</p>
            <x-button class="mt-6" right-icon="plus" href="{{ route('notes.create') }}" wire:navigate>创建便条</x-button>
        </div>
    @else
        <div class="space-y-5">
            <div class="grid grid-cols-2 gap-4 mt-12">
                @foreach ($notes as $note)
                    <x-card wire:key="{{ $note->id }}">
                        <div class="flex justify-between">
                            <a href="#" class="font-bold test-xl hover:underline hover:text-blue-500">
                                {{ $note->title }}
                            </a>
                            <div class="text-gray-500 test-xs whitespace-nowrap">
                                {{ $note->send_date }}
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">
                                收件人: <span class="font-semibold">{{ $note->recipient }}</span>
                            </p>
                            <div class="space-x-1">
                                {{-- <x-mini-button rounded outline gray icon="eye"></x-mini-button> --}}
                                {{-- <x-mini-button rounded outline icon="trash"></x-mini-button> --}}
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        </div>
    @endif
</div>
