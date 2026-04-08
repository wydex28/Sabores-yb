<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Categoría creada con éxito.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada con éxito.');
    }

    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'No se puede eliminar la categoría "' . $category->name . '" porque tiene ' . $category->products()->count() . ' productos asociados. Elimina o mueve los productos primero.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada.');
    }

    public function reorder()
    {
        $categories = Category::orderBy('sort_order', 'asc')->get();
        return view('admin.categories.reorder', compact('categories'));
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->orders as $id => $order) {
            Category::where('id', $id)->update(['sort_order' => $order]);
        }
        return redirect()->route('categories.index')->with('success', 'Orden actualizado correctamente.');
    }
}
