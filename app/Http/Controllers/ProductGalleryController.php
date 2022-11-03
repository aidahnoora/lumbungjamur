<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductGalleryRequest;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductGalleryController extends Controller
{
    public function index(Product $product)
    {
        if(request()->ajax()) {
            $query = ProductGallery::where('product_id', $product->id);

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <form class="inline-block" action="' . route('dashboard.gallery.destroy', $item->id) . '" method="POST">
                            <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                                Hapus
                            </button>
                                ' . method_field('delete') . csrf_field() . '
                        </form>';
                })->editColumn('url', function($item) {
                    // return '<img style="max-width: 150px;" src="'. $item->url .'"/>';
                    return '<img {{ Storage::url("public/gallery")'. $item->url .'}} />';
                })->editColumn('is_featured', function($item) {
                    return $item->is_featured ? 'Yes' : 'No';
                })->rawColumns(['action', 'url'])->make();
        }

        return view('pages.dashboard.gallery.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('pages.dashboard.gallery.create', compact('product'));
    }

    public function store(ProductGalleryRequest $request, Product $product)
    {
        $files = $request->file('files');

        if($request->hasFile('files')) {
            foreach($files as $file) {
                $path = $file->store('public/gallery');

                ProductGallery::create([
                    'product_id' => $product->id,
                    'url' => $path
                ]);
            }
        }

        return redirect()->route('dashboard.product.gallery.index', $product->id);
    }

    public function destroy(ProductGallery $gallery)
    {
        $gallery->delete();

        return redirect()->route('dashboard.product.gallery.index', $gallery->product_id);
    }
}
