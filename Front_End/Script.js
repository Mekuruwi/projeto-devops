(function() {
    'use strict';
    
    const toggle = document.getElementById('themeToggle');
    const html = document.documentElement;
    const iframe = document.querySelector('iframe[name="mainFrame"]');
    
    // Função para aplicar tema
    function applyTheme(theme) {
        html.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        syncIframe(theme);
    }
    
    // Sincroniza tema com o iframe
    function syncIframe(theme) {
        if (!iframe) return;
        try {
            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            if (iframeDoc && iframeDoc.documentElement) {
                iframeDoc.documentElement.setAttribute('data-theme', theme);
            }
        } catch (e) {
            // Ignora erro de cross-origin (não deve ocorrer se estiver na mesma origem)
            console.warn('Não foi possível sincronizar tema com iframe:', e);
        }
    }
    
    // Carrega tema salvo ou usa padrão
    const savedTheme = localStorage.getItem('theme') || 'dark';
    applyTheme(savedTheme);
    
    // Evento de clique no toggle
    if (toggle) {
        toggle.addEventListener('click', () => {
            const current = html.getAttribute('data-theme');
            const next = current === 'light' ? 'dark' : 'light';
            applyTheme(next);
        });
    }
    
    // Sincroniza quando o iframe carregar
    if (iframe) {
        iframe.addEventListener('load', () => {
            const current = html.getAttribute('data-theme');
            syncIframe(current);
        });
    }
})();