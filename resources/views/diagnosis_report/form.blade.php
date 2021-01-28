<div class="row">
            
  <div class="col-lg-6">
    <div class="form-group">
      <div class="form-group">
        {!! Form::label('test_id', 'Select Test', ['class' => 'form-control-label']);!!}
        {!! Form::select('test_id', $tests ,  null , ['placeholder' => 'Select test',"class"=>"form-control"]) !!}
      </div>
       
        <span class="validation-error">{{ $errors->first("test_id") }}</span>
    </div>
</div>
<div class="col-lg-6">
    <div class="form-group">
      {!! Form::label('document_type_id', 'Document Type', ['class' => 'form-control-label']);!!}
      {!! Form::select('document_type_id', $documentTypes ,  null , ['placeholder' => 'Select Document Type',"class"=>"form-control"])  !!}
      <span class="validation-error">{{ $errors->first("document_type_id") }}</span>
    </div>
  </div><!-- col-12 -->

</div>


<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
          {!! Form::label('document', 'Document', ['class' => 'form-control-label']);!!}
          {!! Form::file("document", null, ["class"=>"form-control form-control-label"]) !!}
          <span class="validation-error">{{ $errors->first("document") }}</span>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="form-group">
          {!! Form::label('description', 'Description', ['class' => 'form-control-label']);!!}
          {!! Form::textarea('description', null, ['class' => 'ckeditor form-control']) !!}
          <span class="validation-error">{{ $errors->first("description") }}</span>
        </div>
      </div><!-- col-12 -->
      
      {!! Form::hidden('prescription_id',$prescriptionId) !!}


   
</div><!-- row -->

 
  
   

  
