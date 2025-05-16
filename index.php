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

<!-- Пример Winamp-style аудиокниги -->
<div class="container">
  <div class="winamp-header">
    <span class="winamp-title">WINAMP</span>
    <span class="winamp-track">1. Название книги — Глава 1</span>
    <span class="winamp-time">00:00</span>
  </div>
  <div class="winamp-controls">
    <button title="Play">&#9654;</button>
    <button title="Pause">&#10073;&#10073;</button>
    <button title="Stop">&#9632;</button>
    <button title="Prev">&#9198;</button>
    <button title="Next">&#9197;</button>
    <button title="Shuffle">SHUF</button>
    <button title="Repeat">REP</button>
  </div>
  <audio id="audio" src="audio/chapter1.mp3" controls style="width:100%;margin:12px 0 0 0;"></audio>
  <div class="winamp-playlist-header">WINAMP PLAYLIST</div>
  <ul class="playlist">
    <li><button onclick="playTrack('audio/chapter1.mp3', this)">1. Название книги — Глава 1 <span class="track-time">4:47</span></button></li>
    <li><button onclick="playTrack('audio/chapter2.mp3', this)">2. Название книги — Глава 2 <span class="track-time">4:02</span></button></li>
    <li><button onclick="playTrack('audio/chapter3.mp3', this)">3. Название книги — Глава 3 <span class="track-time">4:54</span></button></li>
    <!-- Добавьте остальные главы -->
  </ul>
</div>

<script>
function playTrack(src, btn) {
  const audio = document.getElementById('audio');
  audio.src = src;
  audio.play();
  // Подсветка активного трека
  document.querySelectorAll('.playlist button').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
}
</script>

</body>
</html>