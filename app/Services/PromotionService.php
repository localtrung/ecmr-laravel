<?php

namespace App\Services;

use App\Services\Interfaces\PromotionServiceInterface;
use App\Repositories\Interfaces\PromotionRepositoryInterface as PromotionRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class PromotionService
 * @package App\Services
 */
class PromotionService extends BaseService implements PromotionServiceInterface
{
    protected $promotionRepository;
    

    public function __construct(
        PromotionRepository $promotionRepository
    ){
        $this->promotionRepository = $promotionRepository;
    }

    

    public function paginate($request){
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $promotions = $this->promotionRepository->Pagination(
            $this->paginateSelect(), 
            $condition, 
            $perPage,
            ['path' => 'Promotion/index'], 
        );
        
        // dd($promotions);

        
        return $promotions;
    }

    public function create($request, $languageId){
        DB::beginTransaction();
        try{

            $payload = $request->only(['name', 'keyword','short_code', 'description','model','album']);
            $payload['model_id'] = $request->input('modelItem.id');
            $payload['description'] = [
                $languageId => $payload['description']
            ];
            $promotion = $this->promotionRepository->create($payload);
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
            $payload = $request->only(['name', 'keyword','short_code', 'description','model','album']);
            $payload['model_id'] = $request->input('modelItem.id');

            $payload['description'] = [
                $languageId => $payload['description']
            ];
            $promotion = $this->promotionRepository->update($id, $payload);
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
            $promotion = $this->promotionRepository->delete($id);

            DB::commit();
            return true;
        }catch(\Exception $e ){
            DB::rollBack();
            // Log::error($e->getMessage());
            echo $e->getMessage();die();
            return false;
        }
    }
  
    
    private function paginateSelect(){
        return [
            'id', 
            'name', 
        ];
    }


}
