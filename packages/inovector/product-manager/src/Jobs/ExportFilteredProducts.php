<?php

namespace Inovector\ProductManager\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Inovector\ProductManager\Mails\ExportReadyMail;
use Inovector\ProductManager\Models\Product;

class ExportFilteredProducts implements ShouldQueue
{
    use Queueable;

    protected $filters;
    protected $exportPath;
    protected $email;

    public function __construct(array $filters, string $email)
    {
        $this->filters = $filters;
        $this->email = $email;
    }

    public function handle()
    {
        $query = Product::with(['category', 'seller']);

        if (!empty($this->filters['categories'])) {
            $query->whereIn('category_id', $this->filters['categories']);
        }

        if (!empty($this->filters['sellers'])) {
            $query->whereIn('seller_id', $this->filters['sellers']);
        }

        if (!empty($this->filters['min_price'])) {
            $query->where('price', '>=', $this->filters['min_price']);
        }

        if (!empty($this->filters['max_price'])) {
            $query->where('price', '<=', $this->filters['max_price']);
        }

        if (!empty($this->filters['rating'])) {
            $query->where('average_rating', '>=', $this->filters['rating']);
        }

        if (!empty($this->filters['stock_status'])) {
            $query->where('stock_status', $this->filters['stock_status']);
        }

        if (!empty($this->filters['search'])) {
            $query->where('name', 'like', '%' . $this->filters['search'] . '%');
        }

        $products = $query->get();

        // Create CSV content
        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['ID', 'Name', 'Category', 'Seller', 'Price', 'Rating', 'Stock Status', 'Product URL']);

        foreach ($products as $product) {
            fputcsv($csv, [
                $product->id,
                $product->name,
                $product->category->name,
                $product->seller->name,
                $product->price,
                $product->average_rating,
                $product->stock_status,
                $product->product_url
            ]);
        }

        rewind($csv);
        $filename = 'product_export_' . now()->timestamp . '.csv';
        $path = "exports/{$filename}";
        Storage::disk('public')->put($path, stream_get_contents($csv));

        fclose($csv);
        
        // Send email with download link
        Mail::to($this->email)->send(new ExportReadyMail($filename));
    }
}
