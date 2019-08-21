<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

/**
 * Entity Service interface.
 *
 * @category Service
 *
 */
interface EntityServiceInterface extends ServiceInterface
{
    /**
     * Create or update the specified object.
     *
     * @param Request    $request HTTP request
     * @param array      $data    additional data
     * @param object|int $object  ORM object
     */
    public function createOrUpdate(Request $request, $data = [], $object = null);
}
