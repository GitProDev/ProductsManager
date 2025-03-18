<?php

namespace Inovector\ProductManager\Listeners;

use Inovector\ProductManager\Events\FiltersApplied;
use Inovector\ProductManager\Models\FilterLog;
use Inovector\ProductManager\Mails\WelcomeDiscountMail;
use Illuminate\Support\Facades\Mail;

class LogAndSendDiscount
{
    public function handle(FiltersApplied $event)
    {
        // Log the filter activity
        FilterLog::create([
            'user_id' => $event->userId,
            'filters' => json_encode($event->filters),
            'applied_at' => now(),
        ]);
        
        // Check if this is the first time this user applied a filter
        $existingLogs = FilterLog::where('user_id', $event->userId)->count();

        if ($existingLogs === 1) {
            Mail::to('dummyuser@example.com')->send(new WelcomeDiscountMail($event->userId));
        }
    }
}
