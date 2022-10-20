<?php
function rupiah ($angka)
{
    $hasil_rupiah = "Rp " .number_format($angka,0,',','.');
    return $hasil_rupiah;
}

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
$pdf->SetTitle('Laporan Pengajuan Barang - '.$user->id."/".date('Y')." - ".$user->nama_lengkap." - ".strtotime(now()));
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
$pdf->Cell(0,6,'LAPORAN DATA PENGAJUAN BARANG',$border,1,'C');
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
$tabelbarang=new easyTable($pdf, '{10, 22, 22, 22, 22, 22, 22, 22, 22, 22, 22, 10}', 'width:220; font-size:10; border:1; paddingY:2;');

 $tabelbarang->rowStyle('align:{CCCCCCCCCC}; font-style:B');
 $tabelbarang->easyCell("NO");
 $tabelbarang->easyCell("KODE BARANG");
 $tabelbarang->easyCell("NAMA BARANG");
 $tabelbarang->easyCell("JUMLAH");
 $tabelbarang->easyCell("RUANGAN");
 $tabelbarang->easyCell("MEREK");
 $tabelbarang->easyCell("WARNA");
 $tabelbarang->easyCell("HARGA SATUAN");
 $tabelbarang->easyCell("HARGA TOTAL");
 $tabelbarang->easyCell("TGL PENGAJUAN");
 $tabelbarang->easyCell("KETERANGAN");
 $tabelbarang->printRow();
 $total = 0;

 foreach($pengajuan as $data_pengajuan) {
    $totalharga = $data_pengajuan->hargasatuan_barang * $data_pengajuan->qty_barang;
    $total = $totalharga + $total;
    QRCode::png($data_pengajuan->kode_barang,"kodebarangpengajuanadmin.png");
    $tabelbarang->rowStyle(';');
    $tabelbarang->easyCell($no++, 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell('','img:kodebarangpengajuanadmin.png');
    $tabelbarang->easyCell($data_pengajuan->nama_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->qty_barang, 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell($data_pengajuan->ruangan_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->merk_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->warna_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell(rupiah($data_pengajuan->hargasatuan_barang), 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell(rupiah($totalharga), 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->tgl_pengajuan, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->keterangan_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->printRow();
 }
    $tabelbarang->rowStyle('align:{CCCCC}; font-style:B;');
    $tabelbarang->easyCell('', 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell('T  O  T  A  L', 'font-size:10; align:C; valign:T; colspan:7');
    $tabelbarang->easyCell(rupiah($total),'font-size:10; align:C; valign:T; colspan:3');
    $tabelbarang->printRow();
 
 $tabelbarang->endTable(5);
 }

 //JIKA USER KEPALA LABORATORIUM
 if ($user->role_check(['Kepala Laboratorium'])){
    $no = 1;
$tabelbarang=new easyTable($pdf, '{10, 24, 24, 24, 24, 24, 24, 24, 24, 24, 10}', 'width:220; font-size:10; border:1; paddingY:2;');
 $tabelbarang->rowStyle('align:{CCCCCCCCCC}; font-style:B');
 $tabelbarang->easyCell("NO");
 $tabelbarang->easyCell("KODE BARANG");
 $tabelbarang->easyCell("NAMA BARANG");
 $tabelbarang->easyCell("JUMLAH");
 $tabelbarang->easyCell("MEREK");
 $tabelbarang->easyCell("WARNA");
 $tabelbarang->easyCell("HARGA SATUAN");
 $tabelbarang->easyCell("HARGA TOTAL");
 $tabelbarang->easyCell("TGL PENGAJUAN");
 $tabelbarang->easyCell("KETERANGAN");
 $tabelbarang->printRow();
 $total = 0;

 foreach($pengajuanlab as $data_pengajuan) {
    $totalharga = $data_pengajuan->hargasatuan_barang * $data_pengajuan->qty_barang;
    $total = $totalharga + $total;
    QRCode::png($data_pengajuan->kode_barang,"kodebarangpengajuankalab.png");
    $tabelbarang->rowStyle(';');
    $tabelbarang->easyCell($no++, 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell('','img:kodebarangpengajuanadmin.png');
    $tabelbarang->easyCell($data_pengajuan->nama_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->qty_barang, 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell($data_pengajuan->merk_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->warna_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell(rupiah($data_pengajuan->hargasatuan_barang), 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell(rupiah($totalharga), 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->ruangan_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->easyCell($data_pengajuan->keterangan_barang, 'font-size:10; align:L; valign:T');
    $tabelbarang->printRow();
 }
    $tabelbarang->rowStyle('align:{CCCCC}; font-style:B;');
    $tabelbarang->easyCell('', 'font-size:10; align:C; valign:T');
    $tabelbarang->easyCell('T  O  T  A  L', 'font-size:10; align:C; valign:T; colspan:6');
    $tabelbarang->easyCell(rupiah($total),'font-size:10; align:C; valign:T; colspan:4');
    $tabelbarang->printRow();
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

 $pdf->Output('I','Laporan Pengajuan Barang - '.$user->id."/".date(now())." - ".$user->nama_lengkap." - ".strtotime(now()));
exit;
?>