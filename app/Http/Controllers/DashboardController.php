<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\News;
use App\Models\Member;
use App\Models\Contact;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Service;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNews = News::count();
        $totalProjects = Project::count();
        $totalServices = Service::count();
        $totalFaqs = Faq::count();
        $totalMembers = Member::count();
        $totalPartners = Partner::count();
        $totalEmails = Contact::count();
        $totalSubscribers = Subscriber::count();

        return view('dashboard.index', compact(
            'totalNews',
            'totalProjects',
            'totalServices',
            'totalFaqs',
            'totalMembers',
            'totalPartners',
            'totalEmails',
            'totalSubscribers'
        ));
    }
}
