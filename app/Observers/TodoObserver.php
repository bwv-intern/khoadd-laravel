<?php

namespace App\Observers;

use App\Mail\TestMail;
use App\Models\Todo;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Mail;

class TodoObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Todo "created" event.
     * @param Todo $todo
     */
    public function created(Todo $todo): void {
        Mail::to(env('TEST_MAIL_RECIPIENT'))->send(new TestMail($todo->id));
    }

    /**
     * Handle the Todo "updated" event.
     * @param Todo $todo
     */
    public function updated(Todo $todo): void {
    }

    /**
     * Handle the Todo "deleted" event.
     * @param Todo $todo
     */
    public function deleted(Todo $todo): void {
    }

    /**
     * Handle the Todo "restored" event.
     * @param Todo $todo
     */
    public function restored(Todo $todo): void {
    }

    /**
     * Handle the Todo "force deleted" event.
     * @param Todo $todo
     */
    public function forceDeleted(Todo $todo): void {
    }
}
