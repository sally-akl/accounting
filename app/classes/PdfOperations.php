<?php
namespace App\classes;
use PDF;

class PdfOperations
{
   private $view_name;
   private $view_content;
   private $pdf_op;
   private $download_file_name;
   private $allow_operations = ["download","viewpdf"];

   public function __construct($vm , $vc , $po,$df)
   {
      $this->view_name = $vm;
      $this->view_content = $vc;
      $this->pdf_op = $po;
      $this->download_file_name = $df;
   }

   public function generate()
   {
        if(in_array($this->pdf_op , $this->allow_operations))
         return   call_user_func_array(array($this, $this->pdf_op),array());
   }

   private function download()
   {
       $pdf = PDF::loadView($this->view_name,$this->view_content);
       return $pdf->download($this->download_file_name);
   }

   private function viewpdf()
   {

        $view = View($this->view_name,$this->view_content);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        return $pdf->stream();
   }


}


 ?>
