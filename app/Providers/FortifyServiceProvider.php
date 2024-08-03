<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function () {
            return view('pages.auth.login');
        });

        Fortify::registerView(function () {
            return view('pages.auth.register');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = Auth::attempt($request->only('email', 'password'));

            if ($user) {
                switch (Auth::user()->role) {
                    case 'owner':
                        return redirect()->route('owner.dashboard');
                    case 'kolektor':
                        return redirect()->route('kolektor.dashboard');
                    case 'inputer':
                        return redirect()->route('inputer.dashboard');
                    case 'gudang':
                        return redirect()->route('gudang.dashboard');
                    case 'marketing':
                        return redirect()->route('marketing.dashboard');
                    default:
                        return redirect()->route('default.dashboard');
                }
            }

            return false;
        });
    }
}
