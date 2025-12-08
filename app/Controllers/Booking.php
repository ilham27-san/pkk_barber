<?php namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\BookingModel;

class Booking extends BaseController
{
    protected $layananModel;
    protected $bookingModel;

    public function __construct()
    {
        $this->layananModel = new LayananModel();
        $this->bookingModel = new BookingModel();
        helper(['form', 'url', 'session']);
    }

    public function step1()
    {
        $data['layanan'] = $this->layananModel->findAll();
        return view('booking/step1', $data);
    }

    public function step1Submit()
    {
        session()->set('booking_step1', $this->request->getPost());
        return redirect()->to('/booking/step2');
    }

    public function step2()
    {
        return view('booking/step2');
    }

    public function step2Submit()
    {
        session()->set('booking_step2', $this->request->getPost());
        return redirect()->to('/booking/step3');
    }

    public function step3()
    {
        return view('booking/step3');
    }

    public function step3Submit()
    {
        session()->set('booking_step3', $this->request->getPost());
        return redirect()->to('/booking/step4');
    }

    public function step4()
    {
        $data['booking'] = array_merge(
            session()->get('booking_step1') ?? [],
            session()->get('booking_step2') ?? [],
            session()->get('booking_step3') ?? []
        );
        return view('booking/step4', $data);
    }

    public function submit()
    {
        $bookingData = array_merge(
            session()->get('booking_step1') ?? [],
            session()->get('booking_step2') ?? [],
            session()->get('booking_step3') ?? []
        );

        $this->bookingModel->insert($bookingData);

        session()->remove(['booking_step1','booking_step2','booking_step3']);
        return redirect()->to('/booking')->with('success', 'Booking berhasil!');
    }
}
