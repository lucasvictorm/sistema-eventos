<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cronograma.css">
</head>

<body>
    
    <!--div onde será carregado o cabeçalho remotamente-->
    <div id="header-div"> <?php 
    include_once ('./cabecalho.php');
    ?></div>
    <main class="container">
        <h2>Cronograma</h2>

        <div class="day-selector">
            <label for="day-select">Escolha o dia:</label>
            <select id="day-select" onchange="showSchedule(this.value)">
                <option value="domingo">Domingo</option>
                <option value="segunda">Segunda</option>
                <option value="terca">Terça</option>
                <option value="quarta">Quarta</option>
            </select>
        </div>

        <div id="domingo" class="cronograma-wrapper">
            <div class="cronograma-header">
                <span>Horário</span>
                <span>Atividade</span>
                <span>Local</span>
            </div>
            <div class="cronograma-item">
                <span class="time">08:00 - 09:00</span>
                <span class="activity">Credenciamento</span>
                <span class="location">Hall de Entrada</span>
            </div>
            <div class="cronograma-item">
                <span class="time">09:00 - 10:30</span>
                <span class="activity">Palestra: "Início do Evento"</span>
                <span class="location">Auditório Principal</span>
            </div>
            <div class="cronograma-item">
                <span class="time">10:30 - 11:00</span>
                <span class="activity">Coffee Break</span>
                <span class="location">Espaço de Convivência</span>
            </div>
            <div class="cronograma-item">
                <span class="time">11:00 - 12:30</span>
                <span class="activity">Painel: "Avanços na Engenharia de Software"</span>
                <span class="location">Auditório 2</span>
            </div>
        </div>

        <div id="segunda" class="cronograma-wrapper">
            <div class="cronograma-header">
                <span>Horário</span>
                <span>Atividade</span>
                <span>Local</span>
            </div>
            <div class="cronograma-item">
                <span class="time">08:00 - 09:00</span>
                <span class="activity">Workshop: "Testes Automatizados"</span>
                <span class="location">Sala 101</span>
            </div>
            <div class="cronograma-item">
                <span class="time">09:00 - 10:30</span>
                <span class="activity">Mesa Redonda: "Carreira em TI"</span>
                <span class="location">Auditório Principal</span>
            </div>
            <div class="cronograma-item">
                <span class="time">10:30 - 11:00</span>
                <span class="activity">Coffee Break</span>
                <span class="location">Espaço de Convivência</span>
            </div>
            <div class="cronograma-item">
                <span class="time">11:00 - 12:30</span>
                <span class="activity">Palestra: "IA e Machine Learning"</span>
                <span class="location">Auditório 2</span>
            </div>
        </div>

        <div id="terca" class="cronograma-wrapper">
            <div class="cronograma-header">
                <span>Horário</span>
                <span>Atividade</span>
                <span>Local</span>
            </div>
            <div class="cronograma-item">
                <span class="time">08:00 - 09:30</span>
                <span class="activity">Sessão de Perguntas: "DevOps"</span>
                <span class="location">Sala 102</span>
            </div>
            <div class="cronograma-item">
                <span class="time">09:30 - 10:30</span>
                <span class="activity">Oficina: "Programação Funcional"</span>
                <span class="location">Laboratório de Informática</span>
            </div>
            <div class="cronograma-item">
                <span class="time">10:30 - 11:00</span>
                <span class="activity">Coffee Break</span>
                <span class="location">Espaço de Convivência</span>
            </div>
            <div class="cronograma-item">
                <span class="time">11:00 - 12:30</span>
                <span class="activity">Painel: "Sustentabilidade na Tecnologia"</span>
                <span class="location">Auditório Principal</span>
            </div>
        </div>

        <div id="quarta" class="cronograma-wrapper">
            <div class="cronograma-header">
                <span>Horário</span>
                <span>Atividade</span>
                <span>Local</span>
            </div>
            <div class="cronograma-item">
                <span class="time">08:00 - 09:00</span>
                <span class="activity">Palestra: "Segurança da Informação"</span>
                <span class="location">Auditório Principal</span>
            </div>
            <div class="cronograma-item">
                <span class="time">09:00 - 10:00</span>
                <span class="activity">Mesa Redonda: "Tecnologia e Inclusão"</span>
                <span class="location">Sala 103</span>
            </div>
            <div class="cronograma-item">
                <span class="time">10:00 - 10:30</span>
                <span class="activity">Coffee Break</span>
                <span class="location">Espaço de Convivência</span>
            </div>
            <div class="cronograma-item">
                <span class="time">10:30 - 12:00</span>
                <span class="activity">Workshop: "Desenvolvimento Ágil"</span>
                <span class="location">Laboratório 1</span>
            </div>
            <div class="cronograma-item">
                <span class="time">12:00 - 13:00</span>
                <span class="activity">Encerramento</span>
                <span class="location">Auditório Principal</span>
            </div>
        </div>
    </main>
    <div id="footer-div"></div>
</body>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>

function showSchedule(day) {
            const days = document.querySelectorAll('.cronograma-wrapper');
            days.forEach(schedule => schedule.classList.remove('active'));
            document.getElementById(day).classList.add('active');
        }

        // Mostrar o cronograma de domingo por padrão
        document.getElementById("day-select").value = "domingo";
        showSchedule('domingo');

    //carrega o cabeçalho remotamente
    /*
    fetch('cabecalho.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('header-div').innerHTML = data;
      });
*/
    //carrega o rodapé remotamente
    fetch('rodape.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-div').innerHTML = data;
      });

    let cronograma = [
        {
            "time": "08:00 - 09:00",
            "activity": "Credenciamento",
            "location": "Hall de Entrada"
        },
        {
            "time": "09:00 - 10:30",
            "activity": "Palestra de Abertura: \"O Futuro da Engenharia de Software\"",
            "location": "Auditório Principal"
        },
        {
            "time": "10:30 - 11:00",
            "activity": "Coffee Break",
            "location": "Espaço de Convivência"
        },
        {
            "time": "11:00 - 12:30",
            "activity": "Workshops Técnicos",
            "location": "Salas 101, 102, 103"
        },
        {
            "time": "12:30 - 14:00",
            "activity": "Intervalo para Almoço",
            "location": "Refeitório"
        },
        {
            "time": "14:00 - 15:30",
            "activity": "Apresentação de Trabalhos",
            "location": "Salas 201, 202"
        },
        {
            "time": "15:30 - 16:00",
            "activity": "Encerramento e Premiação",
            "location": "Auditório Principal"
        }
    ]

    //cria o cronograma dinamicamente
    let divCronograma = document.getElementById('cronograma');
        
    cronograma.forEach(item => {
        divCronograma.innerHTML += `<div class="cronograma-item">
                <span class="time">${item.time}</span>
                <span class="activity">${item.activity}</span>
                <span class="location">${item.location}</span>
            </div>`
    })

    
</script>
</html>