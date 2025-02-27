<?php

namespace App\Tests\ApipMigrateOpenApiRector\Fixture;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;

#[ApiResource(
    operations: [
        new Post(
            openapi: new Operation(operationId: 'publishVersion'),
            output: null,
        ),
    ],
)]
class Draft
{
}
-----
<?php

namespace App\Tests\ApipMigrateOpenApiRector\Fixture;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;

#[ApiResource(
    operations: [
        new Post(
            openapi: new Operation(operationId: 'publishVersion'),
            output: null,
        ),
    ],
)]
class Draft
{
}
