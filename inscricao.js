


async function listar(categoria='Palestra'){
    let eventos = [];
    await fetch(`http://localhost:8080/evento-uepa/actions/listarEventos.php?categoria=${categoria}`, )
    .then(response => response.json())
    .then(data => {
        
        eventos = data;
    })
    
    return eventos
}

function alterarOpcao(){
    document.getElementById('aviso-evento-selecionado').style.display = 'none';



}


function verificarSelecionados() {
    
    const select = document.getElementById('opcoes');
    const textosSelecionados = Array.from(document.getElementsByClassName('texto-opcao-selecionada')).map(
        texto => texto.innerText.trim()
    );

    const tagsOpt = Array.from(select.getElementsByTagName('option'));

    tagsOpt.forEach(opt => {
       
        if (textosSelecionados.includes(opt.innerText.trim())) {
            opt.disabled = true;
        } else {
            opt.disabled = false;
        }
    });
}

    function adicionarEscolha(){
        const select = document.getElementById('opcoes');
        let opcaoSelecionada = select.options[select.selectedIndex];
        if(opcaoSelecionada.disabled){
            document.getElementById('aviso-evento-selecionado').style.display = 'block';
            return;
        }
        document.getElementById('aviso-evento-selecionado').style.display = 'none';

        const listaDeOpcoes = document.getElementById('lista-de-opcoes');
        const total = document.getElementById('total');


        let preco = opcaoSelecionada.dataset.preco;
        let texto = opcaoSelecionada.text;

       
        total.innerText = (parseFloat(total.innerText.replace(',', '.')) + parseFloat(preco)).toFixed(2);
        
        

        const div = document.createElement('tr');
        div.classList.add('opcao-selecionada');
        div.innerHTML = `<td class='texto-opcao-selecionada' data-id=${opcaoSelecionada.dataset.id}>${texto}</td>`;

        let lixeira = document.createElement('td');
        lixeira.innerHTML = `<td'>${'<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e20712"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>'}</td>`;

        lixeira.classList.add('lixeira');
        lixeira.addEventListener('click', () => {
            let preco = parseFloat(opcaoSelecionada.dataset.preco);
            total.innerText = (parseFloat(total.innerText.replace(',', '.')) - preco).toFixed(2);
            listaDeOpcoes.removeChild(div);
            
            opcaoSelecionada.disabled = false;
        })

        div.appendChild(lixeira);
        
        listaDeOpcoes.appendChild(div);

        verificarSelecionados();

        
    }

   async function listarOpcoes() {
        document.getElementById('aviso-evento-selecionado').style.display = 'none';
        
        const tipoEvento = document.getElementById('palestraMinicurso').value;
        const opcoes = document.getElementById('opcoes');

        let eventos = await listar(tipoEvento);
        opcoes.innerHTML = '';
        
        eventos.forEach(evento => {

            if(evento.categoria === tipoEvento){
                const option = document.createElement('option');
                option.innerText = evento.nome;
                option.dataset.preco = evento.preco;
                option.dataset.id = evento.id;
                opcoes.appendChild(option);
            }

            
            
        });


        verificarSelecionados()

    }


    function selecionarMinicurso(linha, event) {
        document.getElementById('aviso-evento-selecionado').style.display = 'none';
        const checkbox = linha.querySelector('.form-check-input');

        let totalAtual = parseFloat(document.getElementById('total').innerText.replace(',', '.'));
        let precoDoMinicurso = parseFloat(linha.querySelector('td:last-child').innerText.replace(',', '.').replace('R$ ', ''));
        
      
       if (event.target.tagName === 'INPUT') {
     
            if (checkbox.checked) {
                totalAtual += precoDoMinicurso;
            } else {
                totalAtual -= precoDoMinicurso;
            }
        } else {
           
           
            
            if (!checkbox.checked) {
                totalAtual += precoDoMinicurso;
            } else {
                totalAtual -= precoDoMinicurso;
            }

            checkbox.checked = !checkbox.checked;
        }

       
        document.getElementById('total').innerText = totalAtual.toFixed(2).replace('.', ',');
    }
      
    
    (() => {
  'use strict'

  listarOpcoes();

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.from(forms).forEach( form => {
    form.addEventListener('submit', async event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }else{
    

        event.preventDefault()

        let formulario = new FormData(form)
        formulario.append('opcoes', Array.from(document.getElementsByClassName('texto-opcao-selecionada'))
        .map(opcao => opcao.dataset.id) // Pegando o valor do dataset id
        .join(','))
        
         await fetch('http://localhost:8080/evento-uepa/actions/inscrever.php', {
            method: 'POST',
            body: formulario
        }).then(response => response.json())
        .then(data => console.log(data))
        document.getElementById('div-formulario-principal').style.display = 'none';
        document.getElementById('div-confirmacao').style.display = 'flex';
      }

      const fieldsToValidate = Array.from(form.querySelectorAll('input, select')).filter(field => 
        field.id !== 'palestraMinicurso' && field.id !== 'opcoes'
      );

      fieldsToValidate.forEach(field => {
        if (!field.checkValidity()) {
          field.classList.add('is-invalid');
        } else {
          field.classList.remove('is-invalid');
          field.classList.add('is-valid');
        }
      });

      form.classList.add('was-validated')
    }, false)
  })
})()


// Função para formatar e permitir apenas 11 números no CPF
document.getElementById('cpf').addEventListener('input', function(e) {
    let cpf = e.target.value.replace(/\D/g, ''); // Remove tudo que não for número

    // Limita a quantidade de números a 11
    if (cpf.length > 11) {
        cpf = cpf.substring(0, 11);
    }

    // Formatar o CPF com pontos e traços
    if (cpf.length > 6) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3-$4');
    } else if (cpf.length > 3) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{1})/, '$1.$2.$3');
    } else {
        cpf = cpf.replace(/(\d{3})(\d{1})/, '$1.$2');
    }

    e.target.value = cpf; // Atualiza o campo com o CPF formatado
});

// Manipulador de envio do formulário de inscrição para validar o CPF
document.getElementById('formulario').addEventListener('submit', function(event) {
    const cpf = document.getElementById('cpf').value.replace(/\D/g, ''); // Remove caracteres não numéricos

});

// Função para validar o CPF
function validarCPF(cpf) {
    // Valida o CPF
    if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
        return false; // CPF com todos os números iguais é inválido
    }

    let soma = 0;
    let resto;

    // Validação do primeiro dígito verificador
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.charAt(9))) {
        return false; // Primeiro dígito verificador inválido
    }

    soma = 0;
    // Validação do segundo dígito verificador
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) {
        resto = 0;
    }
    if (resto !== parseInt(cpf.charAt(10))) {
        return false; // Segundo dígito verificador inválido
    }

    return true; // CPF válido
}




 
