

document.getElementById('formulario').addEventListener('submit', async event => {
    event.preventDefault();
    let formulario = document.getElementById('formulario')

    fetch('http://localhost:8080/sistema-eventos/backend/actions/cadastrar.php',{
        method: 'POST',
        body: new FormData(formulario)
    }
    ).then(response => response.json())
    .then(data => console.log(data))

})

function adicionarAviso() {
    let aviso = document.getElementById('avisos').value;
    let container = document.getElementById('lista-de-opcoes');

    let tr = document.createElement('tr');
    tr.innerHTML = `<td>${aviso}</td>`;

    let lixeira = document.createElement('td');
    lixeira.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e20712">
            <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
        </svg>`;
    lixeira.classList.add('lixeira');

    // Adicionar evento para remover a linha
    lixeira.addEventListener('click', () => {
        if (tr.parentNode === container) { // Verifica se tr ainda é filho do container
            container.removeChild(tr);
        }
    });

    tr.appendChild(lixeira);
    container.appendChild(tr);

    console.log(aviso);
}