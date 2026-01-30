<?php

namespace App\Http\Controllers;

use App\Models\Central\LandingPage;
use App\Models\Central\Post;
use App\Models\Central\Testimonial;
use App\Models\Central\Package;
use App\Models\Central\Contact;
use App\Models\Central\TenantRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    public function index()
    {
        $landing = LandingPage::where('is_active', true)->first();
        $posts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(3)
            ->get();
        $testimonials = Testimonial::active()->get();
        $packages = Package::active()->get();

        return view('landing.index', compact('landing', 'posts', 'testimonials', 'packages'));
    }

    public function about()
    {
        $landing = LandingPage::where('is_active', true)->first();
        return view('landing.about', compact('landing'));
    }

    public function features()
    {
        $landing = LandingPage::where('is_active', true)->first();
        return view('landing.features', compact('landing'));
    }

    public function pricing()
    {
        $packages = Package::active()->get();
        return view('landing.pricing', compact('packages'));
    }

    public function blog()
    {
        $posts = Post::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);
        
        return view('landing.blog', compact('posts'));
    }

    public function blogShow($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
        
        $post->incrementViews();
        
        $relatedPosts = Post::where('is_published', true)
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('landing.blog-show', compact('post', 'relatedPosts'));
    }

    public function contact()
    {
        $landing = LandingPage::where('is_active', true)->first();
        return view('landing.contact', compact('landing'));
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return back()->with('success', 'Pesan Anda telah dikirim! Kami akan segera menghubungi Anda.');
    }

    public function register()
    {
        $packages = Package::active()->get();
        return view('landing.register', compact('packages'));
    }

    public function registerStore(Request $request)
    {
        $validated = $request->validate([
            'nama_koperasi' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255|unique:tenant_registrations,subdomain',
            'email' => 'required|email|max:255|unique:tenant_registrations,email',
            'phone' => 'required|string|max:20',
            'alamat' => 'required|string',
            'pic_name' => 'required|string|max:255',
            'pic_position' => 'required|string|max:255',
            'pic_phone' => 'required|string|max:20',
            'pic_email' => 'required|email|max:255',
            'package_id' => 'required|exists:packages,id',
        ]);

        TenantRegistration::create($validated);

        return redirect()->route('landing.register.success')
            ->with('success', 'Pendaftaran berhasil! Kami akan menghubungi Anda untuk verifikasi dokumen.');
    }

    public function registerSuccess()
    {
        return view('landing.register-success');
    }
}