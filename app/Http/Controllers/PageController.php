<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
  // ─── Main Pages ───────────────────────────────────────────

  public function home()
  {
    $homeBlogs = Blog::with('category')
      ->withCount('comments')
      ->where('status', true)
      ->latest('published_at')
      ->take(2)
      ->get();

    $homeTestimonials = \App\Models\Testimonial::visible()->take(6)->get();

    return view('welcome', compact('homeBlogs', 'homeTestimonials'));
  }

  public function about()
  {
    return view('pages.about');
  }

  public function services()
  {
    $categories = ServiceCategory::with(['activeServices'])
      ->active()
      ->get();

    return view('pages.services', compact('categories'));
  }

  public function serviceDetail(string $slug)
  {
    $service = Service::with([
      'category',
      'hero',
      'benefits',
      'talkToUs',
      'processSteps',
      'techGroups.tags',
      'testimonials',
      'faqs',
      'relatedServices.relatedService.category',
    ])
      ->where('slug', $slug)
      ->where('is_active', true)
      ->firstOrFail();

    return view('pages.services.service-detail', compact('service'));
  }

  public function contact()
  {
    return view('pages.contact-us');
  }

  public function terms()
  {
    return view('pages.terms-of-service');
  }

  public function policy()
  {
    return view('pages.privacy-policy');
  }

  // ─── Portfolio ────────────────────────────────────────────

  public function portfolio()
  {
    return view('pages.portfolio.portfolio');
  }

  public function portfolioDetails()
  {
    return view('pages.portfolio.portfolio-details');
  }

  // ─── Blog ─────────────────────────────────────────────────

  public function blogs()
  {
    $blogs = Blog::with('category', 'author')
      ->where('status', true)
      ->latest('published_at')
      ->get();

    $categories = \App\Models\BlogCategory::where('status', true)
      ->withCount(['blogs' => fn($q) => $q->where('status', true)])
      ->get();

    $recentBlogs = Blog::with('category')
      ->where('status', true)
      ->latest('published_at')
      ->take(3)
      ->get();

    return view('pages.blogs.blogs', compact('blogs', 'categories', 'recentBlogs'));
  }

  public function blogDetails($slug)
  {
    $blog = Blog::with([
      'category',
      'author',
      'comments' => fn($q) => $q->whereNull('parent_id')
        ->where('status', 'published')
        ->latest(),
      'comments.publishedReplies',
    ])
      ->where('slug', $slug)
      ->where('status', true)
      ->firstOrFail();

    $blog->increment('views');

    $categories = \App\Models\BlogCategory::where('status', true)
      ->withCount(['blogs' => fn($q) => $q->where('status', true)])
      ->get();

    $recentBlogs = Blog::with('category')
      ->where('status', true)
      ->where('id', '!=', $blog->id)
      ->latest('published_at')
      ->take(3)
      ->get();

    return view('pages.blogs.blog-details', compact('blog', 'categories', 'recentBlogs'));
  }

  // ─── Company ──────────────────────────────────────────────

  public function career()
  {
    return view('pages.company.career');
  }

  public function faq()
  {
    return view('pages.company.faq');
  }

  public function press()
  {
    return view('pages.company.press');
  }

  public function testimonials()
  {
    $testimonials = \App\Models\Testimonial::visible()->paginate(6);
    return view('pages.company.testimonials', compact('testimonials'));
  }

  public function awards()
  {
    return view('pages.company.awards');
  }

  // ─── Technologies ─────────────────────────────────────────

  public function nodejs()
  {
    return view('pages.technologies.nodejs');
  }

  public function reactjs()
  {
    return view('pages.technologies.reactjs');
  }

  public function reactNative()
  {
    return view('pages.technologies.react-native');
  }

  public function solidity()
  {
    return view('pages.technologies.solidity');
  }

  public function solana()
  {
    return view('pages.technologies.solana');
  }

  public function expressjs()
  {
    return view('pages.technologies.expressjs');
  }

  public function laravelTech()
  {
    return view('pages.technologies.laravel');
  }

  public function nestjs()
  {
    return view('pages.technologies.nestjs');
  }

  // ─── Industries ───────────────────────────────────────────

  public function oilGas()
  {
    return view('pages.industries.oil-gas');
  }

  public function logistics()
  {
    return view('pages.industries.logistics');
  }

  public function fintech()
  {
    return view('pages.industries.fintech');
  }

  public function retail()
  {
    return view('pages.industries.retail');
  }

  public function realEstate()
  {
    return view('pages.industries.real-estate');
  }

  public function travelHospitality()
  {
    return view('pages.industries.travel-hospitality');
  }

  public function mediaEntertainment()
  {
    return view('pages.industries.media-entertainment');
  }

  public function healthcare()
  {
    return view('pages.industries.healthcare');
  }

  public function elearning()
  {
    return view('pages.industries.elearning');
  }

  public function manufacturing()
  {
    return view('pages.industries.manufacturing');
  }
}
