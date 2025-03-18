<?php

namespace Inovector\ProductManager\Jobs;

use Inovector\ProductManager\Models\Product;
use Inovector\ProductManager\Mails\ProductImportSummary;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use League\Csv\Writer;

class ProcessBulkProductImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        $csv = Reader::createFromPath(Storage::path($this->filePath), 'r');
        $csv->setHeaderOffset(0); // Set the first row as header
        $records = $csv->getRecords();

        $successCount = 0;
        $failureCount = 0;
        $failedRows = [];
        $productsToInsert = [];

        foreach ($records as $row) {
            $validator = Validator::make($row, [
                'name' => 'required|string',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'seller_id' => 'required|exists:sellers,id',
                'average_rating' => 'required|numeric',
                'product_url' => 'required|string',
                'stock_status' => 'required|in:in_stock,out_of_stock',
            ]);

            if ($validator->fails()) {
                $failureCount++;
                $failedRows[] = array_merge($row, ['errors' => $validator->errors()]);
                continue;
            }

            // Accumulate products for bulk insertion
            $productsToInsert[] = [
                'name' => $row['name'],
                'price' => $row['price'],
                'category_id' => $row['category_id'],
                'seller_id' => $row['seller_id'],
                'average_rating' => $row['average_rating'],
                'product_url' => $row['product_url'],
                'stock_status' => $row['stock_status'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $successCount++;
        }

        // Insert all valid products in bulk
        if (count($productsToInsert) > 0) {
            Product::insert($productsToInsert);
        }

        // Generate CSV report for failed rows
        $failedCsv = Writer::createFromString('');
        $failedCsv->insertOne(array_keys($failedRows[0] ?? []));
        foreach ($failedRows as $failedRow) {
            $failedCsv->insertOne($failedRow);
        }

        // Store the report
        $reportPath = 'uploads/failed_imports' . now()->timestamp . '.csv';
        Storage::disk('public')->put($reportPath, $failedCsv->__toString());

        // Send email to admin with the summary and report
        Mail::to('admin@example.com')->send(new ProductImportSummary($successCount, $failureCount, $reportPath));
    }
}