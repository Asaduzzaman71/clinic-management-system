<?php
namespace App\Services;
use App\Models\Accountant;
use Illuminate\Support\Facades\Storage;
class AccountantService{

    public function accountantList(){
        return Accountant::paginate(2);
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
        $accountant->forceDelete();
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

    // function action(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //   $output = '';
    //   $query = $request->get('query');
    //   if($query != '')
    //   {
    //    $data = Accountant::where('name', 'like', '%'.$query.'%')
    //      ->orderBy('id', 'desc')
    //      ->get();
         
    //   }
    //   else
    //   {
    //    $data = Accountant::orderBy('CustomerID', 'desc')->get();
    //   }
    //   $total_row = $data->count();
    //   if($total_row > 0)
    //   {
    //    foreach($data as $row)
    //    {
    //         $output .= '
    //                 <tr>
    //                 <td>'.$row->name.'</td>
    //                 <td>'.$row->email.'</td>
    //                 <td>'.$row->mobile.'</td>
    //                 <td>'.$row->PostalCode.'</td>
    //                 <td>'.$row->Country.'</td>
    //                 </tr>
    //                 ';
    //     }
    //   }
    //   else
    //   {
    //    $output = '
    //    <tr>
    //     <td align="center" colspan="5">No Data Found</td>
    //    </tr>
    //    ';
    //   }
    //   $data = array(
    //    'table_data'  => $output,
    //    'total_data'  => $total_row
    //   );

    //   echo json_encode($data);
    //  }
    // }
}