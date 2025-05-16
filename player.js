function playChapter(chapter) {
    const audio = document.getElementById("audioPlayer");
    audio.src = "audio/" + chapter;
    audio.play();
}