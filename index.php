<?php
// Здесь определим наши книги
$books = [
    'book1' => [
        'title' => 'Книга 1: Приключения',
        'chapters' => ['chapter1.mp3', 'chapter2.mp3']
    ],
    'book2' => [
        'title' => 'Книга 2: Загадка леса',
        'chapters' => ['chapter1.mp3', 'chapter2.mp3']
    ]
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аудиокниги</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>🎧 Аудиокниги</h1>

    <div class="books">
        <?php foreach ($books as $key => $book): ?>
            <div class="book">
                <h2><?= htmlspecialchars($book['title']) ?></h2>
                <ul class="playlist">
                    <?php foreach ($book['chapters'] as $i => $chapter): ?>
                        <li>
                            <button onclick="playChapter('<?= $key ?>/<?= $chapter ?>')">
                                Глава <?= $i + 1 ?>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

    <audio id="audioPlayer" controls>
        <source src="" type="audio/mpeg">
        Ваш браузер не поддерживает аудио.
    </audio>
</div>

<script src="player.js"></script>

</body>
</html>