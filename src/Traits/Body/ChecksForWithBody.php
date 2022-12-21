<?php

declare(strict_types=1);

namespace Saloon\Traits\Body;

use Saloon\Http\PendingRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Exceptions\BodyException;

trait ChecksForWithBody
{
    /**
     * Check if the request or connector has the WithBody class.
     *
     * @param \Saloon\Http\PendingRequest $pendingRequest
     * @return void
     * @throws \Saloon\Exceptions\BodyException
     */
    public function bootChecksForWithBody(PendingRequest $pendingRequest): void
    {
        if ($pendingRequest->getRequest() instanceof HasBody || $pendingRequest->getConnector() instanceof HasBody) {
            return;
        }

        throw new BodyException(sprintf('You have added a body trait, without adding the `%s` interface to your request or connector.', HasBody::class));
    }
}
