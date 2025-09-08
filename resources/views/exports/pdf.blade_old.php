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
            padding: 0;

        }

        h1 {
            text-align: left;
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }
        .card-header {
            padding: auto;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 2px;
            color: #333;
        }

        .card-body {
            font-size: 12px;
            color: #555;
            word-wrap: break-word;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .card .card-body img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 8px;
            height: auto;
            object-fit: contain;
        }

        .image-count {
            font-size: 6px;
            background-color: #3498db;
            color: white;
            padding: 2px;
            border-radius: 10px;
            margin-top: 0;
            font-weight: bold;
        }

        .value-cell,
        .date-cell {
            font-size: 12px;
            margin-bottom: 10px;
            color: #555;
            word-wrap: break-word;
        }

        .value-cell-color {
            padding: 8px;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: inline-block;
        }

        .date-cell {
            font-weight: bold;
            color: #3498db;
        }

        .row {
            display: inline-block !important;
            gap: 10px;
            align-items: center;
            justify-content: center;
            color: #333;
            font-size: 12px;
            border: 1px solid black;
            padding-top: 30px;
            padding-left: 10px;


        }

        .col-it {

            display: inline-block !important;
            gap: 20px;
            width: 15%;
            align-items: center;
            margin: 0;
            justify-content: flex-start;
            padding: 10px;
            text-align: center;
            height: 150px;
            border: 1px solid #2c3e50;
            page-break-inside: avoid;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <h1 style="text-align: center; margin-bottom:20px;">Exported Data</h1>


    <div class="container" style="margin:50px;">

        @foreach ($data as $item)
            <div class="row">
                @foreach ($item as $key => $value)
                    <div class="card col-it" style="margin-top:20px;">
                        <div class="card-header"><b>{{ $thead[$loop->index] }}</b></div>
                        @php

                            $valueArray =
                                is_string($value) && (strpos($value, '[') !== false && strpos($value, ']') !== false)
                                    ? json_decode($value, true)
                                    : $value;

                            $isSingleImage =
                                is_string($value) &&
                                (strpos($value, '.jpg') !== false ||
                                    strpos($value, '.png') !== false ||
                                    strpos($value, '.jpeg') !== false);

                            $isBase64Image = strpos($value, 'data:image/') !== false;

                            $isMultipleImages =
                                is_array($valueArray) &&
                                count($valueArray) > 1 &&
                                (strpos($valueArray[0], '.jpg') !== false ||
                                    strpos($valueArray[0], '.png') !== false ||
                                    strpos($valueArray[0], '.jpeg') !== false);

                            $isHexColor = preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value);
                            $isDateOnly = preg_match('/^\d{4}-\d{2}-\d{2}$/', $value);
                            $formattedDateOnly = $isDateOnly ? date('Y-m-d', strtotime($value)) : null;
                            $isTimeOnly = preg_match('/^\d{2}:\d{2}$/', $value);
                            $formattedTimeOnly = $isTimeOnly ? date('H:i', strtotime($value)) : null;

                            $isDateTime =
                                strtotime($value) && strpos($value, ' ') && str_replace('T', ' ', $value) !== false;
                            $formattedDateTime = $isDateTime ? date('Y-m-d H:i', strtotime($value)) : null;

                        @endphp
                        @if (strpos($value, 'data:image/') !== false)
                            <img src="{{ $value }}" alt="Image" style="max-width: 100%; height: 200px;">
                        @endif
                        @if ($isMultipleImages)
                            @php
                                $firstImage = $valueArray[0];
                                $remainingCount = count($valueArray) - 1;

                            @endphp

                            <?php
                    $image     = trim($firstImage, '[]"');
                    $imagePath = public_path($image);
                    if (file_exists($imagePath)) {
                        $imgData  = base64_encode(file_get_contents($imagePath));
                        $mimeType = mime_content_type($imagePath);
                        $src      = 'data:' . $mimeType . ';base64,' . $imgData;
                    ?>

                            <div class="card-body"><img src="{{ $src }}" alt="Image">
                                @if ($remainingCount > 0)
                                    <div class="image-count">+{{ $remainingCount }} more images</div>
                                @endif
                            </div>

                            <?php
                    }
                ?>
                        @elseif($isSingleImage)
                            <?php
                    $image = trim($value, '[]"');

                    $imagePath = public_path($image);

                    if (file_exists($imagePath)) {
                        $imgData  = base64_encode(file_get_contents($imagePath));
                        $mimeType = mime_content_type($imagePath);
                        $src      = 'data:' . $mimeType . ';base64,' . $imgData;
                    ?>

                            <img src="{{ $src }}" alt="Image" style="max-width: 100%; height: auto;">
                            <?php
                    }
                ?>
                        @elseif($isHexColor)
                            <span class="value-cell-color card-body"
                                style="background-color: {{ $value }}"></span>
                        @elseif($formattedDateTime)
                            <div class="date-cell card-body">{{ $formattedDateTime }}</div>
                        @elseif($formattedDateOnly)
                            <div class="date-cell card-body">{{ $formattedDateOnly }}</div>
                        @elseif($formattedTimeOnly)
                            <div ss="date-cell card-body">{{ $formattedTimeOnly }}</div>
                        @else
                            <div class="value-cell card-body">{{ $value }}</div>
                        @endif

                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

</body>

</html>
