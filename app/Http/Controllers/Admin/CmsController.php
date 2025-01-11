<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\CmsService;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function __construct(
        protected CmsService $cmsService
    ) {}

    public function index()
    {
        return view('pages.admin.cms.index');
    }

    public function home()
    {
        return view('pages.admin.cms.home.index');
    }
}
