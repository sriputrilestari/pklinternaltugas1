<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @if($barang && $kode)
    Barang: {{ $barang }}
    Kode Promo: {{ $kode }}
    @elseif($barang)
    Barang: {{ $barang }}
    @else
    Semua Promo Barang
    @endif
</body>
</html>