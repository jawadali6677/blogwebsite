<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function profile(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $imageName = null;
            $image_path = auth()->user()->image;
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
                "name"=>"required",
                "email"=>"required",
            ]);

            if($request->hasFile('image')){

                $uploadDir = 'images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $imageName = time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $image_path = $uploadDir.$imageName;
            }

            User::where('id' , auth()->user()->id)->update([
                "name"=>$request->name,
                "email"=>$request->email,
                "phone"=>$request->phone,
                "country"=>$request->country,
                "date_of_birth"=>$request->date_of_birth,
                "gender"=>$request->gender,
                "image" => $image_path,
            ]);

            DB::commit();
            return response()->json(['success' => true , "image" => asset($image_path), 'message' => "Record added successfully."]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['success' => false , 'message' => $th->getMessage()] , 500);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
