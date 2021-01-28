<?php
namespace App\Services;
use App\Models\DocumentType;

class DocumentTypeService{

    public function getDropdownList()
    {
        return DocumentType::pluck('document_type', 'id');
    }
    

}