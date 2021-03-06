<?php

    namespace Spatie\ResponseCache\CacheProfiles;

    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class CacheAllSuccessfulGetRequests extends BaseCacheProfile
    {
        public function shouldCacheRequest(Request $request)
        {
            if ($request->ajax()) {
                return false;
            }

            if ($this->isRunningInConsole()) {
                return false;
            }

            return $request->isMethod('get');
        }

        public function shouldCacheResponse(Response $response)
        {
            return $response->isSuccessful() || $response->isRedirection();
        }
    }
