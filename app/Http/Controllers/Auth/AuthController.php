<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    )
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function loginView(Request $request): Factory|View|Application
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * @return Factory|View|Application
     */
    public function registerView(): Factory|View|Application
    {
        return view('auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $register = $this->authService->register($data);

        if ($register) {
            return redirect()
                ->route('login')
                ->with(['success' => 'The registration process has been completed successfully, you can log in.']);
        }

        return back()->withErrors([
            'error' => 'An error occurred.',
        ]);
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()
            ->route('login');
    }
}
