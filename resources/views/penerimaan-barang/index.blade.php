@extends('layouts.app')

@section('content_title', 'Penerimaan Barang')

@section('content')
    <style>
        .entry-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .input-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .table-modern thead th {
            background: #f1f5f9;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }

        .select2-container--bootstrap .select2-selection {
            border-radius: 5px;
        }
    </style>

    <div class="card entry-card">
        <form action="{{ route('penerimaan-barang.store') }}" method="POST" id="form-penerimaan-barang">
            @csrf
            <div id="data-hidden"></div>

            <div class="d-flex align-items-center justify-content-between p-4 border-bottom bg-white"
                style="border-radius: 15px 15px 0 0;">
                <h5 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-truck-loading mr-2 text-primary"></i> Form Penerimaan Barang
                </h5>
                <button type="submit" class="btn btn-primary px-4 shadow-sm" style="border-radius: 8px;">
                    <i class="fas fa-save mr-2"></i> Simpan Transaksi
                </button>
            </div>

            <div class="card-body p-4">
                <x-alert :errors="$errors" type="danger" />

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small font-weight-bold text-muted">NAMA DISTRIBUTOR</label>
                            <input type="text" name="distributor" id="distributor" class="form-control"
                                placeholder="Masukkan nama distributor" value="{{ old('distributor') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="small font-weight-bold text-muted">NOMOR FAKTUR / INVOICE</label>
                            <input type="text" name="nomor_faktur" id="nomor_faktur" class="form-control"
                                placeholder="Contoh: INV/2023/001" value="{{ old('nomor_faktur') }}">
                        </div>
                    </div>
                </div>

                <div class="input-section border">
                    <h6 class="font-weight-bold mb-3 text-secondary small">INPUT ITEM BARANG</h6>
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <div class="form-group mb-0">
                                <label class="small font-weight-bold">Cari Produk</label>
                                <select name="select2" id="select2" class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group mb-0 text-center">
                                <label class="small font-weight-bold">Stok</label>
                                <input type="text" id="current_stok" class="form-control text-center bg-white" readonly
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group mb-0">
                                <label class="small font-weight-bold">Qty</label>
                                <input type="number" id="qty" class="form-control text-center" min="1"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-0">
                                <label class="small font-weight-bold">Harga Beli Satuan (Rp)</label>
                                <input type="number" id="harga_beli" class="form-control" min="1"
                                    placeholder="Masukkan Harga">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-dark btn-block shadow-sm" id="btn-add">
                                <i class="fas fa-plus mr-1"></i> Tambahkan Ke Daftar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-modern border" id="table-produk">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th class="text-center" width="100px">Qty</th>
                                <th class="text-right">Harga Beli</th>
                                <th class="text-right">Sub Total</th>
                                <th class="text-center" width="80px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot class="bg-light font-weight-bold">
                            <tr>
                                <td colspan="3" class="text-right">TOTAL PENERIMAAN</td>
                                <td class="text-right text-primary" id="grand-total">Rp. 0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            let selectedProduk = {};

            // Inisialisasi Select2
            $('#select2').select2({
                theme: 'bootstrap',
                placeholder: 'Ketik Nama atau SKU Produk...',
                ajax: {
                    url: "{{ route('get-data.produk') }}",
                    dataType: 'json',
                    delay: 250,
                    data: (params) => {
                        return {
                            search: params.term
                        }
                    },
                    processResults: (data) => {
                        data.forEach(item => {
                            selectedProduk[item.id] = item;
                        });
                        return {
                            results: data.map((item) => {
                                return {
                                    id: item.id,
                                    text: item.nama_produk
                                }
                            })
                        }
                    },
                    cache: true
                },
                minimumInputLength: 3,
            });

            // Cek Stok Otomatis
            $("#select2").on("select2:select", function(e) {
                let id = $(this).val();
                $.get("{{ route('get-data.cek-stok') }}", {
                    id: id
                }, function(response) {
                    $("#current_stok").val(response.stok || response);
                    $("#qty").focus();
                });
            });

            // Hitung Grand Total
            function calculateGrandTotal() {
                let total = 0;
                $("#table-produk tbody tr").each(function() {
                    let subtotal = parseInt($(this).find("td:eq(3)").text().replace(/[^0-9]/g, ''));
                    total += subtotal;
                });
                $("#grand-total").text("Rp. " + new Intl.NumberFormat('id-ID').format(total));
            }

            // Tambah ke Tabel
            $("#btn-add").on("click", function() {
                const selectedId = $("#select2").val();
                const qty = parseInt($("#qty").val());
                const hargaBeli = parseInt($("#harga_beli").val());

                if (!selectedId || isNaN(qty) || isNaN(hargaBeli)) {
                    alert("Lengkapi data produk, jumlah, dan harga beli!");
                    return;
                }

                let exists = false;
                $("#table-produk tbody tr").each(function() {
                    if ($(this).data("id") == selectedId) {
                        let currentQty = parseInt($(this).find("td:eq(1)").text());
                        let newQty = currentQty + qty;
                        let newSubTotal = newQty * hargaBeli;
                        $(this).find("td:eq(1)").text(newQty);
                        $(this).find("td:eq(3)").text(new Intl.NumberFormat('id-ID').format(
                            newSubTotal));
                        exists = true;
                    }
                });

                if (!exists) {
                    const produk = selectedProduk[selectedId];
                    const subTotal = qty * hargaBeli;
                    const newRow = `
                    <tr data-id="${produk.id}">
                        <td class="font-weight-bold text-dark">${produk.nama_produk}</td>
                        <td class="text-center">${qty}</td>
                        <td class="text-right">${new Intl.NumberFormat('id-ID').format(hargaBeli)}</td>
                        <td class="text-right font-weight-bold">${new Intl.NumberFormat('id-ID').format(subTotal)}</td>
                        <td class="text-center">
                            <button class="btn btn-outline-danger btn-sm border-0 btn-remove">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;
                    $("#table-produk tbody").append(newRow);
                }

                // Reset Fields
                $("#select2").val(null).trigger("change");
                $("#qty, #harga_beli, #current_stok").val("");
                calculateGrandTotal();
            });

            // Hapus Baris
            $("#table-produk").on("click", ".btn-remove", function() {
                $(this).closest("tr").remove();
                calculateGrandTotal();
            });

            // Submit Form
            $("#form-penerimaan-barang").on("submit", function(e) {
                if ($("#table-produk tbody tr").length === 0) {
                    alert("Harap tambahkan produk ke daftar!");
                    e.preventDefault();
                    return;
                }

                $("#data-hidden").html("");
                $("#table-produk tbody tr").each(function(index, row) {
                    const id = $(row).data("id");
                    const qty = $(row).find("td:eq(1)").text();
                    const harga = $(row).find("td:eq(2)").text().replace(/[^0-9]/g, '');
                    const sub = $(row).find("td:eq(3)").text().replace(/[^0-9]/g, '');

                    $("#data-hidden").append(`
                    <input type="hidden" name="produk[${index}][produk_id]" value="${id}">
                    <input type="hidden" name="produk[${index}][qty]" value="${qty}">
                    <input type="hidden" name="produk[${index}][harga_beli]" value="${harga}">
                    <input type="hidden" name="produk[${index}][sub_total]" value="${sub}">
                `);
                });
            });
        });
    </script>
@endpush
