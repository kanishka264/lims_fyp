<!DOCTYPE html>
<html>
<head>
</head>
<body>

<h3>Code: {{$barcode}}</h3>
@php
    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp
  
<img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($barcode, $generatorPNG::TYPE_CODE_128)) }}">
</body>
</html>
