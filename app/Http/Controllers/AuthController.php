<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\{Auth, DB, Hash, Storage};
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function submitLogin(Request $request) {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $isLoginOK = Auth::attempt($validated);

        if (! $isLoginOK) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['auth-validation' => 'Incorrect username or password.']);
        }

        return redirect('home');
    }

    public function submitRegister(Request $request) {
        $validated = $request->validate([
            'email' => 'required|unique:users|string|email',
            'name' => 'required|string',
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        Auth::login($user);

        return redirect('home');
    }

    public function viewLogin(Request $request) {
        // if (Auth::check()) {
        //     return redirect('home');
        // }

        return response(view('login'));
        // ->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
        //     ->header('Pragma', 'no-cache')
        //     ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');;
    }

    public function viewRegister(Request $request) {
        // if (Auth::check()) {
        //     return redirect('home');
        // }

        return view('register');
    }

    public function submitLogout(Request $request) {
        // if (Auth::check()) {
        //     Auth::logout();
        // }
        Auth::logout();

        return redirect('home');
    }

    public function viewProfile(Request $request) {
        if (! Auth::check()) {
            return redirect('home');
        }

        $user = Auth::user();
        $elapsedDays = $user->created_at->diff(Carbon::now())->days;
        $serverTime = Carbon::now()->toISOString();
        $hasYourImage = ! empty($user->image_path);

        return view('user.profile', compact('user', 'elapsedDays', 'serverTime', 'hasYourImage'));
    }

    public function submitUploadYourImage(Request $request) {
        $request->validate([
            'imageToUpload' => ['required', 'file', 'image', 'max:5120'],
        ]);

        DB::transaction(function () use ($request) {
            $user = $request->user();

            $oldImagePath = $user->image_path;
            $filePath = $request->file('imageToUpload')->store('uploaded/images');

            $user->image_path = $filePath;
            $user->save();

            // delete old image of user if it exists
            if (! empty($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        });

        return redirect(route('profile'));
    }

    public function downloadYourImage(Request $request) {
        $user = $request->user();
        $hasYourImage = ! empty($user->image_path);

        if (! $hasYourImage) {
            return response('You have not uploaded your image.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return Storage::download($user->image_path);
    }

    /**
     * Method to delete uploaded image. Unused for now since I can't think of a
     * smooth way to make the delete link consistent with the current form.
     * @param Request $request
     */
    public function deleteYourImage(Request $request) {
        $user = $request->user();
        $hasYourImage = ! empty($user->image_path);

        if (! $hasYourImage) {
            return response(
                'You have not uploaded your image.',
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }

        $oldImagePath = $user->image_path;
        $user->image_path = '';
        $user->save();
        Storage::delete($oldImagePath);

        return redirect(route('profile'));
    }

    public function getRandomWords(Request $request) {
        $user = $request->user();

        $randomWords = $user->randomly_generated_words;

        if (empty($randomWords)) {
            $randomWords = [];
            $randomLength = rand(3, 7);
            for ($i = 0; $i < $randomLength; $i++) {
                $randomWords[] = str_replace([',', '.'], '', mb_strtolower(fake()->realTextBetween(1, 15)));
            }
            $randomWords = encrypt(implode(' ', $randomWords));
            $user->randomly_generated_words = $randomWords;
            $user->save();
        }

        $decryptedRandomWords = decrypt($randomWords);

        return response($decryptedRandomWords);
    }
}
