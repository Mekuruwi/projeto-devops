document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('myChart');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    const periodo = document.getElementById('periodo').value;
    const categoria = document.getElementById('categoria').value;
    const produto = document.getElementById('produto').value;

    fetch(`php/api_grafico.php?Periodo=${encodeURIComponent(periodo)}&Categoria=${encodeURIComponent(categoria)}&Produto=${encodeURIComponent(produto)}`)
        .then(response => response.json())
        .then(data => {
            new Chart(ctx, {
                type: 'bar',
                data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    Plugins:{
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales:{
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                                }
                            }   
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Erro ao carregar dados do gráfico:', error));
});