<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Traits\PendingCountTrait;
use App\Traits\ApprovedCountTrait;
use App\Traits\ReturnedCountTrait;

use App\Models\User;
use App\Models\Office;
use App\Models\Campus;
use App\Models\PpmpUser;
use App\Models\Annoucement;

class UserController extends Controller
{
    use PendingCountTrait;
    use ApprovedCountTrait;
    use ReturnedCountTrait;
    
    public function userRead() {
        $camp = Campus::all();
        $off = Office::all();

        $user = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->join('office', 'users.office_id', '=', 'office.id')
            ->select('users.id as uid', 'users.*', 'campuses.*', 'office.*')
            ->get();

        $pendCount = $this->getPendingAllCount();
        $pendBudCount = $this->getPendingBudgetCount();
        $pendUserCount = $this->getPendingUserCount();

        $approvedUserCount = $this->getApprovedUserCount();
        $receivedUserCount = $this->getReceivedUserCount();
        $canvassingUserCount = $this->getCanvassingUserCount();
        $canvassedUserCount = $this->getCanvassedUserCount();
        $philgepUserCount = $this->getPhilGepUserCount();
        $postedUserCount = $this->getPostedUserCount();
        $biddingUserCount = $this->getBiddingUserCount();
        $consolidateUserCount = $this->getConsolidateUserCount();
        $awardedUserCount = $this->getAwardedUserCount();
        $purchaseUserCount = $this->getPurchaseUserCount();

        $returnedAllCount = $this->getReturnedAllCount();
        $returnedUserCount = $this->getReturnedUserCount();

        $data = [   'pendCount' => $pendCount, 
                    'pendBudCount' => $pendBudCount,
                    'pendUserCount' => $pendUserCount,

                    'approvedUserCount' => $approvedUserCount,
                    'receivedUserCount' => $receivedUserCount,
                    'canvassingUserCount' => $canvassingUserCount,
                    'canvassedUserCount' => $canvassedUserCount,
                    'philgepUserCount' => $philgepUserCount,
                    'postedUserCount' => $postedUserCount,
                    'biddingUserCount' => $biddingUserCount,
                    'consolidateUserCount' => $consolidateUserCount,
                    'awardedUserCount' => $awardedUserCount,
                    'purchaseUserCount' => $purchaseUserCount,

                    'returnedAllCount' => $returnedAllCount,
                    'returnedUserCount' => $returnedUserCount,
                ];

        if (request()->ajax()) {
            return response()->json([
                'pendCount' => $pendCount, 
                'pendBudCount' => $pendBudCount,
                'pendUserCount' => $pendUserCount,

                'approvedUserCount' => $approvedUserCount,
                'receivedUserCount' => $receivedUserCount,
                'canvassingUserCount' => $canvassingUserCount,
                'canvassedUserCount' => $canvassedUserCount,
                'philgepUserCount' => $philgepUserCount,
                'postedUserCount' => $postedUserCount,
                'biddingUserCount' => $biddingUserCount,
                'consolidateUserCount' => $consolidateUserCount,
                'awardedUserCount' => $awardedUserCount,
                'purchaseUserCount' => $purchaseUserCount,

                'returnedAllCount' => $returnedAllCount,
                'returnedUserCount' => $returnedUserCount,
            ]);
        }

        return view("users.listuser", compact('user', 'camp', 'off', 'data'));
    }

