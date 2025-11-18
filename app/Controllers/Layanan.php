<?php namespace App\Controllers;

class Layanan extends BaseController
{
    public function pricelist() { return view('layanan/pricelist'); }
    public function capster()   { return view('layanan/capster'); }
}
