<?php

namespace App\Http\Controllers;

use App\Models\Mstadmin;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        return view('login');
    }

    ///------- Login function --------//

    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        $mstauth = Mstadmin::where(['email' => $email, 'password' => $password])->get();
        //--- alert for correct email and Password ---//
        if (isset($mstauth[0]->userId)) {
            $request->session()->put('USER_LOGIN', true);
            $request->session()->put('USER_ID', $mstauth['0']->userId);
            // return redirect('dashboard');
            return redirect('dashboard')->with('success', 'Welcome!');
        } else {
            // Authentication failed
            return redirect('login')->with('error', 'Invalid email or password.');
        }
    }

    ///------- LogOut function --------//

    public function logout(Request $request)
    {
        if ($request->session()->has('USER_LOGIN')) {
            $request->session()->forget('USER_LOGIN');
            $request->session()->forget('USER_ID');
        }
        return redirect('login');
    }

    //----- Data Get functions In Dashboard & ViewPage Dashboard--------//

    public function index()
    {

        $data = DB::table('transections')->where('isApproved', 0)->get();
        $totalsum = DB::table('transections')->sum('amount');
        $totalsumwithdraw = DB::table('withdrawrequest')->sum('amount');
        $totalbalanceprofit = DB::table('balance')->sum('profit_gain');

        // $withdrawChart = DB::table('withdrawrequest')->pluck('amount')->toArray();

        return view('dashboard', ['data' => $data, 'totalsum' => $totalsum, 'totalsumwithdraw' => $totalsumwithdraw, 'totalbalanceprofit' => $totalbalanceprofit,]);
    }

    //------- Transection  -----------//

    public function transactionpage()
    {
        $data = DB::table('transections')->where('isApproved', 0)->get();
        return view('transaction', ['data' => $data]);
    }
    //------ GET in modal Transections Amount  ------//

    public function gettransections($id)
    {
        $data = DB::table('transections')->where('transectionId', $id)->first();
        return response()->json($data);
    }

    //------- Transection update and Insert functions -----------//

    public function updatetransections(Request $request)
    {
        $data = $request->only(['transectionId', 'userid', 'transectionNo', 'addDate', 'amount', 'transaction_type', 'screenshotImage']);

        // Check if transaction with the given transactionNo already exists
        $existingTransaction = DB::table('transaction_history')->where('transaction_no', $data['transectionNo'])->first();
        if ($existingTransaction) {
            return response()->json(['error' => 'Transaction already exists'], 400);
        }
        // Set a default value for transaction_type if it is null or empty
        if (empty($data['transaction_type'])) {
            $data['transaction_type'] = 'recharge';
        }

        // Update the transaction in the transections table
        DB::table('transections')
            ->where('transectionId', $data['transectionId'])
            ->update(array_merge($data, ['isApproved' => 1]));

        // Insert the updated transaction into the transaction_history table

        DB::table('transaction_history')->insert([
            'transaction_no' => $data['transectionNo'],
            'addDate' => $data['addDate'],
            'amount' => $data['amount'],
            'screenshotImage' => $data['screenshotImage'],
            'transaction_type' => $data['transaction_type'],
            // Add other fields from $data as needed
        ]);
        $balance = DB::table('balance')->where('userId', $data['userid'])->first();

        if ($balance) {
            DB::table('balance')
                ->where('userId', $data['userid'])
                ->increment('balance', $data['amount']);
        } else {
            DB::table('balance')->insert([
                'userId' => $data['userid'],
                'balance' => $data['amount'],
            ]);
        }

        ///-------- this code is check to if reffer code is available mstuser table then
        //--------- check to raffer table is there available same rafercode and userid
        //--------- then 2% amount add balance table which amount we add those userid ------///

        // Check if referral code exists
        $referralCode = DB::table('mstuser')->where('userId', $data['userid'])->value('refferal_code');
        if ($referralCode) {
            $referrer = DB::table('reffercodes')->where('reffer_code', $referralCode)->first();
            if ($referrer) {
                $referrerUserId = $referrer->user_id;
                $referrerBalance = DB::table('balance')->where('userId', $referrerUserId)->first();
                if ($referrerBalance) {
                    $referrerAmount = $data['amount'] * 0.05; // Calculate 2% of the amount
                    DB::table('balance')
                        ->where('userId', $referrerUserId)
                        ->increment('balance', $referrerAmount);
                }
            }
        }
        return response()->json(['success' => 'Updated successfully'], 201);
    }


    //-------- Delete Transection ---------//

    public function transectiondestroy($id)
    {
        DB::table('transections')->where('transectionId', $id)->delete();
        return response()->json([
            'success' => 'Successfully Deleted',
        ], 201);
    }

    ///------  withdraw -----///

    public function WithdrawPage()
    {
        $draw = DB::table('withdrawrequest')->where('isApproved', 0)->get();
        return view('withdraw', ['draw' => $draw]);
    }
    //---------- WithDraw Request Fetch data -------//

    public function getwithdraw($id)
    {
        $withdrawData = DB::table('withdrawrequest')
            ->join('mstuser', 'withdrawrequest.userId', '=', 'mstuser.userId')
            ->where('withdrawrequest.withdrawRequestId', $id)
            ->first();

        return response()->json($withdrawData);
    }

    public function updateWithdraw(Request $request, $withdrawRequestId)
    {
        // Retrieve the form data
        $amount = $request->input('amount');

        // Update the withdrawal amount
        $affectedRows = DB::table('withdrawrequest')
            ->where('withdrawRequestId', $withdrawRequestId)
            ->update(['amount' => $amount, 'isApproved' => 1]);

        if ($affectedRows > 0) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function withdrawdestroy($id)
    {
        DB::table('withdrawrequest')->where('withdrawRequestId', $id)->delete();
        return response()->json([
            'success' => 'Successfully Deleted',
        ], 201);
    }

    //---------- Delete buy stock data Delete -------//

    public function buystockdestroy($buyStockId)
    {
        DB::table('buystock')->where('buyStockId', $buyStockId)->delete();
        return response()->json([
            'success' => true,
        ], 201);
    }

    //---------- Company data  -------//

    public function CompaniesPage()
    {
        $company = DB::table('companies')->get();
        return view('company', ['company' => $company]);
    }

    //----- Company Store data ----------///

    public function storecompany(Request $req)
    {
        $addcomapny = [
            'company_logo' => $req->logourl,
            'company_name' => $req->companyname,
            'short_title' => $req->shortname,
            'profit_margin' => $req->shareprofit,
            'income' => $req->income,
        ];
        DB::table('companies')->where(['companyId' => $req->companyId])->insert($addcomapny);
        return response()->json([
            'success' => 'Updated successfully',
        ], 201);
    }

    public function companydestroy($companyId)
    {
        DB::table('companies')->where('companyId', $companyId)->delete();
        return response()->json([
            'success' => true,
        ], 201);
    }

    public function manageuserpage()
    {
        $manageuser = DB::table('mstuser')->get();
        return view('manageuser', ['manageuser' => $manageuser]);
    }

    public function BuyStock()
    {
        $buystock = DB::table('buystock')->get();
        return view('buystock', ['buystock' => $buystock]);
    }
}
