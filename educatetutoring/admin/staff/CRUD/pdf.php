<?php
//http://localhost/educatetutoring/admin/staff/CRUD/pdf.php
// include autoloader
require_once '../../../vendor/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

class Pdf extends Dompdf{
 public function __construct() {
        parent::__construct();
    }
}

?>
