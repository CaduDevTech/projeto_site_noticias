function esconderNotificacao() {
    let notificacao = document.getElementsByName("notificacao")[0];

    if (notificacao) {
        setTimeout(() => {
            let opacidade = 1; // Começa com opacidade total

            let fadeOut = setInterval(() => {
                if (opacidade <= 0) {
                    clearInterval(fadeOut);
                    notificacao.style.display = "none"; // Esconde após o fade-out
                } else {
                    opacidade -= 0.05; // Reduz a opacidade gradativamente
                    notificacao.style.opacity = opacidade;
                }
            }, 30); // Executa a cada 50ms para suavizar o efeito
        }, 4000); // Aguarda 4 segundos antes de iniciar o fade-out
    }
}

// Chama a função quando a página carrega
window.onload = esconderNotificacao;
