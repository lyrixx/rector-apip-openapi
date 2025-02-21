<?php

namespace App\Tests\ApipMigrateOpenApiRector\Fixture;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use AppBundle\Api\Public\Provider\DraftCollectionProvider;
use AppBundle\Api\Public\Provider\DraftItemProvider;

#[ApiResource(
    shortName: 'PublicDraft',
    operations: [
        new Get(
            provider: DraftItemProvider::class,
            security: "is_granted('RULE_SOURCE_VIEW', object)",
            openapiContext: [
                'description' => 'Use this endpoint to retrieve the details of a draft rule.',
                'operationId' => 'getDraft',
            ]
        ),
        new GetCollection(
            provider: DraftCollectionProvider::class,
            openapiContext: [
                'summary' => 'Retrieves the collection of Draft rules',
                'description' => <<<'EOFTXT'
                    This endpoint allows to retrieve the collection of draft rules of the project.
                    Draft rules represent changes that have been saved in the project but not yet published.
                    Each draft comes with a `status` property, which can be on of:
                     * `add`: this is a new rule that is going to be added when publishing the ruleset
                     * `update`: this is an already existing redirection rule that is going to be changed when publishing the ruleset
                     * `delete`: this is an existing redirection rule that is going to be removed when publishing the ruleset
                    EOFTXT,
                'operationId' => 'getDrafts',
                'parameters' => [
                    [
                        'name' => 'projectId',
                        'in' => 'query',
                        'description' => 'The id of the project.',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ]
        ),
    ],
    formats: ['json', 'jsonld'],
)]
class Draft
{
}
-----
<?php

namespace App\Tests\ApipMigrateOpenApiRector\Fixture;

use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use AppBundle\Api\Public\Provider\DraftCollectionProvider;
use AppBundle\Api\Public\Provider\DraftItemProvider;

#[ApiResource(
    shortName: 'PublicDraft',
    operations: [
        new Get(
            provider: DraftItemProvider::class,
            security: "is_granted('RULE_SOURCE_VIEW', object)",
            openapi: new Operation(
                description: 'Use this endpoint to retrieve the details of a draft rule.',
                operationId: 'getDraft',
            )
        ),
        new GetCollection(
            provider: DraftCollectionProvider::class,
            openapi: new Operation(
                summary: 'Retrieves the collection of Draft rules',
                description: <<<'EOFTXT'
                    This endpoint allows to retrieve the collection of draft rules of the project.
                    Draft rules represent changes that have been saved in the project but not yet published.
                    Each draft comes with a `status` property, which can be on of:
                     * `add`: this is a new rule that is going to be added when publishing the ruleset
                     * `update`: this is an already existing redirection rule that is going to be changed when publishing the ruleset
                     * `delete`: this is an existing redirection rule that is going to be removed when publishing the ruleset
                    EOFTXT,
                operationId: 'getDrafts',
                parameters: [
                    [
                        'name' => 'projectId',
                        'in' => 'query',
                        'description' => 'The id of the project.',
                        'required' => true,
                        'schema' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            )
        ),
    ],
    formats: ['json', 'jsonld'],
)]
class Draft
{
}
