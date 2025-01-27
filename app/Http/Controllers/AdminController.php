<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the total number of links and users    
        $data = [
            'links' => Link::count(),
            'users' => User::count()
        ];

        // Get the selected periods from the request, default to 'daily'    
        $periodLinks = $request->input('periodLinks', 'daily');
        $periodUsers = $request->input('periodUsers', 'daily');

        // Fetch data for links based on the selected period    
        $datesLinks = [];
        $linkCounts = [];

        switch ($periodLinks) {
            case 'monthly':
                // Get the last 12 months    
                for ($i = 11; $i >= 0; $i--) {
                    $date = Carbon::now()->subMonths($i)->format('Y-m');
                    $datesLinks[] = $date;

                    // Count links created in this month    
                    $linkCounts[] = Link::whereMonth('created_at', Carbon::parse($date)->month)
                        ->whereYear('created_at', Carbon::parse($date)->year)
                        ->count();
                }
                break;

            case 'yearly':
                // Get the last 5 years    
                for ($i = 4; $i >= 0; $i--) {
                    $date = Carbon::now()->subYears($i)->format('Y');
                    $datesLinks[] = $date;

                    // Count links created in this year    
                    $linkCounts[] = Link::whereYear('created_at', $date)->count();
                }
                break;

            default: // 'daily'    
                // Get the last 7 days    
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i)->format('Y-m-d');
                    $datesLinks[] = $date;

                    // Count links created on this day    
                    $linkCounts[] = Link::whereDate('created_at', $date)->count();
                }
                break;
        }

        // Fetch data for users based on the selected period    
        $datesUsers = [];
        $userCounts = [];

        switch ($periodUsers) {
            case 'monthly':
                // Get the last 12 months    
                for ($i = 11; $i >= 0; $i--) {
                    $date = Carbon::now()->subMonths($i)->format('Y-m');
                    $datesUsers[] = $date;

                    // Count users created in this month    
                    $userCounts[] = User::whereMonth('created_at', Carbon::parse($date)->month)
                        ->whereYear('created_at', Carbon::parse($date)->year)
                        ->count();
                }
                break;

            case 'yearly':
                // Get the last 5 years    
                for ($i = 4; $i >= 0; $i--) {
                    $date = Carbon::now()->subYears($i)->format('Y');
                    $datesUsers[] = $date;

                    // Count users created in this year    
                    $userCounts[] = User::whereYear('created_at', $date)->count();
                }
                break;

            default: // 'daily'    
                // Get the last 7 days    
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i)->format('Y-m-d');
                    $datesUsers[] = $date;

                    // Count users created on this day    
                    $userCounts[] = User::whereDate('created_at', $date)->count();
                }
                break;
        }

        return view('admin.dashboard', compact('data', 'datesLinks', 'linkCounts', 'datesUsers', 'userCounts', 'periodLinks', 'periodUsers'));
    }

    public function linkList(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $links = Link::where('original_url', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $links = Link::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('admin.list', compact('links', 'search'));
    }
}