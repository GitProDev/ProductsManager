<?php

namespace Inovector\ProductManager\Http\Controllers;

use Inovector\ProductManager\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Inovector\ProductManager\Events\FiltersApplied;
use Inovector\ProductManager\Jobs\ExportFilteredProducts;
use Inovector\ProductManager\Jobs\ProcessBulkProductImport;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Apply category filter
        if ($request->has('categories') && !empty($request->categories)) {
            $query->whereIn('category_id', $request->categories);
        }

        // Apply min max price filters
        if ($request->has('min_price') && is_integer($request->min_price) && $request->min_price >= 0){
            $query->where('price', '>=', $request->min_price);
        }
       
        if ($request->has('max_price') && is_integer($request->max_price) && $request->max_price >= 0){
            $query->where('price', '<=', $request->max_price);
        }

        // Apply seller filter
        if ($request->has('sellers') && !empty($request->sellers)) {
            $query->whereIn('seller_id', $request->sellers);
        }

        // Apply rating filter
        if ($request->has('rating')) {
            $query->where('average_rating', '>=', $request->rating);
        }

        // Apply stock status filter
        if ($request->has('stock_status') && in_array($request->stock_status, ['in_stock', 'out_of_stock'])) {
            $query->where('stock_status', $request->stock_status);
        }

        // Apply search filter
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Fetch products with relationships (Category, Seller)
        $products = $query->with(['category', 'seller'])->get();

        event(new FiltersApplied(1, $request->query()));

        return response()->json($products);
    }

    public function export(Request $request)
    {
        $filters = $request->all();
        //ExportFilteredProducts::dispatch($filters, 'dummy@example.com');
        dispatch(new ExportFilteredProducts($filters, 'dummy@example.com'));

        return response()->json(['message' => 'Export started. You will receive a download link via email shortly.']);
    }

    public function import(Request $request)
    {
        // Validate the file
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        if ($validator->fails()) {  //dd('$validator->fails');
            return back()->withErrors($validator)->withInput();
        }

        // Store the CSV file in storage/app/uploads
        $filePath = $request->file('csv_file')->storeAs('uploads', 'products_' . now()->timestamp . '.csv');
        ProcessBulkProductImport::dispatch($filePath);

        return back()->with('success', 'Product import started successfully!');
    }
}
