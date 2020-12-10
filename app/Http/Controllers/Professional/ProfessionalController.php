<?php

namespace App\Http\Controllers\Professional;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function showProfessionForm(Request $request)
    {
        if (isset($_GET['redirect'])) {
            $request->session()->flash('redirect', $_GET['redirect']);
        }
        return view(getTemplate() . '.professional.signup');
    }
}
