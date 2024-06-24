<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[layout('layouts.app')] class extends Component {
    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);

        $this->fill($note);

        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;
    }

    public function saveNote()
    {
        $validatedData = $this->validate([
            'noteTitle' => 'required|string|min:5|max:255',
            'noteBody' => 'required|string|min:20',
            'noteRecipient' => 'required|email',
            'noteSendDate' => 'required|date',
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

        $this->dispatch('note-saved');
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Create a Note') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto space-y-4 sm:px-6 lg:px-8">
        <form wire:submit="saveNote" class="space-y-5">
            <x-input wire:model="noteTitle" label="便签标题" placeholder="今天天气真不错，不是么？"></x-input>
            <x-textarea wire:model="noteBody" label="你的便签" placeholder="记录当下，分享喜悦"></x-textarea>
            <x-input icon="user" wire:model="noteRecipient" label="收件人"
                placeholder="yourfriend@email.com"></x-input>
            <x-datetime-picker icon="calendar" wire:model="noteSendDate" label="发送时间" parse-format="YYYY-MM-DD"
                without-time="true" />
            <x-checkbox label="便签是否发布" wire:model="noteIsPublished"></x-checkbox>
            <div class="flex justify-between pt-4">
                <x-button type="submit" spinner="saveNote">保存便签</x-button>
                <x-button herf="{{ route('notes.index') }}" outline gray negative>返回列表</x-button>
            </div>

            <x-action-message on="note-saved"></x-action-message>

            <x-errors />
        </form>
    </div>
</div>
