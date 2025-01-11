    function showToast(message) {
        var container = document.getElementById("toast-container");

        var toast = document.createElement("div");
        toast.className = "toast show";
        toast.innerHTML = `
        <button class="close-btn" onclick="closeToast(this)">&times;</button>
        <div class="message">${message}</div>
            <div class="progress-bar"><div></div></div>
        `;

        container.appendChild(toast);

        setTimeout(function() {
            if (toast.classList.contains("show")) {
                toast.className = toast.className.replace("show", "");
                setTimeout(function() {
                    if (toast.parentNode) {
                        container.removeChild(toast);
                    }
                }, 500);
            }
        }, 5000);
    }

    function closeToast(btn) {
        var toast = btn.parentNode;
        toast.className = toast.className.replace("show", "");
        setTimeout(function() {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 500);
    }

