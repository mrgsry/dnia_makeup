<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Package;
use App\Models\Service;
use App\Models\Term;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $testimonials = Testimonial::latest()->take(3)->get();
        $packages = Package::all();
        $galleries = Gallery::latest()->take(8)->get();
        $terms = Term::where('is_active', true)->orderBy('sort_order')->orderByDesc('id')->get();

        return view('home', compact('services', 'testimonials', 'packages', 'galleries', 'terms'));
    }

    public function packageDetail(string $slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        return view('package-detail', compact('package'));
    }
}
