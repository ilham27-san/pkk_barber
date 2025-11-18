<?php namespace App\Controllers;

class About extends BaseController
{
    public function history()  { return view('about/history'); }
    public function lokasi()   { return view('about/lokasi'); }
    public function review()   { return view('about/review'); }
}
