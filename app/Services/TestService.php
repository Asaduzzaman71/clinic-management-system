<?php
namespace App\Services;
use App\Models\Test;
use Illuminate\Support\Facades\Storage;
class TestService{


    public function TestList(){
        return Test::paginate(10);
    }
    public function createOrUpdate($data)
    {
        //dd($data);
          $user_id = auth()->user()->id;
          $data['name']=strtoupper( $data['name']);
          if(!empty($data["id"])){
            //exceptional part for updating data
                $test = Test::whereId($data["id"])->first();
                $test->updated_by = $user_id;
          }
          else{
                //create
                $test = new Test();
                $test->created_by = $user_id;
              }

          return $test->fill($data)->save() ? $test : null;
      }

    public function getById($id)
    {
        return Test::find($id);
    }
    public function delete($id)
    {
        $test = Test::findOrFail($id);
        $test->delete();
        return $test;

    }

    public function getDropdownList()
    {
        return Test::pluck('name', 'id');
    }
    

}