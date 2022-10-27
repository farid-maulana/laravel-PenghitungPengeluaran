@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-5">
        <div class="card-body">
            <h3 class="card-title">Hitung Pengeluaran Tiap Orang</h3>
            <div class="row my-4">
                <div class="col-3">
                    <input type="number" class="form-control" id="people" placeholder="Masukkan Jumlah Orang">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary" onclick="createForm()">Submit</button>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div id="form"></div>
                    <div class="row my-4" style="display: none" id="additionalInformation">
                        <h4 class="mb-2">Informasi Tambahan</h4>
                        <div class='col-md-6 mb-3'>
                            <label class='form-label'>Ongkos Kirim</label>
                            <input type='number' class='form-control' name='shipping_cost'>
                        </div>
                        <div class='col-md-6 mb-3'>
                            <label class='form-label'>Diskon (dalam %)</label>
                            <input type='number' class='form-control' name='discount'>
                        </div>
                        <div class='col-md-6'>
                            <label class='form-label'>Maximum diskon</label>
                            <input type='number' class='form-control' name='maximum_discount'>
                        </div>
                        <div class='col-md-6'>
                            <label class='form-label'>Minimum transaksi untuk mendapatkan diskon</label>
                            <input type='number' class='form-control' name='minimum_transaction'>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary" id="submit" style="display: none">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Riwayat Penghitungan</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Ongkos Kirim</th>
                            <th scope="col">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="accordion" id="accordionExample">
                        @foreach($transactions as $transaction)
                            <tr data-toggle="collapse" data-target="#demo{{ $loop->iteration }}" class="accordion-toggle">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ date('d M Y', strtotime($transaction->created_at)) }}
                                </td>
                                <td>
                                    {{ $transaction->discount->discount * 100 . '%' }}
                                </td>
                                <td>{{ 'Rp ' . number_format($transaction->shipping_cost, 0, ',', '.') }}
                                </td>
                                <td>{{ 'Rp ' . number_format($transaction->total, 0, ',', '.') }}
                                </td>
                                <td>
                                    <button class="btn btn-info" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#demo{{ $loop->iteration }}" aria-expanded="true" aria-controls="collapseOne">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="12" class="hiddenRow">
                                    <div class="accordian-body collapse" id="demo{{ $loop->iteration }}">
                                        <table class="table">
                                            <thead>
                                                <tr class="info">
                                                    <th></th>
                                                    <th>Nama</th>
                                                    <th>Menu</th>
                                                    <th>Harga</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                    <th>Yang Harus Di Bayar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaction->transaction_details as $detail)
                                                    @foreach ($detail->transaction_products as $product)
                                                        @if($loop->first)
                                                            <tr>
                                                                <td
                                                                    rowspan="{{ $detail->transaction_products->count() }}">
                                                                </td>
                                                                <td rowspan="{{ $detail->transaction_products->count() }}"
                                                                    class="align-middle">{{ $detail->name }}</td>
                                                                <td>
                                                                    {{ $product->product_name }}
                                                                </td>
                                                                <td>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                                                                </td>
                                                                <td>{{ $product->qty }}</td>
                                                                <td>{{ 'Rp ' . number_format($product->subtotal, 0, ',', '.') }}
                                                                </td>
                                                                <td rowspan="{{ $detail->transaction_products->count() }}"
                                                                    class="align-middle">
                                                                    {{ 'Rp ' . number_format($detail->expanse, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td>
                                                                    {{ $product->product_name }}
                                                                </td>
                                                                <td>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}
                                                                </td>
                                                                <td>{{ $product->qty }}</td>
                                                                <td>{{ 'Rp ' . number_format($product->subtotal, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('style')
    <style>
        .hiddenRow {
            padding: 0 !important;
        }

    </style>
@endpush

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        function createForm() 
        {
            let people = document.getElementById('people').value

            for (let i = 0; i < people; i++) {
                let div = document.createElement('div')
                div.setAttribute('class', 'mb-4 pb-4 border-bottom border-2')
                div.innerHTML = "<div class='col-md-12'>" + 
                    "<label class='form-label'>Nama</label>" + 
                    "<input type='text' class='form-control' name='name[]'>" + 
                "</div>" +
                "<div class='row mt-2'>" +
                    "<div class='col'>" + 
                        "<label class='form-label'>Menu</label>" +
                        "<input type='text' class='form-control' name='product[" + i + "][product_name][]'>" + 
                    "</div>" +
                    "<div class='col'>" + 
                        "<label class='form-label'>Harga</label>" + 
                        "<input type='number' class='form-control' name='product[" + i + "][price][]'>" +
                    "</div>" +
                    "<div class='col'>" + 
                        "<label class='form-label'>QTY</label>" + 
                        "<input type='number' class='form-control' name='product[" + i + "][qty][]'>" +
                    "</div>" + 
                "</div>" +
                "<div id='newRow" + i + "'></div>" +
                "<div class='row mt-2 mb-3'>" +
                    "<div class='col-12'>" +
                        "<button type='button' class='btn btn-secondary' onclick='createNewRow(" + i + ")'> Tambah Menu </button>" +
                    "</div>" +
                "</div>"

                document.getElementById('form').appendChild(div)
            }

            document.getElementById('submit').style.display = 'block'
            document.getElementById('additionalInformation').style.display = 'flex'
        }

        function createNewRow(id)
        {
            let row = document.createElement('div')
            row.setAttribute('class', 'row mt-2')
            row.innerHTML += "<div class='row mt-2'>" +
                "<div class='col'>" + 
                    "<label class='form-label'>Menu</label>" +
                    "<input type='text' class='form-control' name='product[" + id + "][product_name][]'>" + 
                "</div>" +
                "<div class='col'>" + 
                    "<label class='form-label'>Harga</label>" + 
                    "<input type='number' class='form-control' name='product[" + id + "][price][]'>" +
                "</div>" +
                "<div class='col'>" + 
                    "<label class='form-label'>QTY</label>" + 
                    "<input type='number' class='form-control' name='product[" + id + "][qty][]'>" +
                "</div>" + 
            "</div>"

            document.getElementById(`newRow${id}`).appendChild(row)
        }
    </script>
@endpush