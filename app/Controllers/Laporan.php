<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use App\Models\LaporanPegawaiModel;

class Laporan extends Controller
{
    protected $laporanPegawaiModel;

    public function __construct()
    {
        $this->laporanPegawaiModel = new LaporanPegawaiModel();
    }

    public function bulanan()
    {
        $bulan = $this->request->getGet('bulan') ?? date('n');
        $status = $this->request->getGet('status') ?? 'all';

        $laporan = $this->laporanPegawaiModel->getLaporanBulanan($bulan, $status);

        return view('laporan/bulanan', [
            'laporan' => $laporan,
            'selectedMonth' => $bulan,
            'selectedStatus' => $status
        ]);
    }

    public function export_excel_bulanan()
    {
        $bulan = $this->request->getGet('bulan') ?? date('n');
        $status = $this->request->getGet('status') ?? 'all';
        $laporan = $this->laporanPegawaiModel->getLaporanBulanan($bulan, $status);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LAPORAN PPH 21 BULANAN PEGAWAI');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'Bulan: ' . date('F', mktime(0, 0, 0, $bulan, 1)));
        $sheet->mergeCells('A2:J2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $header = [
            'No', 'NIP', 'Nama Pegawai', 'Status', 'Gaji Bruto',
            'Iuran Pensiun', 'TPP', 'Tarif (%)', 'PPH Bruto', 'PPH Bruto + TPP'
        ];
        $sheet->fromArray($header, null, 'A4');

        $row = 5;
        $no = 1;
        foreach ($laporan as $data) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $data['nip']);
            $sheet->setCellValue('C' . $row, $data['nama']);
            $sheet->setCellValue('D' . $row, $data['status']);
            $sheet->setCellValue('E' . $row, $data['bruto_bulanan']);
            $sheet->setCellValue('F' . $row, $data['iuran_pensiun']);
            $sheet->setCellValue('G' . $row, $data['tpp']);
            $sheet->setCellValue('H' . $row, $data['tarif']);
            $sheet->setCellValue('I' . $row, $data['pph_bruto_bulanan']);
            $sheet->setCellValue('J' . $row, $data['pph_bruto_tpp_bulanan']);
            $row++;
        }

        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0d6efd']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN]
            ],
            'font' => ['color' => ['rgb' => 'FFFFFF']]
        ];
        $sheet->getStyle('A4:J4')->applyFromArray($headerStyle);

        $sheet->getStyle('A5:J' . ($row - 1))->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT]
        ]);

        foreach (range('E', 'J') as $col) {
            for ($r = 5; $r < $row; $r++) {
                $sheet->getStyle($col . $r)->getNumberFormat()->setFormatCode('#,##0');
            }
        }

        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Laporan_PPh21_Bulanan_' . date('F_Y', mktime(0, 0, 0, $bulan, 1)) . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function tahunan()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $status = $this->request->getGet('status') ?? 'all';

        $laporan = $this->laporanPegawaiModel->getLaporanTahunan($tahun, $status);

        return view('laporan/tahunan', [
            'laporan' => $laporan,
            'selectedYear' => $tahun,
            'selectedStatus' => $status
        ]);
    }

    public function export_excel_tahunan()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $status = $this->request->getGet('status') ?? 'all';

        $laporan = $this->laporanPegawaiModel->getLaporanTahunan($tahun, $status);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LAPORAN PPH 21 TAHUNAN PEGAWAI');
        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A2', 'Tahun: ' . $tahun);
        $sheet->mergeCells('A2:G2');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $header = [
            'No', 'NIP', 'Nama', 'Status', 'Gaji Bruto (Tahunan)', 'PPH 21 Setahun', 'PKP'
        ];
        $sheet->fromArray($header, null, 'A4');

        $row = 5;
        $no = 1;
        foreach ($laporan as $data) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $data['nip']);
            $sheet->setCellValue('C' . $row, $data['nama']);
            $sheet->setCellValue('D' . $row, $data['status']);
            $sheet->setCellValue('E' . $row, $data['bruto_tahunan'] ?? ($data['bruto_bulanan'] ?? 0) * 12);
            $sheet->setCellValue('F' . $row, $data['pph_setahun'] ?? (($data['pph_bruto_bulanan'] ?? 0) * 12));
            $sheet->setCellValue('G' . $row, $data['pkp'] ?? 0);
            $row++;
        }

        $sheet->getStyle('A4:G4')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0d6efd']
            ],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
        ]);

        $sheet->getStyle('A5:G' . ($row - 1))->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
        ]);

        foreach (['E', 'F', 'G'] as $col) {
            for ($r = 5; $r < $row; $r++) {
                $sheet->getStyle($col . $r)
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');
            }
        }

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Laporan_PPh21_Tahunan_' . $tahun . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
