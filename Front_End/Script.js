let
    produtos = [];
    nextId = 1;
    
    document.getElementById('cadastroForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const produto = {
            id: nextId++,
            categoria: document.getElementById('categoria').value,
            nome: document.getElementById('nome').value,
            quantidade: parseInt(document.getElementById('quantidade').value),
        };

        produtos.push(produto);
        atualizarTabela();
        this.reset();

    }
);

function atualizarTabela() {
    const tabelaBody = document.querySelector('#tabela_vendas');
    tabelaBody.innerHTML = '';
    produtos.forEach(produto => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${produto.id}</td>
            <td>${produto.categoria}</td>
            <td>${produto.nome}</td>
            <td>${produto.quantidade}</td>
        `;
        tabelaBody.appendChild(row);
    });
}