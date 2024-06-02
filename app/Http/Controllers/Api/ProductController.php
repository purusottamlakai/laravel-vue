<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    function __construct(protected Product $product)
    {
        
    }

    public function index()
    {
        return response()->json(\App\Http\Resources\ProductResource::collection($this->product->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if(!$this->product->create($request->validated())) {
            return $this->respondWithFailureMessage('Something went wrong.');
        }
        return $this->respondWithSuccessMessage('Successfully Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            $product = $this->product->findOrFail($id);
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->save();
            return $this->respondWithSuccessMessage('Successfully updated.');
        } catch (\Throwable $th) {
            return $this->respondWithFailureMessage('Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = $this->product->findOrFail($id);
            $product->delete();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete product.'], 500);
        }
    }
}
