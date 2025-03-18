<?php
namespace Inovector\ProductManager\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductImportSummary extends Mailable
{
    use Queueable, SerializesModels;

    public $successCount;
    public $failureCount;
    public $reportPath;

    public function __construct($successCount, $failureCount, $reportPath)
    {
        $this->successCount = $successCount;
        $this->failureCount = $failureCount;
        $this->reportPath = $reportPath;
    }

    public function build()
    {
        return $this->view('product-manager::emails.product_import_summary')
                    ->subject('Product Import Summary')
                    ->with([
                        'successCount' => $this->successCount,
                        'failureCount' => $this->failureCount,
                        'reportPath' => $this->reportPath,
                    ]);
    }
}
