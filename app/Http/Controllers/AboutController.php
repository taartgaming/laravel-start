<?php

namespace App\Http\Controllers;

class AboutController
{
    public function index()
    {
        $company = 'Hogeschool Rotterdam';
        return view('about-us', [
            'company' => $company
        ]);
    }

}
