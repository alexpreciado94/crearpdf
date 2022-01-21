<?php
class CrearPDF{
  function __construct(){
    include_once 'fpdf.php';
    $this->pdf = new FPDF();
    include_once 'operacionesdb.php';
    $this->conexion = new OperacionesDB();

    $this->pdf();
  }
  function pdf(){
    $this->pdf->AddPage();
    $this->pdf->SetFont('Courier','B',16);
    $this->pdf->Write(1,utf8_decode('¡¡¡PRODUCTOS!!!'));

    $sql = 'select * from tablapdf';
    $resultado = $this->conexion->consultar($sql);

    while($fila = $this->conexion->extraerFila($resultado)){
      $this->pdf->Cell(20, 10, $fila['idFila'], 1, 0, 'C', 0);
      $this->pdf->Cell(50, 10, $fila['nombre'], 1, 0, 'C', 0);
      $this->pdf->Cell(100, 10, $fila['descripcion'], 1, 0, 'C', 0);
    }
    $this->pdf->Output();
  }
}
new CrearPDF();
?>
