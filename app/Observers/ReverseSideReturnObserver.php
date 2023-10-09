<?php

namespace App\Observers;

use App\Models\ReverseSideReturn;
use Illuminate\Support\Facades\Storage;

class ReverseSideReturnObserver
{
    /**
     * Handle the ReverseSideReturn "created" event.
     */
    public function created(ReverseSideReturn $reverseSideReturn): void
    {
        //
    }

    /**
     * Handle the ReverseSideReturn "updating" event.
     */
    public function updating(ReverseSideReturn $reverseSideReturn): void
    {
        if ($reverseSideReturn->isDirty('signatures')) {
            $deleteFile = $reverseSideReturn->getOriginal('signatures');
            if (Storage::disk('public')->exists($deleteFile)) {
                Storage::disk('public')->delete($deleteFile);
            }
        }
    }

    /**
     * Handle the ReverseSideReturn "deleted" event.
     */
    public function deleted(ReverseSideReturn $reverseSideReturn): void
    {
        //
    }

    /**
     * Handle the ReverseSideReturn "restored" event.
     */
    public function restored(ReverseSideReturn $reverseSideReturn): void
    {
        //
    }

    /**
     * Handle the ReverseSideReturn "force deleted" event.
     */
    public function forceDeleted(ReverseSideReturn $reverseSideReturn): void
    {
        //
    }
}
