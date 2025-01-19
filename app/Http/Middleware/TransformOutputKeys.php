<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransformOutputKeys
{

    /**
     * Transform the keys of an array to snake_case.
     *
     * @param  array  $data
     * @return array
     */
    protected function transformKeysToSnakeCase(array $data): array
    {
        $snakeCaseData = [];
        foreach ($data as $key => $value) {
            $snakeCaseKey = Str::snake($key);
            $snakeCaseData[$snakeCaseKey] = is_array($value) ? $this->transformKeysToSnakeCase($value) : $value;
        }
        return $snakeCaseData;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the response
        $response = $next($request);
        // Check if the response is JSON
        if ($response->headers->get('Content-Type') === 'application/json') {
            // Decode JSON content
            $data = json_decode($response->getContent(), true);
            // Check if the data contains 'props' key and is an array
            echo isset($data['props']);
            if (is_array($data) && isset($data['props']) && is_array($data['props'])) {
                // Transform the keys of 'props' to snake_case
                $data['props'] = $this->transformKeysToSnakeCase($data['props']);
                // Set the transformed data back to the response
                $response->setContent(json_encode($data));
            }
        }
        return $response;
    }
}
