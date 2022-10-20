<?php
include(app_path().'\FPDF\fpdf.php');
include(app_path().'\FPDF\exfpdf.php');
include(app_path().'\FPDF\easyTable.php');
include(app_path().'\phpqrcode\qrlib.php');

// On Off Border
$border = 0;
// Path Gambar Logo
$path = public_path() . '/img/logopoputih.png';
//PDF
$pdf = new exFPDF('P', 'mm', array(330,210));
// Set Judul
$pdf->SetTitle('Laporan Perbaikan Barang - '.$user->id."/".date('Y')." - ".$user->nama_lengkap." - ".strtotime(now()));
//  Tambah Halaman
$pdf->AddPage();
// Font
$pdf->SetFont('Arial','B',12);
$pdf->image($path,15,12,16);
$pdf->Cell(0,2,'',$border,1);
$pdf->Cell(0,6,'PEMERINTAH KABUPATEN PONOROGO',$border,1,'C');
$pdf->Cell(0,5,'DINAS PENDIDIKAN',$border,1,'C');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,6,'SMP NEGERI 4 PONOROGO',$border,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0,4,'JL. Jenderal Sudirman No. 92 Telp. (0352) 481429',$border,1,'C');
$pdf->Cell(0,4,'web: www.smpn4ponorogo.sch.id e-mail: smp4prg@gmail.com',$border,1,'C');
$pdf->SetFont('Arial','B',11);
$pdf->Cell(0,6,'P O N O R O G O',$border,1,'C');
$pdf->Cell(0,6,'Kode Pos 63416               ',$border,1,'R');
// Header

$pdf->Cell(0,3,'',$border,1,'C');
$pdf->SetFont('Arial','BU',15);
$pdf->Cell(0,6,'LAPORAN DATA PERBAIKAN BARANG',$border,1,'C');
$pdf->SetFont('Arial','',11);
if ($user->role_check(['Kepala Laboratorium'])) {
    $pdf->Cell(0,6,$user->ruang_kalab,$border,1,'C');
}
$no = 1;
$pdf->Cell(0,5,'',0,1,'C');

// ================================================ Header

$pdf->SetFont('Arial','',10);

$pdf->Cell(25,5,'Nomor',$border,0,'L');
$pdf->Cell(20,5,'',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,'094 / '.$user->id.' / 104.2 / '.date('Y'),$border,1,'L');
$pdf->Cell(25,5,'Tanggal',$border,0,'L');
$pdf->Cell(20,5,'',$border,0,'L');
$pdf->Cell(5,5,':',$border,0,'L');
$pdf->Cell(60,5,date('d-m-Y',strtotime(now())),$border,1,'L');
$pdf->Cell(25,5,'',$border,1,'L');

// ================================================ Pake EasyTable untuk Table nya

//PAKE EASYTABLE
//JIKA USER ADMIN

