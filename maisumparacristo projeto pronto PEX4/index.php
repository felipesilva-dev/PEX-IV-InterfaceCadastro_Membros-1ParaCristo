<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro de Membros – Igreja +1 Para Cristo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #0d6efd, #6ea8fe);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
      overflow: hidden;
    }

    .card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
      padding: 2rem;
      width: 100%;
      max-width: 800px;
      position: relative;
      z-index: 2;
    }

    h1 {
      font-weight: bold;
      color: #0d6efd;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .btn-custom {
      background: #0d6efd;
      border: none;
      transition: transform 0.2s ease, background 0.3s ease;
    }

    .btn-custom:hover {
      background: #084298;
      transform: scale(1.05);
    }

    /* Versículos */
    .versiculo {
      position: absolute;
      font-size: 1.2rem;
      font-style: italic;
      color: #fff;
      font-weight: bold;
      max-width: 280px;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.4);
      z-index: 1;
      opacity: 0;
      transition: opacity 2s ease;
    }

    .ativo {
      opacity: 1;
    }

    /* Lista de cadastros */
    #lista-cadastros {
      margin-top: 2rem;
      display: none;
    }

    .cadastro-item {
      background: #f8f9fa;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .cadastro-item strong {
      color: #0d6efd;
    }
  </style>
</head>
<body>
  <!-- Formulário -->
  <div class="card">
    <h1>Cadastro de Membros</h1>
    <form id="formCadastro" class="row g-3">
       <div class="col-md-6">
        <label for="nome" class="form-label">Nome Completo</label>
        <input id="nome" name="nome" class="form-control" placeholder="Ex: João da Silva" required>
      </div>
      <div class="col-md-3">
        <label for="cep" class="form-label">CEP</label>
        <input id="cep" name="cep" class="form-control" placeholder="Ex: 10000-000" required>
      </div>
      <div class="col-md-3">
        <label for="dataNascimento" class="form-label">Data</label>
        <input id="dataNascimento" name="dataNascimento" type="date" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label for="cpf" class="form-label">CPF</label>
        <input id="cpf" name="cpf" class="form-control" placeholder="Ex: 000.000.000.00" required>
      </div>
      <div class="col-md-8">
        <label for="endereco" class="form-label">Endereço</label>
        <input id="endereco" name="endereco" class="form-control" placeholder="Ex: Rua Flores, n 20" required>
      </div>
      <div class="col-md-4">
        <label for="numero" class="form-label">Número de Celular</label>
        <input id="numero" name="numero" class="form-control" placeholder="Ex: (xx) xxxxx-xxxx" required>
      </div>
      <div class="col-md-4">
        <label for="cargo" class="form-label">Cargo / Função</label>
        <input id="cargo" name="cargo" class="form-control" placeholder="Ex:Membro, Diácono..." required>
      </div>

      <div class="col-12 text-center">
        <button type="submit" class="btn btn-custom btn-lg text-white px-5">Cadastrar</button>
        <button type="button" onclick="mostrarCadastros()" class="btn btn-secondary btn-lg px-5">Ver Cadastros</button>
      </div>
           <!-- Dentro da div de lista de cadastros, adicione CSS inline para scroll -->
<div id="lista-cadastros" class="mt-4" style="max-height: 300px; overflow-y: auto;">
  <h3 class="text-center text-primary">Membros Cadastrados</h3>
  <div id="lista"></div>
