<?php

namespace Inovector\ProductManager\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeDiscountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function build()
    {
        return $this->subject('Welcome! Enjoy Your Discount 🎉')
                    ->view('product-manager::emails.discount')
                    ->with([
                        'userId' => $this->userId,
                    ]);
    }
}
