<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class TransformOutputKeys
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response instanceof JsonResponse) {
            $data = $response->getData(true);
            $data = $this->convertKeysToCamelCase($data);
            $response->setData($data);
        }
        return $response;
    }

    private function convertKeysToCamelCase($array)
    {
        $result = [];
        foreach ($array as $key => $value) {
            $camelKey = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
            if (is_array($value)) {
                $result[$camelKey] = $this->convertKeysToCamelCase($value);
            } else {
                $result[$camelKey] = $value;
            }
        }
        return $result;
    }
}
