<?php

namespace App\Http\Controllers;

use App\Address;
use App\Areas;
use App\Cities;
use App\Http\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use function Sodium\add;


class AddressController extends Controller
{
    protected $service = null;

    /**
     * Default constructor.
     * @param AddressService $service
     */
    public function __construct(AddressService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $addresses = Address::with(['area','city'])->orderBy('name')->get();

        $cities = Cities::select('id','name')->get();
        $citiesMap = [];
        foreach ($cities as $city) {
            $citiesMap[$city->id] = $city->name;
        }
        $areas = Areas::select('id','name')->get();
        $areasMap = [];
        foreach ($areas as $area) {
            $areasMap[$area->id] = $area->name;
        }
        return view('addresses.index', [
            'address' => new Address(),
            'citiesMap' => $citiesMap,
            'areasMap' => $areasMap,
            'addresses' =>$addresses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request HTTP request
     *
     * @return array
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = [
            'success'  => true,
            'messages' => __('Address was saved'),
        ];

        $this->service->createOrUpdate($request);

        return $data;
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        $address->delete();

        return response()
            ->json(['success' => true, 'messages' => 'Changes were saved']);
    }

}
