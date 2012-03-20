<?php 
/* $Id% */

App::import('Vendor', 'fpdi/fpdfx');

if (!defined('PARAGRAPH_STRING')) define('PARAGRAPH_STRING', '~~~');

class PdfHelper extends AppHelper
{
   public $pdf;

   /**
    * Allows you to change the defaults set in the FPDF constructor
    *
    * @param string $orientation page orientation values: P, Portrait, L, or Landscape    (default is P)
    * @param string $unit values: pt (point 1/72 of an inch), mm, cm, in. Default is mm
    * @param string $format values: A3, A4, A5, Letter, Legal or a two element array with the width and height in unit given in $unit
    */
   public function __construct()
   {
      $this->pdf = new fpdfx();
   }

   /**
    * Allows you to control how the pdf is returned to the user, most of the 
    * time in CakePHP you probably want the string
    *
    * @param string $name name of the file.
    * @param string $destination where to send the document values: I, D, F, S
    * @return string if the $destination is S
    */
   public function pdfOutput ($name = 'page.pdf', $destination = 's') 
   {
      // I: send the file inline to the browser. The plug-in is used if available.
      //    The name given by name is used when one selects the "Save as" option on the link generating the PDF.
      // D: send to the browser and force a file download with the name given by name.
      // F: save to a local file with the name given by name.
      // S: return the document as a string. name is ignored.
      return $this->pdf->Output($name, $destination);
   }

   public function __set($name, $value)
   {
      $this->pdf->{$name} = $value;
   }

   public function __get($name)
   {
      if (isset($this->pdf->{$name}))
      {
         return $this->pdf->{$name};
      }
   }

   public function __call($method, $args)
   {
      if (method_exists($this->pdf, $method))
      {
         return call_user_func_array(array($this->pdf, $method), $args);
      }
   }
}
?>
