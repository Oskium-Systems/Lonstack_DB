<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // ─── Main Pages 
    public function home()
    {
        $homeBlogs = \App\Models\Blog::with('category')
            ->withCount('comments')
            ->where('status', true)
            ->latest('published_at')
            ->take(2)
            ->get();

        return view('welcome', compact('homeBlogs'));
    }
    public function about()
    {
        return view('pages.about');
    }
    public function services()
    {
        return view('pages.services');
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

    //Portfolio
      public function portfolio()
    {
        return view('pages.portfolio.portfolio');
    }

        public function portfolioDetails()
    {
        return view('pages.portfolio.portfolio-details');
    }

    //Blogs
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
                // Only top-level published comments, with their published replies
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

    // ─── Company
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
        return view('pages.company.testimonials');
    }
    public function awards()
    {
        return view('pages.company.awards');
    }

    // ─── Services: Web3 ────────────────────────────────────────
    public function blockchainDevelopment()
    {
        return view('pages.services.blockchain-development');
    }
    public function web3Development()
    {
        return view('pages.services.web3-development');
    }
    public function cryptoExchange()
    {
        return view('pages.services.crypto-exchange-development');
    }
    public function cryptoWallet()
    {
        return view('pages.services.crypto-wallet-development');
    }
    public function dexDevelopment()
    {
        return view('pages.services.dex-development');
    }
    public function nftMarketplace()
    {
        return view('pages.services.nft-marketplace-development');
    }
    public function smartContract()
    {
        return view('pages.services.smart-contract-development');
    }
    public function p2pCryptoExchange()
    {
        return view('pages.services.p2p-crypto-exchange');
    }

    // ─── Services: Software Development ───────────────────────
    public function customSoftware()
    {
        return view('pages.services.custom-software-development');
    }
    public function webAppDevelopment()
    {
        return view('pages.services.web-application-development');
    }
    public function mobileAppDevelopment()
    {
        return view('pages.services.mobile-app-development');
    }
    public function uxUiDesign()
    {
        return view('pages.services.ux-ui-design');
    }
    public function cloudDevops()
    {
        return view('pages.services.cloud-devops-engineering');
    }
    public function productDiscovery()
    {
        return view('pages.services.product-discovery');
    }
    public function dedicatedTeam()
    {
        return view('pages.services.dedicated-development-team');
    }
    public function predictionMarket()
    {
        return view('pages.services.prediction-market-development');
    }
    public function staffAugmentation()
    {
        return view('pages.services.staff-augmentation');
    }

    // ─── Services: AI
    public function aiConsulting()
    {
        return view('pages.services.ai-consulting');
    }
    public function aiDevelopment()
    {
        return view('pages.services.ai-development');
    }

    // ─── Services: Data & Analytics
    public function dataAnalytics()
    {
        return view('pages.services.data-analytics');
    }
    public function dataEngineering()
    {
        return view('pages.services.data-engineering');
    }

    // ─── Technologies
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

    // ─── Industries ────────────────────────────────────────────
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
