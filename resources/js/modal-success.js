
document.addEventListener('DOMContentLoaded', function() {
    const alertBox = document.getElementById('globalSuccessAlert');
    if (alertBox) {
        alertBox.classList.remove('hidden');

        setTimeout(() => {
            alertBox.classList.add('hidden');
        }, 3000);
    }
});

function closeGlobalSuccessAlert() {
    const alertBox = document.getElementById('globalSuccessAlert');
    if (alertBox) {
        alertBox.classList.add('hidden');
    }
}