    public function getuserRead() 
    {
        $data = User::join('campuses', 'users.campus_id', '=', 'campuses.id')
            ->join('office', 'users.office_id', '=', 'office.id')
            ->where('users.ustatus', '!=', '3')
            ->select('users.id as uid', 'users.*', 'campuses.*', 'office.*')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function userCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'mname' => 'required',
                'username' => 'required|string|min:5|unique:users,username',
                'password' => 'required|string|min:5',
                'campus_id' => 'required',
                'office_id' => 'required',
                'gender' => 'required',
                'role' => 'required',
            ]);

            $userName = $request->input('username'); 
            $existingUser = User::where('username', $userName)->first();

            if ($existingUser) {
                return response()->json(['error' => true, 'message' => 'User already exists!']);
            }

            try {

                $user = User::create([
                    'lname' => $request->input('lname'),
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'username' => $userName,
                    'password' => Hash::make($request->input('password')),
                    'campus_id' => $request->input('campus_id'),
                    'office_id' => $request->input('office_id'),
                    'role' => $request->input('role'),
                    'gender' => $request->input('gender'),
                    'posted_by' => Auth::user()->id,
                    'remember_token' => Str::random(60),
                ]);
                PpmpUser::create([
                    'user_id' => $user->id,
                    'ppmp_categories' => null,
                ]);

                return response()->json(['success' => true, 'message' => 'User stored successfully!']);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store User!']);
            }
        }
    }

    public function userUpdate(Request $request) {
        $user = User::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'office_id' => 'required',
            'role' => 'required',
            'gender' => 'required',
            'campus_id' => 'required',
        ]);

        try {
            $userName = $request->input('username');
            $existingUser = User::where('username', $userName)->where('id', '!=', $request->input('id'))->first();

            if ($existingUser) {
                return response()->json(['error' => true, 'message' => 'Username already exists!']);
            }

            $user = User::findOrFail($request->input('id'));
            $user->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'username' => $userName,
                'office_id' => $request->input('office_id'),
                'role' => $request->input('role'),
                'gender' => $request->input('gender'),
                'campus_id' => $request->input('campus_id'),
                'isAllowed' => $request->input('isAllowed'),
            ]);

            // return redirect()->route('userEdit', ['id' => encrypt($user->id)])->with('success', 'Updated Successfully');
            return response()->json(['success' => true, 'message' => 'User updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update User!']);
        }
    }

    public function userUpdatePassword(Request $request) {
        $user = User::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'password' => 'required|string|min:5',
        ]);

        try {
            $user = User::findOrFail($request->input('id'));
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);

            return response()->json(['success' => true, 'message' => 'User Password updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update User Password!']);
        }
    }

    public function userUpdateStatus(Request $request) {
        $user = User::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'ustatus' => 'required',
        ]);

        try {
            $user = User::findOrFail($request->input('id'));
            $user->update([
                'ustatus' => $request->input('ustatus'),
            ]);

            return response()->json(['success' => true, 'message' => 'User Password updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update User Password!']);
        }
    }

    public function userDelete($id) {
        $usr = User::find($id);
        if ($usr) {
            $usr->ustatus = 3;
            $usr->save();
            return response()->json(['success'=> true, 'message'=>'User deleted successfully']);
        }
        return response()->json(['error'=> true, 'message'=>'Item not found']);
    }

    public function user_settings() {
        return view("info.account_settings");
    }

    public function user_settings_profile_update(Request $request) {
        try {
            $request->validate([
                'lname' => 'required|string|max:255',
                'fname' => 'required|string|max:255',
                'mname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
                'gender' => 'required',
            ]);

            Auth::guard('web')->user()->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'username' => $request->input('username'),
                'gender' => $request->input('gender'),
            ]);

            return redirect()->route('user_settings')->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            return redirect()->route('user_settings')->with('error', 'Failed to update profile');
        }
    }

    public function profilePassUpdate(Request $request) {
        try {
            $request->validate([
                'password' => 'required|string|min:5,' . Auth::id(),
            ]);

            Auth::guard('web')->user()->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('user_settings')->with('success', 'Password updated successfully');
        } catch (Exception $e) {
            return redirect()->route('user_settings')->with('error', 'Failed to update Password');
        }
    }

    public function annouceInfo() {
        $annoucement = Annoucement::first();

        return view('info.annoucement', compact('annoucement'));
    }

    public function annouceUpdate(Request $request) {
        $anouce = Annoucement::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'announcement' => 'required',
            'datestart' => 'required',
            'dateend' => 'required',
        ]);

        try {
            $anouceName = $request->input('announcement');
            $existingAnnouce = Annoucement::where('announcement', $anouceName)->where('id', '!=', $request->input('id'))->first();

            if ($existingAnnouce) {
                return redirect()->back()->with('error', 'Annoucement already exists!');
            }

            $anouce = Annoucement::find($request->input('id'));
            $anouce->update([
                'announcement' => $request->input('announcement'),
                'datestart' => $request->input('datestart'),
                'dateend' => $request->input('dateend'),
                'status' => $request->input('status'),
            ]);

            return redirect()->back()->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Annoucement!');
        }
    }

    public function serverMaintenance()
    {
        return view('info.settingsMaintenance',  [
            'maintenance_mode' => Config::get('settings.maintenance_mode', false),
        ]);
    }

    public function toggleMaintenance(Request $request)
    {
        $maintenanceMode = $request->input('maintenance_mode') === 'on';
        
        // Update the config file or database
        // Example for config file (config/settings.php):
        $configFile = config_path('settings.php');
        $config = require $configFile;
        $config['maintenance_mode'] = $maintenanceMode;
        file_put_contents($configFile, '<?php return ' . var_export($config, true) . ';');

        return redirect()->back()->with('success', 'Maintenance mode updated!');
    }
}
