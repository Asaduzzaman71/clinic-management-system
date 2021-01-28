<?php

namespace App\Http\Controllers;

use App\Models\DiagnosisReport;
use Illuminate\Http\Request;
use App\Services\DiagnosisReportService;
use App\Services\DocumentTypeService;
use App\Services\PrescriptionService;
use App\Services\TestService;
use App\Traits\FileUpload;
use App\Http\Requests\DiagnosisReportRequest;
use Illuminate\Support\Facades\Session;
use File;
use Response;
use Illuminate\Support\Facades\Storage;

class DiagnosisReportController extends Controller
{
    use FileUpload;
    protected $documentTypeService;
    protected $diagnosisReportService;
    protected $testService;
    protected $prescriptionService;
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->documentTypeService = new DocumentTypeService();
        $this->diagnosisReportService = new DiagnosisReportService();
        $this->testService = new TestService();
        $this->prescriptionService = new PrescriptionService();
        
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createReport($prescriptionId)
    {
        $documentTypes = $this->documentTypeService->getDropdownList();
        $tests = $this->testService->getDropdownList();
        return view('diagnosis_report.create',compact('documentTypes','tests','prescriptionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiagnosisReportRequest $request)
    {
        $validatedData = $request->validated();
        $prescriptionId=$request->prescription_id;
        $validatedData['prescription_id']=$prescriptionId;
        if ($request->hasFile('document')) {
            $validatedData['document'] = $this->ImageUpload($request, 'document', 'DiagnosisReport/', 'DiagnosisReport_');
        }
        $this->diagnosisReportService->createOrUpdate($validatedData);
        $diagnosisReports=$this->diagnosisReportService->getDiagnosisReportByPrescriptionId($prescriptionId);
        Session::flash('message','Information stored successfully!!!!');
        return view('diagnosis_report.index',compact('diagnosisReports','prescriptionId'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DiagnosisReport  $diagnosisReport
     * @return \Illuminate\Http\Response
     */
    public function show($prescriptionId)
    {
        $diagnosisReports=$this->diagnosisReportService->getDiagnosisReportByPrescriptionId($prescriptionId);
        return view('diagnosis_report.index',compact('diagnosisReports','prescriptionId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DiagnosisReport  $diagnosisReport
     * @return \Illuminate\Http\Response
     */
    public function edit(DiagnosisReport $diagnosisReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DiagnosisReport  $diagnosisReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DiagnosisReport $diagnosisReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DiagnosisReport  $diagnosisReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($diagnosisReportId)
    {
        $diagnosisReport = $this->diagnosisReportService->getById($diagnosisReportId);
        $prescriptionId=$diagnosisReport->prescription_id;
        $diagnosisReport = $this->diagnosisReportService->delete($diagnosisReportId);
       
        if ($diagnosisReport) {
                 Session::flash('message','Information deleted successfully!!!!');
            }
            return redirect()->route('diagnosisReports.show',$prescriptionId);
    }
    

    public function download($diagnosisReportId)
    {
        $diagnosisReport=$this->diagnosisReportService->getById($diagnosisReportId);
       
        $filePath = public_path($diagnosisReport->document);
        return response()->download($filePath);
    }
}