</div>
    </form>

    <!-- Lista de cadastros -->
    <div id="lista-cadastros" class="mt-4">
      <h3 class="text-center text-primary">Membros Cadastrados</h3>
      <div id="lista"></div>
    </div>
  </div>

  <!-- Contêiner para versículos -->
  <div id="versiculos-container"></div>

  <script>
    // Lista de versículos
    const listaVersiculos = [
      '"O Senhor é meu pastor, nada me faltará." (Sl 23:1)',
      '"Tudo posso naquele que me fortalece." (Fp 4:13)',
      '"Deus é amor." (1 Jo 4:8)',
      '"Entrega o teu caminho ao Senhor; confia nele, e o mais ele fará." (Sl 37:5)',
      '"Porque Deus amou o mundo de tal maneira que deu o seu Filho unigênito..." (Jo 3:16)',
      '"Se Deus é por nós, quem será contra nós?" (Rm 8:31)',
      '"Bem-aventurados os limpos de coração, porque verão a Deus." (Mt 5:8)'
    ];

    const posicoes = [
      {top: '10%', left: '5%'},
      {bottom: '15%', right: '5%'},
      {top: '40%', right: '8%'},
      {bottom: '10%', left: '8%'},
      {top: '20%', right: '20%'},
      {bottom: '25%', left: '15%'}
    ];

    const container = document.getElementById('versiculos-container');
    listaVersiculos.forEach((texto, i) => {
      const div = document.createElement('div');
      div.className = 'versiculo';
      div.textContent = texto;
      const pos = posicoes[i % posicoes.length];
      Object.assign(div.style, pos);
      container.appendChild(div);
    });

    const versiculos = document.querySelectorAll('.versiculo');
    let index = 0;
    function mostrarProximo() {
      versiculos.forEach(v => v.classList.remove('ativo'));
      versiculos[index].classList.add('ativo');
      index = (index + 1) % versiculos.length;
    }
    mostrarProximo();
    setInterval(mostrarProximo, 8000);

    // Controle de cadastros
    const form = document.getElementById('formCadastro');
  const lista = document.getElementById('lista');
  const listaCadastros = document.getElementById('lista-cadastros');

  async function carregarLista() {
    try {
      const res = await fetch('listar.php');
      const json = await res.json();
      if (!json.success) {
        lista.innerHTML = '<p class="text-muted">Erro ao carregar lista.</p>';
        console.error(json.message);
        return;
      }
      const membros = json.data || [];
      lista.innerHTML = '';
      if (membros.length === 0) {
        lista.innerHTML = '<p class="text-muted text-center">Nenhum membro cadastrado.</p>';
        return;
      }
      membros.forEach(m => {
        const item = document.createElement('div');
        item.className = "cadastro-item";
        item.innerHTML = `
          <div>
            <strong>${escapeHtml(m.nome)}</strong> - ${escapeHtml(m.cargo)}<br>
            📍 ${escapeHtml(m.endereco)}, CEP: ${escapeHtml(m.cep)}<br>
            📱 ${escapeHtml(m.numero)} | CPF: ${escapeHtml(m.cpf)} | Nascimento: ${escapeHtml(m.dataNascimento)}
          </div>
          <div>
            <button class="btn btn-sm btn-danger" onclick="remover(${m.id})">Remover</button>
          </div>
        `;
        lista.appendChild(item);
      });
    } catch (err) {
      console.error(err);
      lista.innerHTML = '<p class="text-danger">Erro ao carregar cadastros.</p>';
    }
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    try {
      const res = await fetch('cadastrar.php', {
        method: 'POST',
        body: formData
      });
      const json = await res.json();
      if (json.success) {
        alert(json.message || 'Cadastro efetuado');
        form.reset();
        listaCadastros.style.display = 'block';
        carregarLista();
      } else {
        alert('Erro: ' + (json.message || ''));
      }
    } catch (err) {
      console.error(err);
      alert('Erro ao conectar com o servidor.');
    }
  });

  async function remover(id) {
    if (!confirm('Deseja realmente remover esse membro?')) return;
    try {
      const res = await fetch('remover.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
      });
      const json = await res.json();
      if (json.success) {
        alert(json.message || 'Removido');
        carregarLista();
      } else {
        alert('Erro: ' + (json.message || ''));
      }
    } catch (err) {
      console.error(err);
      alert('Erro ao remover membro.');
    }
  }

  function escapeHtml(text) {
    if (!text) return '';
    return text.replace(/[&<>"'\/]/g, function (s) {
      const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;', '/': '&#x2F;' };
      return map[s];
    });
  }

  document.addEventListener('DOMContentLoaded', () => {
    carregarLista();
  });

  </script>
</body>
</html>
