<?php

namespace LarsJanssen\UnderConstruction;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;

trait Throttle
{
    /**
     * Get the number of attempts left.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function retriesLeft(Request $request)
    {
        return $this->limiter()->retriesLeft($this->throttleKey($request), $this->maxAttempts());
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts(), $this->decayMinutes()
        );
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request), $this->decayMinutes()
        );
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return int
     */
    protected function getBlockedSeconds(Request $request)
    {
        return $this->limiter()->availableIn(
            $this->throttleKey($request)
        );
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return $request->input($request->ip());
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts() : int
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes() : int
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }
}
