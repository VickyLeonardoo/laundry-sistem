<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        date_default_timezone_set('Asia/Jakarta');
        $todayDate = Carbon::now();

        //Today Order
        $orderProses = Order::where('statusOrder','Diproses')->whereDate('created_at',$todayDate)->count();
        $orderSelesai = Order::where('statusOrder','Selesai')->whereDate('created_at',$todayDate)->count();
        $orderMenunggu = Order::where('statusOrder','Menunggu Verifikasi')->whereDate('created_at',$todayDate)->count();
        $todayOrder = Order::whereDate('created_at',$todayDate)->count();

        //Total Order
        $totalOrder = Order::count();
        $totalProses = Order::where('statusOrder','Diproses')->count();
        $totalSelesai = Order::where('statusOrder','Selesai')->count();
        $totalMenunggu = Order::where('statusOrder','Menunggu Verifikasi')->count();

        return view('admin.dashboard',compact('todayDate','orderProses','orderSelesai','orderMenunggu','todayOrder','totalProses','totalSelesai','totalMenunggu','totalOrder'));
    }
}
