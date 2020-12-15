<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    /**
     * @param $locale
     *
     * @return RedirectResponse
     */
    public function __invoke($locale)
    {
//        dd($locale);
        if (array_key_exists($locale, config('locale.languages'))) {
            session()->put('locale', $locale);
//                    dd($locale);
        }

        return redirect()->back();
    }

}
