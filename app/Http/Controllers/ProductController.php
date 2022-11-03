<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Product::with('category');

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.product.gallery.index', $item->id) . '"> Gallery
                        </a>
                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline"
                            href="' . route('dashboard.product.edit', $item->id) . '">
                            Edit
                        </a>
                        <form class="inline-block" action="' . route('dashboard.product.destroy', $item->id) . '" method="POST">
                            <button class="border border-red-500 bg-red-500 text-white rounded-md px-2 py-1 m-2 transition duration-500 ease select-none hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                                Hapus
                            </button>
                                ' . method_field('delete') . csrf_field() . '
                        </form>';
                })->editColumn('price', function ($item) {
                    return number_format($item->price);
                })->rawColumns(['action'])->make();
        }

        return view('pages.dashboard.product.index');
    }

    public function create()
    {
        $categories = ProductCategory::all();

        return view('pages.dashboard.product.create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        Product::create($data);

        return redirect()->route('dashboard.product.index');
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();

        return view('pages.dashboard.product.edit', [
            'item' => $product,
            'categories' => $categories
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->all();

        $product->update($data);

        return redirect()->route('dashboard.product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.product.index');
    }
}
