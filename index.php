<?php
// Автоматическое сканирование папки с книгами
$booksDir = 'audiobooks/';

$books = [];

if (is_dir($booksDir)) {
    $bookFolders = scandir($booksDir);

    foreach ($bookFolders as $folder) {
        if ($folder === '.' || $folder === '..') continue;

        $bookPath = $booksDir . $folder . '/';
        
        if (is_dir($bookPath)) {
            $chapters = [];

            $files = scandir($bookPath);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'mp3') {
                    $chapters[] = $bookPath . $file;
                }
            }

            $books[$folder] = [
                'title' => 'Книга: ' . ucfirst($folder),
                'chapters' => $chapters
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Аудиокниги</title>
    <!-- CDN FontAwesome вместо Kit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css ">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="winamp-header">
        <span class="winamp-title">WINAMP</span>
        <marquee id="trackMarquee" behavior="scroll" direction="left" scrollamount="2" class="winamp-track">
            Сейчас играет: Название книги — Глава 1
        </marquee>
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

    <audio id="audio"></audio>

    <div class="winamp-progress">
        <div class="progress-bar" id="progressBar"></div>
        <div class="progress-time">
            <span class="current-time" id="currentTime">00:00</span>
            <span class="total-time" id="totalTime">00:00</span>
        </div>
        <button class="volume-control">
            <i class="fas fa-volume-up"></i>
        </button>
    </div>

    <div class="winamp-playlist-header">WINAMP PLAYLIST</div>

    <ul class="playlist">
        <?php foreach ($books as $key => $book): ?>
            <li><strong><?= htmlspecialchars($book['title']) ?></strong></li>
            <?php foreach ($book['chapters'] as $i => $chapter): ?>
                <li>
                    <button onclick="playTrack('<?= $chapter ?>', this)">
                        Глава <?= $i + 1 ?>
                    </button>
                </li>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>
</div>

<script>
const audio = document.getElementById('audio');
const progressBar = document.getElementById('progressBar');
const currentTimeDisplay = document.getElementById('currentTime');
const totalTimeDisplay = document.getElementById('totalTime');
const trackMarquee = document.getElementById('trackMarquee');

function playTrack(src, btn) {
    if (audio.src !== src) {
        audio.src = src;
        audio.play();
    } else {
        audio.play();
    }

    const trackName = btn.textContent.trim();
    trackMarquee.innerHTML = trackName;

    document.querySelectorAll('.playlist button').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}

// Обновление прогресса воспроизведения
audio.addEventListener('timeupdate', () => {
    const progress = (audio.currentTime / audio.duration) * 100;
    progressBar.style.width = `${progress}%`;

    const formatTime = sec => {
        const minutes = Math.floor(sec / 60);
        const seconds = Math.floor(sec % 60).toString().padStart(2, '0');
        return `${minutes}:${seconds}`;
    };

    currentTimeDisplay.textContent = formatTime(audio.currentTime);
    totalTimeDisplay.textContent = formatTime(audio.duration || 0);
});

// Перемотка по клику
progressBar.addEventListener('click', (e) => {
    const clickPosition = e.offsetX / progressBar.offsetWidth;
    audio.currentTime = clickPosition * audio.duration;
});
</script>

</body>
</html>