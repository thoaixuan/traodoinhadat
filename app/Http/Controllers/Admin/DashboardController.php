<?php

namespace App\Http\Controllers\Admin;

use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DashboardController extends Controller
{

    public function index(Request $request)
    {
        SEOTools::setTitle(setting()->name." - Bảng điều khiển");
        SEOTools::opengraph()->setUrl(\URL::current());
        return view("admin.pages.dashboard.index");
    }
}
