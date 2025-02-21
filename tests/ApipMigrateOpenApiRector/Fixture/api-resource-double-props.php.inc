<?php

namespace App\Tests\ApipMigrateOpenApiRector\Fixture;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;

#[ApiResource(
    operations: [
        new Post(
            openapiContext: ['summary' => 'Publish a version', 'parameters' => [['name' => 'id', 'type' => 'string', 'in' => 'path', 'required' => true, 'description' => 'The id of the version']]],
            openapi: new Operation(operationId: 'publishVersion'),
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
        new Post(openapi: new Operation(
            summary: 'Publish a version',
            parameters: [['name' => 'id', 'type' => 'string', 'in' => 'path', 'required' => true, 'description' => 'The id of the version']],
            operationId: 'publishVersion',
        )),
    ],
)]
class Draft
{
}
