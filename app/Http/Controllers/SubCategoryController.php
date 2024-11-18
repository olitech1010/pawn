<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function store(Request $request, $categoryId)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:sub_categories',
        ]);

        $subCategory = SubCategory::create([
            'category_id' => $categoryId,
            'name' => $validated['name'],
        ]);

        return response()->json(['message' => 'Subcategory created successfully.', 'subCategory' => $subCategory], 201);
    }

    public function update(Request $request, $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:sub_categories,name,' . $id,
        ]);

        $subCategory->update($validated);

        return response()->json(['message' => 'Subcategory updated successfully.', 'subCategory' => $subCategory]);
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully.']);
    }
}
