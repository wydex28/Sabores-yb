<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('admin.superadmin.branches.index', compact('branches'));
    }
 
    public function create()
    {
        return view('admin.superadmin.branches.create');
    }
 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'whatsapp' => 'nullable|string',
        ]);
 
        $validated['is_active'] = $request->has('is_active');
 
        Branch::create($validated);
 
        return redirect()->route('superadmin.branches.index')->with('success', 'Sucursal creada con éxito.');
    }
 
    public function edit(Branch $branch)
    {
        return view('admin.superadmin.branches.edit', compact('branch'));
    }
 
    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'whatsapp' => 'nullable|string',
        ]);
 
        $validated['is_active'] = $request->has('is_active');
 
        $branch->update($validated);
 
        return redirect()->route('superadmin.branches.index')->with('success', 'Sucursal actualizada.');
    }
 
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('superadmin.branches.index')->with('success', 'Sucursal eliminada.');
    }
}
