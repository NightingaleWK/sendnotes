<?php

namespace App\Jobs;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The note instance.
     *
     * @var \App\Models\Note
     */
    public Note $note;

    /**
     * Create a new job instance.
     *
     * @param \App\Models\Note $note
     */
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;

        $emailContent = <<<EOT
            <p>Hi {$this->note->recipient},</p>
            <p>You have a new note from {$this->note->user->name}</p>
            <p><a href="$noteUrl">Click here</a> to view the note.</p>
            <p>Regards,</p>
            <p>Note App</p>
        EOT;

        Mail::raw($emailContent, function ($message) {
            $message
                ->from(config('mail.from.address'), config('mail.from.name'))
                ->to($this->note->recipient)
                ->subject('You have a new note from ' . $this->note->user->name);
        });
    }
}
