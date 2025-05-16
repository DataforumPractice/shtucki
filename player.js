function playChapter(chapter) {
    const audio = document.getElementById("audioPlayer");
    audio.src = "audio/" + chapter;
    audio.play();
}

// Получаем элементы
const audio = document.getElementById('audio');
const progressBar = document.querySelector('.progress-bar');
const currentTimeDisplay = document.querySelector('.current-time');
const totalTimeDisplay = document.querySelector('.total-time');

// Обновляем прогресс при проигрывании
audio.addEventListener('timeupdate', () => {
    const progress = (audio.currentTime / audio.duration) * 100;
    progressBar.style.width = `${progress}%`;

    // Обновляем отображение времени
    const currentMinutes = Math.floor(audio.currentTime / 60);
    const currentSeconds = Math.floor(audio.currentTime % 60).toString().padStart(2, '0');
    const totalMinutes = Math.floor(audio.duration / 60);
    const totalSeconds = Math.floor(audio.duration % 60).toString().padStart(2, '0');

    currentTimeDisplay.textContent = `${currentMinutes}:${currentSeconds}`;
    totalTimeDisplay.textContent = `${totalMinutes}:${totalSeconds}`;
});

// Обработка клика по полосе перемотки
progressBar.addEventListener('click', (e) => {
    const clickPosition = e.offsetX / progressBar.offsetWidth;
    audio.currentTime = clickPosition * audio.duration;
});