<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\order;
use Illuminate\Http\Request;
use App\Models\notifications;
use App\Jobs\SendUserEmailJob;
use App\Jobs\SendWelcomeEmailJob;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
            $monthlyEarnings = order::whereMonth('created_at', date('m'))->sum('total_price');
            $totalSales = order::sum('total_price');
            $totalOrders = order::count();
            $totalUsers = User::count();
            $orders = order::with('user', 'payment')->latest('id')->paginate(8);
            $users = User::all();

        return view('admin.index', compact('monthlyEarnings', 'totalSales', 'totalOrders', 'totalUsers','orders','users'));
    }


    function profile(){

        $admin =Auth::user();
        return view('admin.profile',compact('admin'));

    }
    function profile_data(Request $request){

      $request->validate([
        'name'=>'required',
        'current_password'=>'required_with:password',
        'password'=>'nullable|min:8|confirmed',
      ]);

      /** @var User $admin */
      $admin=Auth::user();


      $data=[
        'name'=>$request->name,
      ];
      if($request->has('password')){
        $data['password']= bcrypt($request->password);
      }
      $admin->update($data);


        if($request->hasFile('image')){
            if($admin->image){
                File::delete(public_path('image/'.$admin->image->path));
                $admin->image()->delete();
            }
            $img_name=rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'),$img_name);
    //**لاختيار صورة واحدة */
            $admin->image()->create([
                'path'=>$img_name
            ]);
        }



      return redirect()->back()->with('msg','Profile update successfuly');
    }
    function check_password(Request $request){

        return Hash::check($request->password ,Auth::user()->password);
    }
    function orders(){
        if(request()->has('id')){
            $id =request()->id;
            Auth::user()->notifications->find($id)->markAsRead();
        }

        return 'Ordere page';
    }
    function notifications(){
        Auth::user()->notifications->markAsRead();
        return view('admin.notifications');


    }
            public function getIndexStats()
        {
            $monthlyEarnings = Order::whereMonth('created_at', date('m'))->sum('total_price');
            $totalSales = Order::sum('total_price');
            $totalOrders = Order::count();
            $totalUsers = User::count();

            return response()->json([
                'monthlyEarnings' => number_format($monthlyEarnings, 2),
                'totalSales' => number_format($totalSales, 2),
                'totalOrders' => number_format($totalOrders),
                'totalUsers' => number_format($totalUsers),
            ]);
        }
        public function getChartData()
        {
            // جلب الأرباح الشهرية
            $earnings = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');

            // جلب مصادر الإيرادات
            $revenueSources = [
                'Direct' => Order::where('source', 'direct')->count(),
                'Social' => Order::where('source', 'social')->count(),
                'Referral' => Order::where('source', 'referral')->count(),
            ];

            return response()->json([
                'earnings' => $earnings,
                'revenueSources' => $revenueSources
            ]);
        }


        public function sendEmailsToUsers(Request $request)
        {
            $count = intval($request->input('count', 10)); // العدد الذي أدخله المستخدم
            $delay = 0;

            // جلب العدد المحدد فقط
            $users = User::whereNotNull('email')->take($count)->get();

            foreach ($users as $user) {
                SendUserEmailJob::dispatch($user->id)->delay(now()->addSeconds($delay));
                $delay += 1; // كل إيميل يتأخر 1 ثانية (يمكنك تعديلها)
            }

            return redirect('admin');

         }


         public function printSend(Request $request)
         {
             $count = intval($request->input('count', 10)); // العدد الذي أدخله المستخدم
             $delay = 0;

             // جلب العدد المحدد فقط
             $users = User::whereNotNull('email')->take($count)->get();

             foreach ($users as $user) {
                SendWelcomeEmailJob::dispatch($user->id)->delay(now()->addSeconds($delay));
                 $delay += 1;
             }

             return redirect('admin');
          }

}
