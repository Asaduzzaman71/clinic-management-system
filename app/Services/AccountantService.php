<?php
namespace App\Services;
use App\Models\Accountant;
use Illuminate\Support\Facades\Storage;
class AccountantService{

    public function accountantList(){
        return Accountant::latest()->get();
    }
    public function createOrUpdate($data)
    {
          $user_id = auth()->user()->id;//authenticated user Id to set the value of created by field
          $data['password']=bcrypt($data['password']);

          //accountant data will be updated if we get accountant id from the form request
          if(!empty($data["id"])){
            //exceptional part for updating data
                $accountant = Accountant::whereId($data["id"])->first();
                $accountant->updated_by = $user_id;
                //delete existing image 
                if (isset($data['image'])){
                    if (file_exists($accountant->image)) 
                    { 
                        $oldFile=$accountant->image;
                        Storage::delete($oldFile);
                    }
                    
                }
          }
          else{
                //create
                $accountant = new accountant();
                $accountant->created_by = $user_id;
              }

          return $accountant->fill($data)->save() ? $accountant : null;
      }

    public function getById($id)
    {
        return Accountant::find($id);
    }
    public function delete($id)
    {
        $accountant = Accountant::findOrFail($id);
        if ($accountant) {
            if (file_exists($accountant->image)) 
                    { 
                        Storage::delete($accountant->image);
                    }
        }
        $accountant->delete();
        return $accountant;

    }

    public function getDropdownList()
    {
        return Accountant::pluck('name', 'id');
    }

    public function userIdUpdate($id,$userId)
    {

       return  Accountant::where('id',$id)->update(['user_id'=>$userId]);
    }
}