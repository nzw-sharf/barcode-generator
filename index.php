<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode Generator</title>
</head>
<body>
    <h1>Sequence Barcode Generator</h1>
    <form action="generate_barcodes.php" method="post" enctype="multipart/form-data">
        <label for="number_sequence">Upload Sequence</label><br>
        <br>
        <textarea id="number_sequence" name="number_sequence" rows="20" cols="50" required></textarea>
        <br><br>
        <button type="submit">Generate Barcode PDF</button>
    </form>
</body>
</html>
