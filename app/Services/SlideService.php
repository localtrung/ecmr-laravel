<?php

namespace App\Services;

use App\Services\Interfaces\SlideServiceInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface as SlideRepository;
use Illuminate\Support\Facades\DB;

/**
 * Class SlideService
 * @package App\Services
 */
class SlideService extends BaseService implements SlideServiceInterface
{
    protected $slideRepository;
    

    public function __construct(
        SlideRepository $slideRepository,
    ){
        $this->slideRepository = $slideRepository;
    }

    

    public function paginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $slides = $this->slideRepository->pagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage, 
            ['path' => 'language/index'], 
        );
        return $slides;
    }

    public function create($request, $languageId){
        DB::beginTransaction();
        try{
            $payload = $request->only([
                '_token', 
                'name', 
                'keyword', 
                'setting', 
                'short_code',
            ]); 
            $payload['item'] = $this->handleSlideItem($request, $languageId);
            $slide = $this->slideRepository->create($payload);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }


    public function update($id, $request, $languageId){
        DB::beginTransaction();
        try{
            $slide = $this->slideRepository->findById($id);
            $slideItem = $slide->item;
            unset($slideItem[$languageId]);
            $payload = $request->only([
                '_token', 
                'name', 
                'keyword', 
                'setting', 
                'short_code',
            ]); 
            $payload['item'] = $this->handleSlideItem($request, $languageId) + $slideItem;
            $slide = $this->slideRepository->update($id, $payload);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
           $slide = $this->slideRepository->delete($id);
            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }


    public function converSlideArray(array $slide = []): array
    {
        $temp = [];
        $fields = ['image', 'description', 'window', 'canonical', 'name', 'alt'];
        foreach($slide as $key => $val)
        {
            foreach($fields as $field)
            {
                $temp[$field][] = $val[$field];
            }
        }
        return $temp;
    }

    private function handleSlideItem($request, $languageId){
        $slide = $request->input('slide');
        $temp = [];
        foreach($slide['image'] as $key => $val)
        {
            $temp[$languageId][] = [
                'image' => $val,
                'description' => $slide['description'][$key],
                'name' => $slide['name'][$key],
                'canonical' =>  $slide['canonical'][$key],
                'alt' =>  $slide['alt'][$key],
                'window' => (isset($slide['window'][$key])) ? $slide['window'][$key] : '' ,
                
            ];
        }
        return $temp;
    }

    private function paginateSelect(){
        return [
            'id',
            'name', 
            'keyword',
            'publish',
            'item'
        ];
    }


}
