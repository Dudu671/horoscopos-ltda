<?php

namespace App\Http\Controllers;

use App\Models\Horoscope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as Validator;

class HoroscopeController extends Controller {
    public function index() {
        $horoscopes = DB::table('horoscopes')
        ->join('users', 'horoscopes.author_id', '=', 'users.id')
        ->select('horoscopes.*', 'users.name AS author')
        ->get();

        return view('horoscopes', ['horoscopes' => $horoscopes]);
    }

    public function newForm() {
        return view('horoscopes-form');
    }

    public function new(Request $request) {
        $fileName = null;

        if (!$request->hasFile('image') || !$request->file('image')->isValid())
            return redirect()->back();

        $name = uniqid(date('HisYmd'));
        $extension = $request->image->extension();
        $fileName = "{$name}.{$extension}";

        $fileValidation = Validator::make($request->all(), [
            'image' => 'mimes:png,jpeg,jpg,gif'
        ]);

        if ($fileValidation->fails())
            return redirect()->back()->withErrors('Formato de arquivo não permitido.');

        $request->image->storeAs('public', $fileName);

        $author_id = Auth::id();

        $horoscope = new Horoscope([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author_id' => $author_id,
            'image_path' => $fileName
        ]);

        $horoscope->save();

        return redirect()->route('horoscopes.index');
    }
}
