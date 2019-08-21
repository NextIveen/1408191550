<?php


namespace App\Http\Services;

use App\Address;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


/**
 * Address Service.
 *
 * @category Service
 *
 * @author   Ivan Korsun <ivannkorsun@gmail.com>
 */
class AddressService extends AbstractEntityService
{
    /**
     * Create or update the specified role.
     *
     * @param Request $request HTTP request
     * @param array $data additional data
     * @param Address|int $address address
     *
     * @return void
     * @throws ValidationException
     */
    public function createOrUpdate(Request $request, $data = [], $address = null)
    {
        if (!$address instanceof Address) {
            $address = $address !== null ? Address::find($address) : new Address();
        }
        // Validation Request
        $this->validateEntity($request, $address);

        $address->name = $request->input('name', $address->name);
        $address->city_id = $request->input('city_id', $address->city_id);
        $address->area_id = $request->input('area_id', $address->area_id);
        $address->street = $request->input('street', $address->street);
        $address->house = $request->input('house', $address->house);
        $address->info = $request->input('info', $address->info);
        $address->save();
    }

    /**
     * Validates evaluation updating or creating.
     *
     * @param Request $request HTTP request
     * @param Address $address address
     *
     * @throws ValidationException
     */
    protected function validateEntity(Request $request, $address)
    {
        $rules = [];

        // Address Name
        if ($request->input('name')) {
            $rules['name'] = 'required|max:255';
        }

        // Address City_ID
        if ($request->input('city_id')) {
            $rules['city_id'] = 'required|max:255';
        }

        // Address AREA_ID
        if ($request->input('area_id')) {
            $rules['area_id'] = 'required||max:255';
        }

        // Address Street
        if ($request->input('street')) {
            $rules['street'] = 'required|max:255';
        }

        // Address House
        if ($request->input('house')) {
            $rules['house'] = 'required|max:255';
        }

        // Address Info
        if ($request->input('info')) {
            $rules['info'] = 'required|max:255';
        }

        // Address Validation
        $this->validate($request, $rules);
    }
}
