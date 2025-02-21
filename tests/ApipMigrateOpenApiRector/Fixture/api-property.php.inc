<?php

namespace AppBundle\Api\Dto\AuditLog;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Serializer\Attribute\Groups;

#[Groups('auditLog/read')]
class Organization
{
    public function __construct(
        public string $organizationName,
        #[ApiProperty(openapiContext: [
            'type' => 'object',
            'properties' => [
                'allowed' => ['type' => 'boolean'],
                'providers' => ['type' => 'object', 'additionalProperties' => ['type' => 'boolean']],
            ],
        ])]
        public ?array $oAuthRestriction = null,
    ) {
    }
}
-----
<?php

namespace AppBundle\Api\Dto\AuditLog;

use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Serializer\Attribute\Groups;

#[Groups('auditLog/read')]
class Organization
{
    public function __construct(
        public string $organizationName,
        #[ApiProperty(openapi: new Operation(
            type: 'object',
            properties: [
                'allowed' => ['type' => 'boolean'],
                'providers' => ['type' => 'object', 'additionalProperties' => ['type' => 'boolean']],
            ],
        ))]
        public ?array $oAuthRestriction = null,
    ) {
    }
}
