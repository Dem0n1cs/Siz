<?php

namespace App\Observers;

use App\Models\ReverseSideGive;
use Illuminate\Support\Facades\Storage;

class ReverseSideGiveObserver
{
    /**
     * Handle the ReverseSideGive "created" event.
     */
    public function created(ReverseSideGive $reverseSideGive): void
    {
        //
    }

    /**
     * Handle the ReverseSideGive "updating" event.
     */
    public function updating(ReverseSideGive $reverseSideGive): void
    {
        if ($reverseSideGive->isDirty('signature')) {
            $deleteFile = $reverseSideGive->getOriginal('signature');
            if ($deleteFile !== null && Storage::disk('public')->exists($deleteFile)) {
                Storage::disk('public')->delete($deleteFile);
            }
        }
    }

    /**
     * Handle the ReverseSideGive "deleted" event.
     */
    public function deleted(ReverseSideGive $reverseSideGive): void
    {
        //
    }

    /**
     * Handle the ReverseSideGive "restored" event.
     */
    public function restored(ReverseSideGive $reverseSideGive): void
    {
        //
    }

    /**
     * Handle the ReverseSideGive "force deleted" event.
     */
    public function forceDeleted(ReverseSideGive $reverseSideGive): void
    {
        //
    }
}
