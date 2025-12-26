@extends('layouts.app')

@section('content_title', 'Pengeluaran Barang')

@section('content')
    <style>
        .pos-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .bg-light-blue {
            background-color: #f0f7ff;
        }

        .total-display {
            background: #1e2d3b;
            color: #00e676;
            padding: 20px;
            border-radius: 12px;
            text-align: right;
            margin-bottom: 20px;
        }

        .total-display small {
            color: #8a99a8;
            display: block;
            text-transform: uppercase;
            font-size: 0.7rem;
        }

        .total-display h2 {
            margin: 0;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }

        .table-pos thead th {
            background: #f8f9fa;
            border-top: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .form-section-label {
            font-weight: 700;
            color: #495057;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 15px;
            border-left: 4px solid #007bff;
            padding-left: 10px;
        }
    </style>

    <div class="container-fluid">
        <form action="{{ route('pengeluaran-barang.store') }}" method="POST" id="form-pengeluaran-barang">
            @csrf
            <div id="data-hidden"></div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card pos-card mb-4">
                        <div class="card-body">
                            <span class="form-section-label">Pilih Produk</span>
                            <div class="row align-items-end">
                                <div class="col-md-5">
                                    <div class="form-group mb-md-0">
                                        <label class="small font-weight-bold">Cari Produk</label>
                                        <select name="select2" id="select2" class="form-control"></select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-md-0">
                                        <label class="small font-weight-bold">Stok</label>
                                        <input type="text" id="current_stok"
                                            class="form-control bg-light text-center font-weight-bold" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mb-md-0">
                                        <label class="small font-weight-bold">Qty</label>
                                        <input type="number" id="qty" class="form-control text-center" min="1"
                                            placeholder="0">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-primary btn-block" id="btn-add">
                                        <i class="fas fa-plus mr-2"></i> Tambah
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" id="harga_jual">
                        </div>
                    </div>

                    <div class="card pos-card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-pos mb-0" id="table-produk">
                                    <thead>
                                        <tr>
                                            <th class="pl-4">Nama Produk</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Sub Total</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div id="empty-cart-msg" class="text-center py-5 text-muted">
                                <i class="fas fa-shopping-cart fa-3x mb-3 opacity-2"></i>
                                <p>Keranjang masih kosong</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="total-display shadow-sm">
                        <small>Total yang harus dibayar</small>
                        <h2 id="display-total">Rp 0</h2>
                    </div>

                    <div class="card pos-card">
                        <div class="card-body">
                            <span class="form-section-label">Pembayaran</span>

                            <div class="form-group mb-4">
                                <label class="text-muted small">Total Tagihan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0">Rp</span>
                                    </div>
                                    <input type="number" id="total" class="form-control border-left-0 font-weight-bold"
                                        readonly value="0">
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-muted small">Jumlah Bayar (F8)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white border-primary">Rp</span>
                                    </div>
                                    <input type="number" name="bayar" id="bayar"
                                        class="form-control form-control-lg border-primary font-weight-bold" placeholder="0"
                                        required>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="text-muted small">Kembalian</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0">Rp</span>
                                    </div>
                                    <input type="number" id="kembalian"
                                        class="form-control border-left-0 bg-light font-weight-bold text-danger" readonly
                                        value="0">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg btn-block shadow" id="btn-save">
                                <i class="fas fa-cash-register mr-2"></i> SELESAIKAN TRANSAKSI
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let selectedProduk = {};

            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(angka);
            }

            function hitungTotal() {
                let total = 0;
                const rowCount = $("#table-produk tbody tr").length;

                if (rowCount > 0) {
                    $("#empty-cart-msg").hide();
                    $("#table-produk tbody tr").each(function() {
                        const subTotal = parseInt($(this).find("td:eq(3)").attr('data-value')) || 0;
                        total += subTotal;
                    });
                } else {
                    $("#empty-cart-msg").show();
                }

                $("#total").val(total);
                $("#display-total").text(formatRupiah(total));
                updateKembalian();
            }

            function updateKembalian() {
                const total = parseInt($("#total").val()) || 0;
                const bayar = parseInt($("#bayar").val()) || 0;
                const kembalian = bayar - total;
                $("#kembalian").val(kembalian);

                if (kembalian >= 0) {
                    $("#kembalian").removeClass('text-danger').addClass('text-success');
                } else {
                    $("#kembalian").removeClass('text-success').addClass('text-danger');
                }
            }

            // Initialize Select2 with cleaner theme
            $('#select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Ketik nama produk...',
                ajax: {
                    url: "{{ route('get-data.produk') }}",
                    dataType: 'json',
                    delay: 250,
                    data: (params) => ({
                        search: params.term
                    }),
                    processResults: (data) => {
                        data.forEach(item => {
                            selectedProduk[item.id] = item;
                        });
                        return {
                            results: data.map((item) => ({
                                id: item.id,
                                text: item.nama_produk
                            }))
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
            });

            $("#select2").on("select2:select", function(e) {
                let id = $(this).val();
                // Fetch Stock & Price
                $.get("{{ route('get-data.cek-stok') }}", {
                    id: id
                }, function(res) {
                    $("#current_stok").val(res.stok || res);
                });
                $.get("{{ route('get-data.cek-harga') }}", {
                    id: id
                }, function(res) {
                    $("#harga_jual").val(res.harga_jual || res);
                });
                setTimeout(() => {
                    $("#qty").focus();
                }, 100);
            });

            $("#btn-add").on("click", function() {
                const id = $("#select2").val();
                const qty = parseInt($("#qty").val());
                const stok = parseInt($("#current_stok").val());
                const harga = parseInt($("#harga_jual").val());

                if (!id || isNaN(qty) || qty <= 0) {
                    Swal.fire('Oops!', 'Pilih produk dan masukkan jumlah yang benar', 'warning');
                    return;
                }

                if (qty > stok) {
                    Swal.fire('Stok Kurang', 'Sisa stok hanya ' + stok, 'error');
                    return;
                }

                let exists = false;
                $("#table-produk tbody tr").each(function() {
                    if ($(this).data("id") == id) {
                        let oldQty = parseInt($(this).find(".qty-val").text());
                        let newQty = oldQty + qty;
                        if (newQty > stok) {
                            Swal.fire('Batas Stok', 'Total dikeranjang melebihi stok', 'warning');
                            exists = true;
                            return false;
                        }
                        $(this).find(".qty-val").text(newQty);
                        $(this).find(".subtotal-val").text(formatRupiah(newQty * harga)).attr(
                            'data-value', newQty * harga);
                        exists = true;
                        return false;
                    }
                });

                if (!exists) {
                    const p = selectedProduk[id];
                    const row = `
                    <tr data-id="${id}">
                        <td class="pl-4 font-weight-bold">${p.nama_produk}</td>
                        <td class="text-center qty-val">${qty}</td>
                        <td class="text-right">${formatRupiah(harga)}</td>
                        <td class="text-right font-weight-bold subtotal-val" data-value="${qty*harga}">${formatRupiah(qty*harga)}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-outline-danger btn-sm border-0 btn-remove"><i class="fas fa-times"></i></button>
                        </td>
                    </tr>`;
                    $("#table-produk tbody").append(row);
                }

                $("#select2").val(null).trigger("change");
                $("#qty").val("");
                $("#current_stok").val("");
                hitungTotal();
            });

            $(document).on("click", ".btn-remove", function() {
                $(this).closest("tr").remove();
                hitungTotal();
            });

            $("#bayar").on("input", updateKembalian);

            $("#form-pengeluaran-barang").on("submit", function(e) {
                const total = parseInt($("#total").val());
                const bayar = parseInt($("#bayar").val());

                if ($("#table-produk tbody tr").length === 0) {
                    e.preventDefault();
                    Swal.fire('Kosong', 'Tambahkan produk dulu!', 'info');
                    return;
                }
                if (bayar < total) {
                    e.preventDefault();
                    Swal.fire('Uang Kurang', 'Jumlah bayar tidak mencukupi total tagihan', 'error');
                    return;
                }

                $("#data-hidden").empty();
                $("#table-produk tbody tr").each(function(i, row) {
                    const id = $(row).data("id");
                    const qty = $(row).find(".qty-val").text();
                    const sub = $(row).find(".subtotal-val").attr('data-value');
                    const harga = parseInt(sub) / parseInt(qty);
                    const nama = $(row).find("td:eq(0)").text();

                    $("#data-hidden").append(`
                    <input type="hidden" name="produk[${i}][produk_id]" value="${id}">
                    <input type="hidden" name="produk[${i}][nama_produk]" value="${nama}">
                    <input type="hidden" name="produk[${i}][qty]" value="${qty}">
                    <input type="hidden" name="produk[${i}][harga_jual]" value="${harga}">
                    <input type="hidden" name="produk[${i}][sub_total]" value="${sub}">
                `);
                });
            });
        });
    </script>
@endpush
