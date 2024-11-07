<?php

// app/Http/Controllers/AppController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppModel; // Import the AppModel
use Illuminate\Support\Facades\Auth; // For user authentication

class AppController extends Controller
{
    // Constructor if needed for middleware (auth, etc.)
    public function __construct()
    {
        // Example: You could add authentication middleware if you want
        // $this->middleware('auth');
    }

    // Handle the homepage and the app (dashboard page)
    public function index()
    {
        // Fetch all the wins of the logged-in user
        // Fetch all wins for the currently authenticated user
        $wins = AppModel::where('user_id', Auth::id())->get();

        // Process the wins here for charting or display
        return view('dashboard.dashboard', compact('wins'));

        // Calculate win and loss points (similar to your old controller logic)
        $chartData = $this->calculateChartData($wins);

        // Handle session data for the dashboard
        $sessionData = $this->getSessionData($wins);

        // Define breadcrumbs for the homepage or app
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('home')],
            ['name' => 'Dashboard', 'url' => route('app.index')],
        ];

        // Return the view with data (wins, chart data, session data)
        return view('dashboard.dashboard', compact(
            'wins',
            'chartData',
            'sessionData',
            'breadcrumbs'
        ));
    }

    // Store a new win associated with the logged-in user
    public function storeWin(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'description' => 'required|string|max:255',
            'is_win' => 'required|boolean',
            'risk' => 'required|numeric|min:0',
            'risk_reward_ratio' => 'required|numeric|min:0',
            'hour_session' => 'required|string|max:50',
        ]);

        // Create the win record and associate it with the logged-in user
        AppModel::create([
            'description' => $data['description'],
            'is_win' => $data['is_win'],
            'risk' => $data['risk'],
            'risk_reward_ratio' => $data['risk_reward_ratio'],
            'hour_session' => $data['hour_session'],
            'user_id' => Auth::id(), // Associate the win with the logged-in user
        ]);

        return redirect()->route('app.index'); // Redirect to the dashboard
    }

    // Calculate win and loss points for chart data
    private function calculateChartData($wins)
    {
        $winPoints = 0;
        $lossPoints = 0;

        foreach ($wins as $trade) {
            $risk = $trade->risk;
            $rewardRatio = $trade->risk_reward_ratio;

            if ($trade->is_win) {
                $winPoints += $risk * $rewardRatio; // Calculate win points
            } else {
                $lossPoints += $risk; // Calculate loss points
            }
        }

        return [
            'winPoints' => $winPoints,
            'lossPoints' => $lossPoints,
        ];
    }

    // Get session data (counts by session)
    private function getSessionData($wins)
    {
        $possibleSessions = ['NY AM', 'London', 'NY PM', 'Other', 'Asian'];
        $sessionCounts = $wins->groupBy('hour_session')->map->count();

        $sessionData = [];
        foreach ($possibleSessions as $session) {
            $sessionData[$session] = $sessionCounts->get($session, 0);
        }

        return $sessionData;
    }
}
