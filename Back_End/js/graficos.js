document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('myChart');
    if (!canvas) return;
    
    const ctx = canvas.getContext('2d');
    
    const elPeriodo = document.getElementById('Periodo');
    const elCategoria = document.getElementById('Categoria');
    const elProduto = document.getElementById('Produto');

    if (!elPeriodo || !elCategoria || !elProduto) {
        console.error("Elementos do filtro não encontrados no HTML.");
        return;
    }

    const periodo = String(elPeriodo.value || '');
    const categoria = String(elCategoria.value || '');
    const produto = String(elProduto.value || '');

    const urlApi = `../../../Back_End/php/api_grafico.php?Periodo=${encodeURIComponent(periodo)}&Categoria=${encodeURIComponent(categoria)}&Produto=${encodeURIComponent(produto)}`;

    console.log("Tentando buscar dados em:", urlApi); 

    fetch(urlApi)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro na resposta da rede: ${response.status} ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            
            const existingChart = Chart.getChart(canvas);
            if (existingChart) {
                existingChart.destroy();
            }

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                            position: 'top',
                        }
                    },
                    tooltip:{
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed.y || 0;
                                return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                            }
                        }
                    },
                    dataLabels: {
                        anchor: 'end',
                        align: 'top',
                        color: '#000',
                        font:{
                            weight: 'bold',
                            size: 12
                        },
                        formatter: function(value) {
                            return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                                }
                            }   
                        },
                        x: {
                            grid:{
                                display: false
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Erro ao carregar dados do gráfico:', error));
});