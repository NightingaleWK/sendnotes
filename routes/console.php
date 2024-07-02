<?php

use App\Console\Commands\SendScheduledNotes;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(SendScheduledNotes::class)->timezone('Asia/Shanghai')->dailyAt('08:00');
