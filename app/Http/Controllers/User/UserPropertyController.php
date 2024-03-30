<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;


class UserPropertyController extends Controller
{
    public function index()
    {
        // Get all properties
        $properties = Property::all();

        return view('user.property.index', ['properties' => $properties]);
    }
}