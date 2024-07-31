<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\admin\Evenement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function home()
    {
        $evenements = Evenement::where('is_delete', FALSE)->count();

        $evenements = $this->formatNumber($evenements);

        return view('backend.admin', compact('evenements'));

    }

    private function formatNumber($number)
    {
        if($number < 10){
            return '0' . $number;
        }
        elseif($number >= 1000000){
            return number_format($number / 1000000, 1) . 'M';
        }
        elseif($number >= 1000){
            return number_format($number / 1000, 1) . 'k';
        }

        return $number;
    }
}