if ($user->role_check(['Admin'])){
$no = 1;
$tabelbarang=new easyTable($pdf, '{10, 30, 52, 26, 36, 36, 36, 10}', 'width:220; font-size:10; border:1; paddingY:2;');

 $tabelbarang->rowStyle('align:{CCCCCCC}; font-style:B');
 $tabelbarang->easyCell("NO");
 $tabelbarang->easyCell("KODE BARANG");
 $tabelbarang->easyCell("NAMA BARANG");
 $tabelbarang->easyCell("JUMLAH");
 $tabelbarang->easyCell("RUANGAN");
 $tabelbarang->easyCell("JENIS KERUSAKAN");
 $tabelbarang->easyCell("KETERANGAN");
 $tabelbarang->printRow();
 $total = 0;

 foreach($perbaikan as $data_perbaikan) {
    QRCode::png($data_perbaikan->kode_barang,"kodebarangperbaikanadmin.png");
    $tabelbarang->rowStyle(';');
    $tabelbarang->easyCell($no++, 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell('','img:kodebarangperbaikanadmin.png');
    $tabelbarang->easyCell($data_perbaikan->nama_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_perbaikan->qty_barang, 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell($data_perbaikan->ruangan_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_perbaikan->jenis_kerusakan, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_perbaikan->keterangan_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->printRow();
 }
 $tabelbarang->endTable(5);
 }

 //JIKA USER KEPALA LABORATORIUM
 if ($user->role_check(['Kepala Laboratorium'])){
    $no = 1;
    $tabelbarang=new easyTable($pdf, '{10, 30, 52, 26, 36, 36, 36, 10}', 'width:220; font-size:10; border:1; paddingY:2;');
    
     $tabelbarang->rowStyle('align:{CCCCCCC}; font-style:B');
     $tabelbarang->easyCell("NO");
     $tabelbarang->easyCell("KODE BARANG");
     $tabelbarang->easyCell("NAMA BARANG");
     $tabelbarang->easyCell("JUMLAH");
     $tabelbarang->easyCell("RUANGAN");
     $tabelbarang->easyCell("JENIS KERUSAKAN");
     $tabelbarang->easyCell("KETERANGAN");
     $tabelbarang->printRow();
     $total = 0;
    
     foreach($perbaikanlab as $data_perbaikan) {
        QRCode::png($data_perbaikan->kode_barang,"kodebarangperbaikankalab.png");
        $tabelbarang->rowStyle(';');
        $tabelbarang->easyCell($no++, 'font-size:10; align:C; valign:T');
        $tabelbarang->easyCell('','img:kodebarangperbaikankalab.png');
        $tabelbarang->easyCell($data_perbaikan->nama_barang, 'font-size:10; align:L; valign:T');
        $tabelbarang->easyCell($data_perbaikan->qty_barang, 'font-size:10; align:C; valign:T');
        $tabelbarang->easyCell($data_perbaikan->ruangan_barang, 'font-size:10; align:L; valign:T');
        $tabelbarang->easyCell($data_perbaikan->jenis_kerusakan, 'font-size:10; align:L; valign:T');
        $tabelbarang->easyCell($data_perbaikan->keterangan_barang, 'font-size:10; align:L; valign:T');
        $tabelbarang->printRow();
     }
     $tabelbarang->endTable(5);
 }
 //TABEL UNTUK TANDA TANGAN

 //TANDA TANGAN ATAS
 $tabelttdatas = new easyTable($pdf, '{110, 73, 8}', 'width:300; font-size:10; paddingY:0; paddingX:0;');

 $tabelttdatas->rowStyle('align:{LLLL}; border:0');
 $tabelttdatas->easyCell("");
 $tabelttdatas->easyCell("Ponorogo, ".date('d-m-Y',strtotime(now())));
 $tabelttdatas->printRow();

 $tabelttdatas->endTable(5);

 //TANDA TANGAN BAWAH
 $tabelttdbawah = new easyTable($pdf, '{110, 73, 8}', 'width:300; font-size:10; paddingY:0; paddingX:0;');
 
 $tabelttdbawah->rowStyle('align:{LLLL}; border:0');
 $tabelttdbawah->easyCell("Kepala SMPN 4 Ponorogo");
 if ($user->role_check(['Admin'])){
    $tabelttdbawah->easyCell($user->role."\n");
 }
 if ($user->role_check(['Kepala Laboratorium'])){
    $tabelttdbawah->easyCell($user->role."\n".$user->ruang_kalab);
 }
 $tabelttdbawah->printRow();

 $tabelttdbawah->rowStyle('min-height:16');
 $tabelttdbawah->easyCell("");
 $tabelttdbawah->easyCell("");
 $tabelttdbawah->printRow();

 $tabelttdbawah->rowStyle('font-style:BU; border:0');
 $tabelttdbawah->easyCell("Basuki, S.Pd., M.Pd. ");
 $tabelttdbawah->easyCell($user->nama_lengkap);
 $tabelttdbawah->printRow();

 $tabelttdbawah->rowStyle('border:0');
 $tabelttdbawah->easyCell("NIP. 19620605 198211 1 002");
 $tabelttdbawah->easyCell("NIP. ".substr($user->nis_nip,0,8)." ".substr($user->nis_nip,8,6)." ".substr($user->nis_nip,14,1)." ".substr($user->nis_nip,16,3));
 $tabelttdbawah->printRow();

 $pdf->Output('I','Laporan Perbaikan Barang - '.$user->id."/".date(now())." - ".$user->nama_lengkap." - ".strtotime(now()));
exit;
?>