# Symfony validator for entity not exist

A small validator that verifies that an entity actually does not exist.

## Install

```console
composer require arad021/entity-already-exists-validation-constraint

```

Then register the services with:

```yaml
# config/packages/arad021_entity_already_exists_validator.yaml
services:
  Arad021\Validator\Constraint\EntityNotExistValidator:
    arguments: ['@doctrine.orm.entity_manager']
    tags: [ 'validator.constraint_validator' ]
```

## Note

The validator will not produce a violation when value is empty. This means that you should most likely use it in
combination with `NotBlank`. 
