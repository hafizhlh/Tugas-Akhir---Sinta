// daftar barang untuk setiap jenis barang
var barangList = {
    persediaan: [
        { id: 1, name: 'TOTOLINK N200RE Mini Wireless N Router 300Mbps - v.4' },
        { id: 2, name: 'Barang 2' },
        { id: 3, name: 'Barang 3' }
        // tambahkan barang lain jika diperlukan
    ],
    asset: [
        { id: 4, name: 'Asset 1' },
        { id: 5, name: 'Asset 2' },
        { id: 6, name: 'Asset 3' }
        // tambahkan asset lain jika diperlukan
    ]
};

// fungsi untuk memuat opsi barang berdasarkan jenis barang yang dipilih
function loadBarang() {
    var jenisBarang = document.getElementById('jenis_code').value;
    var barangSelect = document.getElementById('barang_code');
    // hapus opsi barang yang sudah ada
    barangSelect.innerHTML = '';
    // tampilkan opsi barang untuk jenis barang yang dipilih
    if (barangList[jenisBarang]) {
        barangSelect.innerHTML += '<option value="">Pilih barang</option>';
        barangList[jenisBarang].forEach(function (barang) {
            barangSelect.innerHTML += '<option value="' + barang.code + '">' + barang.name


+ '</option>';
        });
    }
}
