<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// page routes
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact-us');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');

// Company menu
Route::get('/career', [PageController::class, 'career'])->name('career');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/press', [PageController::class, 'press'])->name('press');
Route::get('/testimonials', [PageController::class, 'testimonials'])->name('testimonials');
Route::get('/awards', [PageController::class, 'awards'])->name('awards');


// Services — Web3
Route::get('/services/blockchain-development', [PageController::class, 'blockchainDevelopment'])->name('services.blockchain');
Route::get('/services/web3-development', [PageController::class, 'web3Development'])->name('services.web3');
Route::get('/services/crypto-exchange-development', [PageController::class, 'cryptoExchange'])->name('services.crypto-exchange');
Route::get('/services/crypto-wallet-development', [PageController::class, 'cryptoWallet'])->name('services.crypto-wallet');
Route::get('/services/dex-development', [PageController::class, 'dexDevelopment'])->name('services.dex');
Route::get('/services/nft-marketplace-development', [PageController::class, 'nftMarketplace'])->name('services.nft');
Route::get('/services/smart-contract-development', [PageController::class, 'smartContract'])->name('services.smart-contract');
Route::get('/services/p2p-crypto-exchange', [PageController::class, 'p2pCryptoExchange'])->name('services.p2p');


// Services — Software Development
Route::get('/services/custom-software-development', [PageController::class, 'customSoftware'])->name('services.custom-software');
Route::get('/services/web-application-development', [PageController::class, 'webAppDevelopment'])->name('services.web-app');
Route::get('/services/mobile-app-development', [PageController::class, 'mobileAppDevelopment'])->name('services.mobile-app');
Route::get('/services/ux-ui-design', [PageController::class, 'uxUiDesign'])->name('services.ux-ui');
Route::get('/services/cloud-devops-engineering', [PageController::class, 'cloudDevops'])->name('services.cloud-devops');
Route::get('/services/product-discovery', [PageController::class, 'productDiscovery'])->name('services.product-discovery');
Route::get('/services/dedicated-development-team', [PageController::class, 'dedicatedTeam'])->name('services.dedicated-team');
Route::get('/services/prediction-market-development', [PageController::class, 'predictionMarket'])->name('services.prediction-market');
Route::get('/services/staff-augmentation', [PageController::class, 'staffAugmentation'])->name('services.staff-augmentation');


// Services — AI
Route::get('/services/ai-consulting', [PageController::class, 'aiConsulting'])->name('services.ai-consulting');
Route::get('/services/ai-development', [PageController::class, 'aiDevelopment'])->name('services.ai-development');

// Services — Data & Analytics
Route::get('/services/data-analytics', [PageController::class, 'dataAnalytics'])->name('services.data-analytics');
Route::get('/services/data-engineering', [PageController::class, 'dataEngineering'])->name('services.data-engineering');


// Technologies
Route::get('/technologies/nodejs', [PageController::class, 'nodejs'])->name('tech.nodejs');
Route::get('/technologies/reactjs', [PageController::class, 'reactjs'])->name('tech.reactjs');
Route::get('/technologies/react-native', [PageController::class, 'reactNative'])->name('tech.react-native');
Route::get('/technologies/solidity', [PageController::class, 'solidity'])->name('tech.solidity');
Route::get('/technologies/solana', [PageController::class, 'solana'])->name('tech.solana');
Route::get('/technologies/expressjs', [PageController::class, 'expressjs'])->name('tech.expressjs');
Route::get('/technologies/laravel', [PageController::class, 'laravelTech'])->name('tech.laravel');
Route::get('/technologies/nestjs', [PageController::class, 'nestjs'])->name('tech.nestjs');


// Industries
Route::get('/industries/oil-gas', [PageController::class, 'oilGas'])->name('industries.oil-gas');
Route::get('/industries/logistics', [PageController::class, 'logistics'])->name('industries.logistics');
Route::get('/industries/fintech', [PageController::class, 'fintech'])->name('industries.fintech');
Route::get('/industries/retail', [PageController::class, 'retail'])->name('industries.retail');
Route::get('/industries/real-estate', [PageController::class, 'realEstate'])->name('industries.real-estate');
Route::get('/industries/travel-hospitality', [PageController::class, 'travelHospitality'])->name('industries.travel');
Route::get('/industries/media-entertainment', [PageController::class, 'mediaEntertainment'])->name('industries.media');
Route::get('/industries/healthcare', [PageController::class, 'healthcare'])->name('industries.healthcare');
Route::get('/industries/elearning', [PageController::class, 'elearning'])->name('industries.elearning');
Route::get('/industries/manufacturing', [PageController::class, 'manufacturing'])->name('industries.manufacturing');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
