<?php

namespace App\Http\Services;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

/**
 * Abstract Entity Service.
 *
 * @category Service
 *
 */
abstract class AbstractEntityService extends AbstractService implements EntityServiceInterface
{
    use ValidatesRequests;

    /**
     * Validates evaluation updating or creating.
     *
     * @param Request $request HTTP request
     * @param object  $entity  ORM object
     *
     * @throws ValidationException when an invalid option is provided
     */
    abstract protected function validateEntity(Request $request, $entity);
}
