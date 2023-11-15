<?php

declare(strict_types=1);

namespace Arad021\Validator\Constraint;

use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

use function sprintf;

/**
 * @author Arad Ahmad <arad04@gmx.de>
 */
final class EntityNotExistValidator extends ConstraintValidator
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityNotExist) {
            throw new LogicException(
                sprintf('You can only pass %s constraint to this validator.', EntityNotExist::class)
            );
        }

        if (null === $value || '' === $value) {
            return;
        }

        if ($constraint->entity === '') {
            throw new LogicException(sprintf('Must set "entity" on "%s" validator', EntityNotExist::class));
        }

        if ($constraint->property === '') {
            throw new LogicException(sprintf('Must set "property" on "%s" validator', EntityNotExist::class));
        }

        $data = $this->entityManager->getRepository($constraint->entity)->findOneBy([
            $constraint->property => $value,
        ]);

        if (null !== $data) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%entity%', $constraint->entity)
                ->setParameter('%property%', $constraint->property)
                ->setParameter('%value%', (string)$value)
                ->addViolation();
        }
    }
}
