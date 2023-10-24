{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parse Data</title>
    <style>
        .button-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .button-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Введите список URL для парсинга данных</h1>
    <form action="{{route('parse')}}" method="post">
        @csrf
        <textarea name="urls" rows="4" cols="50"></textarea><br>
        <button class="button-link" type="submit">Парсить</button>
    </form>
    <form action="{{route('clean')}}" method="post">
        @csrf
        <button class="button-link" type="submit">Сбросить</button>
    </form>
    <a href="/check-form" class="button-link">Назад</a>
</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parse Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0; /* Добавляем фон */
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff; /* Фон для контейнера */
            border-radius: 10px; /* Закругляем углы контейнера */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Добавляем тень контейнеру */
        }

        h1 {
            font-size: 24px;
        }

        .button-link {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px; /* Добавляем отступ между кнопками */
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: none; /* Убираем границу у кнопок */
        }

        .button-link:hover {
            background-color: #45a049;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Введите список URL для парсинга данных</h1>
        <form action="{{route('parse')}}" method="post">
            @csrf
            <textarea name="urls" rows="4" cols="50"></textarea>
            <button class="button-link" type="submit">Парсить</button>
        </form>
        <form action="{{route('clean')}}" method="post">
            @csrf
            <button class="button-link" type="submit">Сбросить</button>
        </form>
        <a href="/check-form" class="button-link">Назад</a>
    </div>
</body>
</html>
