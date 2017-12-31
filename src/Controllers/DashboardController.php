<?php

namespace Charlestide\Paladin\Controllers;


class DashboardController extends Controller
{
    public function index() {

        return view('paladin::dashboard.index');
    }
}
