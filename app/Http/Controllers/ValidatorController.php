<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ValidatorController extends Controller
{
    public function submitForm(Request $request) {
        $request->validate([
            'shortName' => ['required', 'max:5', 'alpha:ascii'],
            'longName' => ['required', 'min:10', 'alpha:ascii'],
            'anyString' => ['required', 'min:5', 'max:20', 'alpha_num:ascii'],
            'url' => ['required', 'url'],
            'spellcard' => ['required', 'max:50', 'regex:/^.*Sign.*/'],
            'phone' => ['required', 'digits:9', 'regex:/^[1-9][0-9]{8}/'],
            'age' => ['required', 'numeric', 'min:18'],
            'dateOfBirth' => ['required', 'date', 'before:01 Jan 2000'],
        ]);

        return response('Server-side validation passed.');
    }
}
