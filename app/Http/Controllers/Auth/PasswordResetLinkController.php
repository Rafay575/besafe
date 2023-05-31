<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormValidatitionDispatcherController;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, $channel = "web")
    {
        // $request->validate([
        //     'email' => ['required', 'email'],
        // ]);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);


        if ($channel == "api") {
            $formErrorsResponse = FormValidatitionDispatcherController::Response($validator, $channel);
            if ($formErrorsResponse) {
                return $formErrorsResponse;
            }
            if (!User::where('email', $request->email)->first()) {
                return ApiResponseController::error('Email is not attached to any user');
            }
        }

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($channel == 'api') {
            return ApiResponseController::success('Password reset link has been sent to your email');
        }
        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
    }
}