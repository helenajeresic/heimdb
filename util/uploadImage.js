document.getElementById('slika-input').addEventListener('change', function() {
var fileInput = this;
var fileNameSpan = document.getElementById('file-name');

if (fileInput.files && fileInput.files.length > 0) {
    fileNameSpan.textContent = fileInput.files[0].name;
    fileNameSpan.style.display = 'inline';
} else {
    fileNameSpan.textContent = '';
    fileNameSpan.style.display = 'none';
}
});