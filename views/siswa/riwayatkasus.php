<td class="font-weight-bold text-dark">
    <?= htmlspecialchars($row['namakasus'] ?? 'Kasus Umum'); ?>
</td>
<td>
    <span class="badge badge-info">
        <?= htmlspecialchars($row['namakategori'] ?? 'Umum'); ?>
    </span>
</td>
<td class="text-center">
    <?php 
    $status = strtolower($row['status'] ?? 'pending');
    if ($status == 'selesai' || $status == 'disetujui') {
        echo '<span class="badge badge-success px-3 py-1"><i class="fas fa-check-circle mr-1"></i> Selesai</span>';
    } elseif ($status == 'diproses' || $status == 'ditangani') {
        echo '<span class="badge badge-warning text-white px-3 py-1"><i class="fas fa-spinner fa-spin mr-1"></i> Diproses</span>';
    } elseif ($status == 'ditolak') {
        echo '<span class="badge badge-danger px-3 py-1"><i class="fas fa-times-circle mr-1"></i> Ditolak</span>';
    } else {
        echo '<span class="badge badge-secondary px-3 py-1"><i class="fas fa-clock mr-1"></i> Menunggu Verifikasi</span>';
    }
    ?>
</td>