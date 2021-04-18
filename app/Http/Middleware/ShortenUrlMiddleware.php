<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Click;
use Illuminate\Http\RedirectResponse;

class ShortenUrlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //echo "test middleware";

        if ($request -> is('shorten/*')){

            $url = $request->url();
            $url_origin = JobPosting::where('shorten_url', $url)->value('url');

            $clickObject = new Click();
            $clickObject->instance_id = JobPosting::where('shorten_url', $url)->value('id');
            $clickObject->save();

            $protocol = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
            redirect($protocol.'://'. $url_origin, 301)->send();
        }

        return $next($request);
    }
}
