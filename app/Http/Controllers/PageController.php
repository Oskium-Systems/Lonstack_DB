<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // ─── Main Pages 
    public function home()
    {
        return view('welcome');
    }
    public function about()
    {
        return view('pages.about');
    }
    public function services()
    {
        return view('pages.services');
    }
    public function blogs()
    {
        return view('pages.blogs');
    }
    public function contact()
    {
        return view('pages.contact-us');
    }
    public function portfolio()
    {
        return view('pages.portfolio');
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
