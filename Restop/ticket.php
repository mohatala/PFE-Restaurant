<?php
require_once('DBConnection.php');
$base=new DBConnection();
$conn=$base->connect();
require('admin/fpdf/fpdf.php');
class PDF extends FPDF
{
  function ImprovedTable($header,$data)
{
  // Largeurs des colonnes
  $w = array(70, 30, 30, 30);
  // En-tête
  for($i=0;$i<count($header);$i++)
      $this->Cell($w[$i],7,$header[$i],1);
  $this->Ln();
  // Données
$c=0;
foreach($data as $row)
  {
  //echo $row[0];
          $this->Cell(70,6,$row[0],1);
    $this->Cell(30,6,$row[1],1);
    $this->Cell(30,6,$row[2],1);
    $this->Cell(30,6,$row[3],1);
    $this->Ln();
    $c+=intval($row[3]);
  }
$this->Ln(20);
$this->Cell(0,10,'Montant a Paye:'.$c,'',1,'R');
}
}

$header = array('Plat', 'Quantite', 'Prix Plat', 'Total');
$data=array();
$sql = "SELECT commande.*,plat.*,client.* FROM commande,plat,client WHERE commande.id_plat=plat.id_plat and commande.id_client=client.Id_client and commande.id_commande=".$_GET['id'];
$qry = $conn->query($sql);
foreach($qry as $k){
    $id_cmd=$k["id_commande"];
    $id_client=$k["id_client"];
    $quantite=$k["quantite"];
    $prix_plat=$k["prix_plat"];
    $prix=$k["prix"];
    $typecmd=$k["type_cmd"];
    $note=$k["Note"];
    $adresse=$k["adresse"];
    $intitule_plat=$k["intitule_plat"];
    $datecmd=$k["Date_commande"];
    $nom=$k["Nom_client"];
    $prenom=$k["Prenom_client"];
    $tel=$k["Tel"];
    array_push($data,array($intitule_plat,$quantite,$prix_plat,$prix));
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Ticket','TBLR',1,'C');
$pdf->Ln(20);
$pdf->SetFont('Arial','',14);
$pdf->Write(2,'Nom: '.$nom." ".$prenom);
$pdf->Ln(10);
$pdf->SetFont('Arial','',14);
$pdf->Write(2,'Tel: '.$tel);
$pdf->Ln(10);
$pdf->SetFont('Arial','',14);
$pdf->Write(2,'Adresse: '.$adresse);
$pdf->Ln(10);
$pdf->SetFont('Arial','',14);
$pdf->Write(2,'Type commande: '.$typecmd);
$pdf->Ln(20);
$pdf->ImprovedTable($header,$data);
$pdf->Output('D','Recu de Commande.pdf');

?>
