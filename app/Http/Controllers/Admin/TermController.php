<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function index()
    {
        $terms = Term::orderBy('sort_order')->orderByDesc('id')->paginate(10);
        return view('admin.terms.index', compact('terms'));
    }

    public function create()
    {
        $term = new Term();
        return view('admin.terms.create', compact('term'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'content' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        Term::create($validated);

        return redirect()->route('admin.terms.index')->with('success', 'Syarat & ketentuan berhasil ditambahkan.');
    }

    public function edit(Term $term)
    {
        return view('admin.terms.edit', compact('term'));
    }

    public function update(Request $request, Term $term)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:100',
            'content' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $term->update($validated);

        return redirect()->route('admin.terms.index')->with('success', 'Syarat & ketentuan berhasil diperbarui.');
    }

    public function destroy(Term $term)
    {
        $term->delete();
        return redirect()->route('admin.terms.index')->with('success', 'Syarat & ketentuan berhasil dihapus.');
    }
}
