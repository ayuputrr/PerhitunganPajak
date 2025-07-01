<?= $this->extend('dashboard/layout') ?>
<?= $this->section('content') ?>

<style>
  .card-stat {
    background: linear-gradient(135deg, #2F80ED, #56CCF2);
    color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    padding: 20px;
    transition: 0.3s;
  }
  .card-stat:hover {
    transform: scale(1.02);
  }
  .chart-container {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
  }
</style>

<div class="container-fluid px-7 py-5">
  <h2 class="fw-bold text-dark mb-4">📊 Dashboard Data Pegawai</h2>

  <div class="row g-4 mb-4">
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">Total Pegawai</h5>
        <h3><?= count($pegawai) ?></h3>
        <small class="text-light">Data yang terdaftar</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">Gaji Bruto Total</h5>
        <h3>Rp <?= number_format(array_sum(array_column($pegawai, 'bruto_bulanan'))) ?></h3>
        <small class="text-light">Bulanan</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">PPH Bruto Total</h5>
        <h3>Rp <?= number_format(array_sum(array_column($pegawai, 'pph_bruto_bulanan'))) ?></h3>
        <small class="text-light">Bulanan</small>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-stat text-center">
        <h5 class="mb-2">PPH + TPP Total</h5>
        <h3>Rp <?= number_format(array_sum(array_column($pegawai, 'pph_bruto_tpp_bulanan'))) ?></h3>
        <small class="text-light">Bulanan</small>
      </div>
    </div>
  </div>

  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
    <form class="d-flex" method="get" action="">
      <input type="text" name="search" class="form-control me-2" placeholder="Cari nama pegawai..." value="<?= esc($search ?? '') ?>">
      <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
    </form>
    <div class="d-flex gap-2">
      <a href="/pegawai/create" class="btn btn-outline-primary">
        <i class="bi bi-plus-circle"></i> Tambah Pegawai
      </a>
      <a href="/pegawai/export_excel_all" class="btn btn-success">
        <i class="bi bi-file-earmark-excel"></i> Export Semua Pegawai
      </a>
    </div>
  </div>

  <!-- Grafik Pajak Tahunan -->
<div class="card shadow-sm border-0 chart-container mb-4">
  <div class="card-body">
    <h5 class="fw-bold text-center mb-4">Grafik Total Pajak PPH 21 Pegawai (Tahunan)</h5>
    <div id="grafikPajakTahunan"></div>
  </div>
</div>

    <!-- Grafik Pajak Bulanan -->
  <div class="card shadow-sm border-0 chart-container mb-4">
    <div class="card-body">
      <h5 class="fw-bold text-center mb-4">Grafik Total Pajak PPH 21 Pegawai (Bulanan)</h5>
      <div id="grafikPajakBulanan"></div>
    </div>
  </div>
</div>

  <div class="card shadow-sm border-0 chart-container mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle mb-0">
          <thead class="table-dark text-center">
            <tr>
              <th scope="col">NIP</th>
              <th scope="col">Nama</th>
              <th scope="col">Status</th>
              <th scope="col">Gaji Bruto</th>
              <th scope="col">PPH Bruto</th>
              <th scope="col">PPH Bruto + TPP</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pegawai as $row): ?>
              <tr>
                <td class="text-nowrap"><?= $row['nip'] ?></td>
                <td class="text-capitalize"><?= $row['nama'] ?></td>
                <td><?= $row['status'] ?></td>
                <td class="text-end"><?= number_format($row['bruto_bulanan']) ?></td>
                <td class="text-end"><?= number_format($row['pph_bruto_bulanan']) ?></td>
                <td class="text-end"><?= number_format($row['pph_bruto_tpp_bulanan']) ?></td>
                <td class="text-center">
                  <a href="/pegawai/edit/<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-1">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <a href="/pegawai/hitung/<?= $row['id'] ?>" class="btn btn-sm btn-info mb-1">
                    <i class="bi bi-calculator"></i> Hitung Pajak
                  </a>
                  <a href="/pegawai/hitungTahunan/<?= $row['id'] ?>" class="btn btn-sm btn-secondary mb-1">
                    <i class="bi bi-file-earmark-text"></i> Detail
                  </a>
                  <a href="/pegawai/export_excel/<?= $row['id'] ?>" class="btn btn-sm btn-success mb-1">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  const options = {
    chart: {
      type: 'bar',
      height: 350,
      toolbar: { show: false }
    },
    series: [{
      name: 'PPH Bulanan',
      data: [
        20077732, 29342956, 10935782, 12673892,
        19289660, 27996889, 13609684, 17921796,
        29351945, 19344113, 14974722, 18832784
      ]
    }],
    xaxis: {
      categories: [
        'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
        'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
      ],
      title: { text: 'Bulan' }
    },
    yaxis: {
      labels: {
        formatter: function (val) {
          return 'Rp ' + val.toLocaleString();
        }
      },
      title: { text: 'Total PPH 21' }
    },
    colors: ['#00B894'],
    dataLabels: { enabled: false },
    tooltip: {
      y: {
        formatter: function (val) {
          return 'Rp ' + val.toLocaleString();
        }
      }
    }
  };

  const chart = new ApexCharts(document.querySelector("#grafikPajakBulanan"), options);
  chart.render();

  const optionsTahunan = {
    chart: {
      type: 'bar',
      height: 350,
      toolbar: { show: false }
    },
    series: [{
      name: 'PPH Tahunan',
      data: [
        260000000, 245000000, 275000000, 300000000, 225000000, 315000000
      ]
    }],
    xaxis: {
      categories: ['2019', '2020', '2021', '2022', '2023', '2024'],
      title: { text: 'Tahun' }
    },
    yaxis: {
      labels: {
        formatter: function (val) {
          return 'Rp ' + val.toLocaleString();
        }
      },
      title: { text: 'Total PPH 21 Tahunan' }
    },
    colors: ['#F39C12'],
    dataLabels: { enabled: false },
    tooltip: {
      y: {
        formatter: function (val) {
          return 'Rp ' + val.toLocaleString();
        }
      }
    }
  };

  const chartTahunan = new ApexCharts(document.querySelector("#grafikPajakTahunan"), optionsTahunan);
  chartTahunan.render();
</script>

<?= $this->endSection() ?>
