<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>{{ $title ?? '' }} {{ settings()->get('app_name', 'My APP') }}</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="3">
						<table>
							<tr>
								<td class="title">
									<img src="{{ asset('corona') }}/assets/images/logo-bc.png" width="180" />
									{{-- <span class="sidebar-brand brand-logo font-weight-bold text-white">SKYNET</span> --}}
								</td>

								<td>
									Invoice #: {{ $tagihan->id }}<br />
									Created: {{ $tagihan->tanggal_tagihan->translatedFormat('d F Y') }}<br />
									Due: {{ $tagihan->tanggal_jatuh_tempo->translatedFormat('d F Y') }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="3">
						<table>
							<tr>
								<td>
									{{ $tagihan->member->nama }}<br />
									{{ $tagihan->member->alamat_lengkap }}<br />
									{{ $tagihan->member->nohp }}
								</td>

								<td>
									{{ $tagihan->member->nama }}<br />
									{{ $tagihan->member->alamat_lengkap }}<br />
									{{ $tagihan->member->nohp }}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td width="2%" style="text-align: center">No</td>

					<td style="text-align: start">Item</td>

					<td>Sub-Total</td>
				</tr>

				@foreach ($tagihan->tagihanDetails as $item)
                    <tr class="item">
						<td style="text-align: center">{{ $loop->iteration }}</td>
                        <td style="text-align: start">{{ $item->nama_biaya }}</td>
                        <td style="text-align: end">{{ formatRupiah($item->jumlah_biaya) }}</td>
                    </tr>
                @endforeach

				<tr class="total" style="background: #eee">
					<td colspan="2" style="text-align: center; font-weight: bold">Total</td>
					<td>{{ formatRupiah($tagihan->total_tagihan) }}</td>
				</tr>

				<tr>
					<td colspan="3"><i>Terbilang : {{ ucwords(terbilang($tagihan->total_tagihan)) }} Rupiah</i></td>
				</tr>
			</table>
		</div>
	</body>
</html>