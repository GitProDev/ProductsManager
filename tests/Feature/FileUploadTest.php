<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Queue;
use Inovector\ProductManager\Jobs\ProcessBulkProductImport;

it('uploads a valid CSV file and dispatches the import job', function () {
    Storage::fake('local');
    Queue::fake();

    $file = UploadedFile::fake()->create('products.csv', 100, 'text/csv');

    $response = $this->post('/product-manager/import', [
        'csv_file' => $file,
    ]);

    $response->assertRedirect();
    Queue::assertPushed(ProcessBulkProductImport::class);
});