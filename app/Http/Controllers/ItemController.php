<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|uuid',
            'sub_category_id' => 'required|uuid',
            'condition' => 'required|in:New,Like New,Good,Fair,Poor',
            'estimated_value' => 'required|numeric|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'string', // Ensure each photo is a valid path/URL
        ]);

        $item = $request->user()->items()->create($validated);

        return response()->json(['message' => 'Item submitted successfully.', 'item' => $item], 201);
    }

    public function index(Request $request)
    {
        $items = $request->user()->items()->paginate(10);

        return response()->json($items);
    }

    public function show($id)
    {
        $item = Item::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'category_id' => 'uuid',
            'sub_category_id' => 'uuid',
            'condition' => 'in:New,Like New,Good,Fair,Poor',
            'estimated_value' => 'numeric|min:0',
            'photos' => 'nullable|array',
            'photos.*' => 'string',
        ]);

        $item->update($validated);

        return response()->json(['message' => 'Item updated successfully.', 'item' => $item]);
    }
}
