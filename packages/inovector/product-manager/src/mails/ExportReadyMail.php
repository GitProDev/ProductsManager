<?php
namespace Inovector\ProductManager\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class ExportReadyMail extends Mailable
{
    use Queueable;

    public $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function build()
    {
        return $this->subject('Your Product Export is Ready')
                    ->view('product-manager::emails.export-ready')
                    ->with([
                        'downloadUrl' => url('/product-manager/exports/' . $this->filename),
                    ]);
    }
}
