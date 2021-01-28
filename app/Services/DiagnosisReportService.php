<?php
namespace App\Services;
use App\Models\DiagnosisReport;
use Illuminate\Support\Facades\Storage;
class DiagnosisReportService{


   public function  getDiagnosisReportByPrescriptionId($prescriptionId){

        return DiagnosisReport::where('prescription_id',$prescriptionId)->paginate(5);
    }

    public function createOrUpdate($data)
    {
        //dd($data);
          $user_id = auth()->user()->id;
          if(!empty($data["id"])){
            //exceptional part for updating data
            $diagnosisReport = DiagnosisReport::whereId($data["id"])->first();
            $diagnosisReport->updated_by = $user_id;
                //delete existing image 
                if (isset($data['document'])){
                    if (file_exists($diagnosisReport->image)) 
                    { 
                        $oldFile=$diagnosisReport->image;
                        Storage::delete($oldFile);
                    }
                    
                }
          }
          else{
                //create
                $diagnosisReport = new DiagnosisReport();
                $diagnosisReport->created_by = $user_id;
              }
         

          return $diagnosisReport->fill($data)->save() ? $diagnosisReport : null;
      }

   public function getById($id)
    {
        return DiagnosisReport::find($id);
    }
    public function delete($id)
    {
        $diagnosisReport =DiagnosisReport::findOrFail($id);
        if ($diagnosisReport) {
            if (file_exists($diagnosisReport->document)) 
                    { 
                        $filePath = public_path($diagnosisReport->document);
                        unlink($filePath);
                    }
        }
        $diagnosisReport->delete();
        return $diagnosisReport;

    }



}