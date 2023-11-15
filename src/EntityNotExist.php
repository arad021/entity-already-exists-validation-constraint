<?php

declare(strict_types=1);

namespace Happyr\Validator\Constraint;

use Attribute;
use Symfony\Component\Validator\Constraint;

/**
 * @author Arad Ahmad <arad04@gmx.de>
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
final class EntityNotExist extends Constraint
{
    public function __construct(
        public string $entity,
        public string $property = 'id',
        public string $message = 'Entity "%entity%" with property "%property%": "%value%" does exist.',
        $options = null,
        array $groups = null,
        $payload = null
    ) {
        parent::__construct($options, $groups, $payload);
    }
}
