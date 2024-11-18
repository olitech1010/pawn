<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceItem;
use App\Models\Item;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    // List all available items in the marketplace
    public function index()
    {
        $marketplaceItems = MarketplaceItem::with('item')->where('status', 'Available')->get();
        return response()->json($marketplaceItems);
    }

    // View a specific item in the marketplace
    public function show($id)
    {
        $marketplaceItem = MarketplaceItem::with('item')->findOrFail($id);
        return response()->json($marketplaceItem);
    }

    // List an item in the marketplace
    public function listItem(Request $request, $itemId)
    {
        $validated = $request->validate([
            'price' => 'required|numeric|min:0'
        ]);

        $item = Item::findOrFail($itemId);
        if ($item->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $marketplaceItem = MarketplaceItem::create([
            'item_id' => $item->id,
            'price' => $request->price,
            'status' => 'Available',
        ]);

        return response()->json($marketplaceItem, 201);
    }

    // Remove an item from the marketplace
    public function removeItem($itemId)
    {
        $marketplaceItem = MarketplaceItem::where('item_id', $itemId)->first();

        if (!$marketplaceItem) {
            return response()->json(['message' => 'Item not found in the marketplace.'], 404);
        }

        $marketplaceItem->status = 'Sold';
        $marketplaceItem->save();

        return response()->json($marketplaceItem);
    }
}
