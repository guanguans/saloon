<?php

declare(strict_types=1);

namespace Saloon\Http;

use Saloon\Enums\Method;
use Saloon\Traits\Bootable;
use Saloon\Traits\Makeable;
use Saloon\Traits\HasDebugging;
use Saloon\Traits\Conditionable;
use Saloon\Traits\HasMockClient;
use Saloon\Traits\HandlesPsrRequest;
use Saloon\Traits\ManagesExceptions;
use Saloon\Traits\Auth\AuthenticatesRequests;
use Saloon\Traits\RequestProperties\Retryable;
use Saloon\Traits\Responses\HasCustomResponses;
use Saloon\Contracts\Request as RequestContract;
use Saloon\Traits\Request\CreatesDtoFromResponse;
use Saloon\Traits\RequestProperties\HasRequestProperties;

abstract class Request implements RequestContract
{
    use CreatesDtoFromResponse;
    use AuthenticatesRequests;
    use HasRequestProperties;
    use HasCustomResponses;
    use ManagesExceptions;
    use HandlesPsrRequest;
    use HasMockClient;
    use Conditionable;
    use HasDebugging;
    use Retryable;
    use Bootable;
    use Makeable;

    /**
     * Define the HTTP method.
     */
    protected Method $method;

    /**
     * Get the method of the request.
     */
    public function getMethod(): Method
    {
        return $this->method;
    }
}
