<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validatedData = $this->validate([
            'noteTitle' => 'required|string|min:5|max:255',
            'noteBody' => 'required|string|min:20',
            'noteRecipient' => 'required|email',
            'noteSendDate' => 'required|date',
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $validatedData['noteTitle'],
                'body' => $validatedData['noteBody'],
                'recipient' => $validatedData['noteRecipient'],
                'send_date' => $validatedData['noteSendDate'],
                'is_published' => true,
            ]);

        session()->flash('status', 'Note successfully updated.');

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form wire:submit="submit" class="space-y-5">
        <x-input wire:model="noteTitle" label="便签标题" placeholder="今天天气真不错，不是么？"></x-input>
        <x-textarea wire:model="noteBody" label="你的便签" placeholder="记录当下，分享喜悦"></x-textarea>
        <x-input icon="user" wire:model="noteRecipient" label="收件人" placeholder="yourfriend@email.com"></x-input>
        <x-datetime-picker icon="calendar" wire:model="noteSendDate" label="发送时间" parse-format="YYYY-MM-DD"
            without-time="true" />
        <div class="pt-4">
            <x-button right-icon="calendar" type="submit" spinner>完成规划</x-button>
        </div>

        <x-errors />
    </form>
</div>
