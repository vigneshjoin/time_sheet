<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Ledger CSV Import</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
    <div class="container">
        <h2>Import CSV File</h2>

        <!-- @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif -->

        <form action="{{ route('general-ledger-import-csv.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="file" name="csv_file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Import CSV</button>
        </form>
    </div>
</body>
</html>
