<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exported Data</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: 600;
            color: #2c3e50;
        }

        .container {
            max-width: 90%;
            margin: auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            /* Enables flexbox */
            flex-direction: row;
            /* Ensures items are aligned in a row */
            justify-content: center;
            /* Centers items horizontally */
            align-items: center;
            /* Centers items vertically */
            flex-wrap: wrap;
            /* Allows wrapping if needed */
            gap: 10px;
            /* Adds spacing between items */
            margin: 10px 0;
            /* Adds some vertical spacing */
        }

        .col-it {
            flex: 1 1 calc(20% - 20px);
            min-width: 180px;
            max-width: 200px;
            height: auto;
            padding: 15px;
            text-align: center;
            border: 1px solid #2c3e50;
            border-radius: 8px;
            background: #ffffff;
            page-break-inside: avoid;
        }

        .card-header {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .card-body {
            font-size: 12px;
            color: #555;
            word-wrap: break-word;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .card-body img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 8px;
            height: auto;
            object-fit: contain;
        }

        .value-cell {
            font-size: 12px;
            margin-bottom: 10px;
            color: #555;
            word-wrap: break-word;
        }

        .date-cell {
            font-size: 12px;
            font-weight: bold;
            color: #3498db;
        }
    </style>
</head>

<body>
    <h1>Exported Data</h1>
    <div class="container">
        @foreach ($data as $item)
            <div class="row ">
                @foreach ($item as $key => $value)
                    <div class="card col-it">
                        <div class="card-header"><b>{{ $thead[$loop->index] }}</b></div>
                        <div class="card-body">
                            {{ $value }}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</body>

</html>
