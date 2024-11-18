<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            $request->user()
                ->items()
                ->with(['category', 'subCategory'])
                ->paginate(15)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'category_id' => 'required|uuid|exists:categories,id',
            'sub_category_id' => 'required|uuid|exists:sub_categories,id',
            'estimated_value' => 'required|numeric',
            'condition' => 'required|in:New,Like New,Good,Fair,Poor',
            'photos' => 'nullable|array',
            'photos.*' => 'string',
        ]);

        $item = $request->user()->items()->create($validated);

        return response()->json(['message' => 'Item submitted successfully.', 'item' => $item], 201);
    }

    public function show(Request $request, $id)
    {
        $item = $request->user()->items()->with(['category', 'subCategory'])->findOrFail($id);

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = $request->user()->items()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'estimated_value' => 'nullable|numeric',
            'condition' => 'nullable|in:New,Like New,Good,Fair,Poor',
            'photos' => 'nullable|array',
            'photos.*' => 'string',
        ]);

        $item->update($validated);

        return response()->json(['message' => 'Item updated successfully.', 'item' => $item]);
    }

    public function destroy(Request $request, $id)
    {
        $item = $request->user()->items()->findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item deleted successfully.']);
    }
}
