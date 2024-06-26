<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\SystemRepositoryInterface as SystemRepository;

use App\Models\Language;
use App\Models\System;

class FrontendController extends Controller
{

    protected $language;
    protected $system;

    protected $systemRepository;
    public function __construct()
    {
        $this->setLanguage();
        $this->setSystem();
    }

    public function setLanguage()
    {
        $locale = app()->getLocale(); // vn en cn
        $language = Language::where('canonical', $locale)->first();
        $this->language = $language->id;
    }

    public function setSystem(){
        $this->system = convert_array(System::where('language_id', $this->language)->get(), 'keyword', 'content');
    }

}
