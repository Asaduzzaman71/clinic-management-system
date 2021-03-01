<?php
namespace App\Services;
use App\Models\Laboratorist;
use Illuminate\Support\Facades\Storage;
class LaboratoristService{

    public function laboratoristList(){
        return laboratorist::latest()->paginate(10);
    }
    public function createOrUpdate($data)
    {
          $user_id = auth()->user()->id;//authenticated user Id to set the value of created by field
          $data['password']=bcrypt($data['password']);

          //laboratorist data will be updated if we get laboratorist id from the form request
          if(!empty($data["id"])){
            //exceptional part for updating data
                $laboratorist = Laboratorist::whereId($data["id"])->first();
                $laboratorist->updated_by = $user_id;
                //delete existing image 
                if (isset($data['image'])){
                    if (file_exists($laboratorist->image)) 
                    { 
                        $oldFile=$laboratorist->image;
                        Storage::delete($oldFile);
                    }
                    
                }
          }
          else{
                //create
                $laboratorist = new Laboratorist();
                $laboratorist->created_by = $user_id;
              }

          return $laboratorist->fill($data)->save() ? $laboratorist : null;
      }

    public function getById($id)
    {
        return Laboratorist::find($id);
    }
    public function delete($id)
    {
        $laboratorist = Laboratorist::findOrFail($id);
        if ($laboratorist) {
            if (file_exists($laboratorist->image)) 
                    { 
                        Storage::delete($laboratorist->image);
                    }
        }
        $laboratorist->forceDelete();
        return $laboratorist;

    }

    public function getDropdownList()
    {
        return Laboratorist::pluck('name', 'id');
    }

    public function userIdUpdate($id,$userId)
    {
       return  Laboratorist::where('id',$id)->update(['user_id'=>$userId]);
    }

    // function action(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //   $output = '';
    //   $query = $request->get('query');
    //   if($query != '')
    //   {
    //    $data = laboratorist::where('name', 'like', '%'.$query.'%')
    //      ->orderBy('id', 'desc')
    //      ->get();
         
    //   }
    //   else
    //   {
    //    $data = laboratorist::orderBy('CustomerID', 'desc')->get();
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