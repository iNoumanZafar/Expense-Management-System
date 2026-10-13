/* ==========================================
   Custom scripts for the whole website
   ========================================== */


/* ===== Show / hide password ===== */

document.querySelectorAll('.password-toggle').forEach(function (button) {
    button.addEventListener('click', function () {
        var input = document.getElementById(button.dataset.target);
        var isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';
        button.textContent = isHidden ? 'Hide' : 'Show';
    });
});
