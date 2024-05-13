<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SlideRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Slide;
/**
 * Class SlideService
 * @package App\Services
 */
class SlideRepository extends BaseRepository implements SlideRepositoryInterface
{
    protected $model;

    public function __construct(
        Slide $model
    ){
        $this->model = $model;
    }

}
